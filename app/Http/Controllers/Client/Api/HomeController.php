<?php

namespace App\Http\Controllers\Client\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\JsonResponse;
use App\Models\{Product,Category,Brand};
use Exception;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\{ProductResource,ProductDetailResource};
use App\Interfaces\ProductRepositoryInterface;
use App\Repositories\ProductRepository;
use App\Http\Controllers\BaseController;
use App\Services\UserHomeService;
use App\Services\PharmacyProductHomeService;


class HomeController extends BaseController
{

    protected $homeService;
    protected $pharmacyService;
    public function __construct(UserHomeService $homeService ,PharmacyProductHomeService $pharmacyService)
    {
        $this->homeService = $homeService;
        $this->pharmacyService = $pharmacyService;
    }
    /////////////////////////////////////////////////////////////////


    public function index(Request $request)
    {

       try {
             $homeData = $this->homeService->getHomeData();
             return JsonResponse::respondSuccess('Home data loaded successfully',$homeData);
         } catch (\Exception $e) {
             return JsonResponse::respondError('Failed to load home data'. $e->getMessage());
         }
    }

   /////////////////////////////////////////////////////////////////////////////////

    public function getPharmacy(Request $request ,$id)
    {

       try {
             $pharmacyData = $this->pharmacyService->getHomeData($id);
             return JsonResponse::respondSuccess('Pharmacy data loaded successfully',$pharmacyData);
         } catch (\Exception $e) {
             return JsonResponse::respondError('Failed to load Pharmacy data'. $e->getMessage());
         }
    }

/////////////////////////////////////////////////////////////////////////////////////////
    public function filterProducts(Request $request)
    {
      try {
        $query = Product::query()
            ->withAvg('ratings', 'rate')
            ->withAvg('pharmacistRatings', 'rate')
            ->with('offer')
            ->where('active', true);

        if ($request->filled('price_min')) {
            $query->where('price', '>=', $request->price_min);
        }

        if ($request->filled('price_max')) {
            $query->where('price', '<=', $request->price_max);
        }

        if ($request->filled('user_rating_min')) {
            $query->having('ratings_avg_rate', '>=', $request->user_rating_min);
        }

        if ($request->filled('pharmacist_rating_min')) {
            $query->having('pharmacist_ratings_avg_rate', '>=', $request->pharmacist_rating_min);
        }


        $products = $query->paginate(20);

        return ProductResource::collection($products);
      } catch (\Exception $e) {
          return JsonResponse::respondError('Failed to load data'. $e->getMessage());
      }
    }
    ///////////////////////////////////////////////////////////////////////////////////

    public function searchProducts(Request $request)
    {
      try {
        $query = Product::query()
            ->with('brand', 'category', 'offer')
            ->where('active', true);

        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        if ($request->filled('keyword')) {
            $keyword = $request->keyword;
            $query->where(function ($q) use ($keyword) {
                $q->where('name->ar', 'like', "%$keyword%")
                  ->orWhere('name->en', 'like', "%$keyword%")
                  ->orWhere('generic_name', 'like', "%$keyword%")
                  ->orWhereHas('brand', function ($b) use ($keyword) {
                      $b->where('name->ar', 'like', "%$keyword%")
                        ->orWhere('name->en', 'like', "%$keyword%");
                  });
            });
        }

        $products = $query->paginate(20);

        return ProductResource::collection($products);
      } catch (\Exception $e) {
          return JsonResponse::respondError('Failed to load data'. $e->getMessage());
      }

    }
    ///////////////////////////////////////////////////////////////////////////////
    public function showProduct($id)
    {
      try {
        $product = Product::with([
            'brand',
            'category',
            'offer',
            'ratings.user',
            'pharmacistRatings.pharmacist',
            'media'
        ])->findOrFail($id);

        return new ProductDetailResource($product);
      } catch (\Exception $e) {
          return JsonResponse::respondError('Failed to load data'. $e->getMessage());
      }
    }

}
