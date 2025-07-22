<?php


// app/Http/Controllers/API/ProductRatingController.php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRatingRequest;
use App\Models\Product;
use App\Models\ProductRating;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class ProductRatingController extends Controller
{


     public function index(Product $product): JsonResponse
    {
        // جلب جميع التقييمات الخاصة بالمنتج
        $ratings = $product->ratings;  // Assuming you have a relationship defined for ratings in Product model

        return response()->json([
            'ratings' => $ratings
        ], 200);
    }
    
  public function store(StoreRatingRequest $request, Product $product): JsonResponse
{
    $rating = DB::transaction(function () use ($request, $product) {
        $rating = ProductRating::updateOrCreate(
            [
                'user_id' => auth()->id(),
                'product_id' => $product->id
            ],
            [
                'rating' => $request->rating,
                'comment' => $request->comment,
                'is_approved' => true // تم التعديل هنا مباشرة
            ]
        );

        $product->recalculateRatings();
        
        return $rating;
    });

    return response()->json([
        'message' => 'تم إضافة التقييم بنجاح',
        'rating' => $rating
    ], 201);
}
protected function shouldAutoApprove(): bool
{
    return true; 
}
}