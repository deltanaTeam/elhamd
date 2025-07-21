<?php

namespace App\Services;

use App\Models\{Product, Category, Brand,Pharmacy};
use App\Http\Resources\{
    BrandResource,PharmacyResource,
    CategoryResource,
    TopSellingProductResource,
    TopRatedProductResource,
    OfferProductResource,
    FeaturedProductResource,
    TopRatedBrandResource
};
use App\Helpers\JsonResponse;

class PharmacyProductHomeService
{
    public function getHomeData(int $pharmacyId)
    {
        $pharmacy = Pharmacy::findOrFail($pharmacyId);
        
        $brands = Brand::whereHas('products', function ($q) use ($pharmacyId) {
            $q->where('pharmacy_id', $pharmacyId);
        })->orderBy('position')->get();

        $categories = Category::whereHas('products', function ($q) use ($pharmacyId) {
            $q->where('pharmacy_id', $pharmacyId);
        })->orderBy('position')->get();

        $products_offer = Product::withAvg('ratings', 'rate')
            ->withAvg('pharmacistRatings', 'rate')
            ->with('offer')
            ->whereHas('offer')
            ->where('pharmacy_id', $pharmacyId)
            ->where('active', true)
            ->where('show_home', true)
            ->latest()
            ->take(10)
            ->get();

        $top_rate_products = Product::withAvg('ratings', 'rate')
            ->withAvg('pharmacistRatings', 'rate')
            ->with('offer')
            ->where('pharmacy_id', $pharmacyId)
            ->where('active', true)
            ->orderByDesc('ratings_avg_rate')
            ->take(10)
            ->get();

        $to_sell_products = Product::withSum('orderItems', 'quantity')
            ->withAvg('pharmacistRatings', 'rate')
            ->where('pharmacy_id', $pharmacyId)
            ->where('active', true)
            ->orderByDesc('order_items_sum_quantity')
            ->take(10)
            ->get();

        $features = Product::where('is_featured', true)
            ->withAvg('pharmacistRatings', 'rate')
            ->where('pharmacy_id', $pharmacyId)
            ->where('active', true)
            ->with('offer')
            ->latest()
            ->take(10)
            ->get();

        $brands_rate = Brand::select('brands.*')
            ->join('products', 'products.brand_id', '=', 'brands.id')
            ->join('user_product_ratings', 'user_product_ratings.product_id', '=', 'products.id')
            ->where('products.pharmacy_id', $pharmacyId)
            ->groupBy('brands.id')
            ->selectRaw('AVG(user_product_ratings.rate) as average_rating')
            ->orderByDesc('average_rating')
            ->withCount(['products' => function ($q) use ($pharmacyId) {
                $q->where('pharmacy_id', $pharmacyId);
            }])
            ->take(10)
            ->get();

        return [
            'pharmacy' =>new PharmacyResource($pharmacy),
            'brands'               => BrandResource::collection($brands),
            'categories'           => CategoryResource::collection($categories),
            'top_brands'           => TopRatedBrandResource::collection($brands_rate),
            'featured_products'    => FeaturedProductResource::collection($features),
            'top_selling_products' => TopSellingProductResource::collection($to_sell_products),
            'top_rated_products'   => TopRatedProductResource::collection($top_rate_products),
            'offer_products'       => OfferProductResource::collection($products_offer),
        ];
    }
}
