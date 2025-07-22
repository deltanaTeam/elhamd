<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    /**
     * Display a paginated list of products.
     *
     * @param Request $request
     * @return AnonymousResourceCollection
     */
    public function index(Request $request): AnonymousResourceCollection
    {
        $page = $request->input('page', 1);
        $perPage = $request->input('per_page', 15);

        $cacheKey = "products.page.{$page}.per_page.{$perPage}";

        $products = Cache::remember($cacheKey, now()->addMinutes(30), function () use ($perPage) {
            return Product::with(['pharmacy'])
                ->orderBy('created_at', 'desc')
                ->paginate($perPage);
        });

        return ProductResource::collection($products);
    }

    /**
     * Store a newly created product in storage.
     *
     * @param StoreProductRequest $request
     * @return JsonResponse
     */
    public function store(StoreProductRequest $request): JsonResponse
    {
        DB::beginTransaction();

        try {
            // Create the product using validated data
            $product = Product::create($request->validated());

            // Commented the image handling for now
            /*
            if ($request->has('images')) {
                foreach ($request->images as $image) {
                    $path = $image->store('product_images', 'public');
                    ProductImage::create([
                        'product_id' => $product->id,
                        'image_path' => $path
                    ]);
                }
            }
            */

            // Commit the transaction
            DB::commit();

            return response()->json([
                'message' => 'Product created successfully',
                'data' => new ProductResource($product->load(['brand', 'category', 'manufacturer', 'pharmacy'])) // Exclude images here
            ], 201);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'message' => 'Failed to create product',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified product.
     *
     * @param Product $product
     * @return ProductResource
     */
    public function show(Product $product): ProductResource
    {
        $cacheKey = "product.{$product->id}";

        $product = Cache::remember($cacheKey, now()->addMinutes(30), function () use ($product) {
            return $product->load(['pharmacy']); // Exclude images here for now
        });

        return new ProductResource($product);
    }

    /**
     * Update the specified product in storage.
     *
     * @param UpdateProductRequest $request
     * @param Product $product
     * @return JsonResponse
     */
    public function update(UpdateProductRequest $request, Product $product): JsonResponse
    {
        DB::beginTransaction();

        try {
            $product->update($request->validated());

            // Commented the image handling for now
            /*
            if ($request->has('images')) {
                // Delete old images if needed
                $product->images()->delete();

                foreach ($request->images as $image) {
                    $path = $image->store('product_images', 'public');
                    ProductImage::create([
                        'product_id' => $product->id,
                        'image_path' => $path
                    ]);
                }
            }
            */

            // Commit the transaction
            DB::commit();

            // Clear cache
            Cache::forget("product.{$product->id}");

            return response()->json([
                'message' => 'Product updated successfully',
                'data' => new ProductResource($product->fresh(['brand', 'category', 'manufacturer', 'pharmacy'])) // Exclude images here
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'message' => 'Failed to update product',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified product from storage.
     *
     * @param Product $product
     * @return JsonResponse
     */
    public function destroy(Product $product): JsonResponse
    {
        DB::beginTransaction();

        try {
            $product->delete();

            // Commit the transaction
            DB::commit();

            // Clear cache
            Cache::forget("product.{$product->id}");

            return response()->json([
                'message' => 'Product deleted successfully'
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'message' => 'Failed to delete product',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
