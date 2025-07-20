<?php

namespace App\Http\Controllers\Client\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\JsonResponse;
use App\Models\{Product,Category,Brand};
use Exception;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\ProductResource;
use App\Interfaces\ProductRepositoryInterface;
use App\Repositories\ProductRepository;
use App\Http\Controllers\BaseController;
use App\Services\UserHomeService;


class HomeController extends BaseController
{

    protected $homeService;

    public function __construct(UserHomeService $homeService)
    {
        $this->homeService = $homeService;
    }
    public function index(Request $request)
    {

       try {
             $homeData = $this->homeService->getHomeData();
             return JsonResponse::respondSuccess('Home data loaded successfully',$homeData);
         } catch (\Exception $e) {
             return JsonResponse::respondError('Failed to load home data'. $e->getMessage());
         }
    }
}
