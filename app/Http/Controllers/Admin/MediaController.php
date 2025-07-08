<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Media;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Helpers\JsonResponse;

class MediaController extends Controller
{

  public function uploadFiles(Request $request)
  {
    $request->validate([
       'images' => ['required', 'array'],
       'images.*' => ['image', 'mimes:jpeg,png,jpg,webp', 'max:3072']
    ]);
    $saved = [];
    foreach ($request->file('images') as  $file) {
      $path = $this->storeImage($file);
      $media = Media::create(['path' => $path ]);
      $saved[] = [ 'id'=> $media->id ] ;
    }
     return JsonResponse::respondSuccess("images added successfully", $saved , 200);
  }

  public function uploadBase64(Request $request)
  {
    $request->validate([
       'images' => ['required', 'array'],
       'images.*' => ['string']
    ]);
    $saved = [];
    foreach ($request->images as  $base64) {
      $path = $this->storeBase64($base64);
      if($path){
        $media = Media::create(['path' => $path ]);
        $saved[] = [ 'id'=> $media->id ] ;
      }
    }
    if($saved != []){
      return JsonResponse::respondSuccess("images added successfully", $saved , 200);
    }
    else{
      return JsonResponse::respondError("unprocessable entities", 422);

    }
  }

  public function storeImage($photo)
  {
    $image = Image::make($photo)->encode(null,75);
    $realMime = $image->mime();
    $originname = $photo->getClientOriginalName();
    $nameAbsolute = pathinfo($originname ,PATHINFO_FILENAME);
    $extension = explode('/',$realMime)[1];
    $filename = time().'-' .$nameAbsolute.'.'.$extension ;
    $path = "uploads/images/{$filename}";
    Storage::disk('public')->put($path ,(string) $image );
    return $path;
  }
  /*
  *
  */
  public function storeBase64($base64)
  {
    if (preg_match('/^data:image\/(\w+);base64,/', $base64, $matches))
    {
      $extension = $matches[1];
      $base64 = substr($base64 , strpos($base64, ',')+1);
      $image = Image::make(base64_decode($base64))->encode($extension,75);
      $filename = time().'-' . $photo->getClientOriginalName();
      $path = "uploads/images/{$filename}";
      Storage::disk('public')->put($path ,(string) $image );
      return $path;
    }else{
      return null;
    }

  }

}
