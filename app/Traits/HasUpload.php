<?php

namespace App\Traits;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Helpers\JsonResponse;
trait HasUpload
{
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
  public function deleteFile($path)
  {
    if (Storage::disk('public')->exists($path))
    {
      Storage::disk('public')->delete($path);
    }
  }
}
