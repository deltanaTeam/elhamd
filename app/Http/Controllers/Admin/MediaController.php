<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Media;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Helpers\JsonResponse;
use App\Traits\HasUpload;
class MediaController extends Controller
{
  use HasUpload;
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



}
