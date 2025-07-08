<?php


namespace App\Helpers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Throwable;
use App\Helpers\JsonResponse;

/**
 *
 */
class DBHelper
{

  public static function safeTransaction(callable $callback)
  {
    try{
      DB::beginTransaction();
      $result = $callback();
      DB::commit();
      return JsonResponse::respondSuccess(" saved successfully", $result , 200);

    }
    catch(Throwable $e){
      DB::rollBack();
      Log::error('DB transaction faild:'.$e->getMessage());
      return JsonResponse::respondError("failed to save data".$e->getMessage(), 500);

    }
  }




}
