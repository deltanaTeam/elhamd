<?php

namespace App\Http\Controllers\Pharmacy\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PharmacyProductController extends Controller
{
    // public function __construct()
    // {
    // }

    /**
     * Store a newly created product in storage.
     */


    public function index(): JsonResponse
{
    try {
        // جلب جميع المنتجات التي تخص الصيدلية المسجّلة دخولها
        $products = Product::where('pharmacy_id', Auth::id())
            ->with(['brand', 'category', 'manufacturer', 'pharmacy']) // تحميل البيانات المرتبطة
            ->get();

        return response()->json([
            'message' => 'Products retrieved successfully',
            'data' => ProductResource::collection($products) // تحويل البيانات إلى Resource
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'message' => 'Failed to retrieve products',
            'error' => $e->getMessage()
        ], 500);
    }
}


public function store(StoreProductRequest $request)
{
    DB::beginTransaction();

    try {
        $data = $request->validated();
        $data['pharmacy_id'] = Auth::id();
        
        // أضف هذه السطور للحقول الإضافية
        $data['type'] = 'medicine'; // قيمة افتراضية
        $data['form'] = 'tablets';  // قيمة افتراضية
        $data['strength'] = '100mg'; // قيمة افتراضية
        $data['active'] = true; // قيمة افتراضية
        $data['show_home'] = false; // قيمة افتراضية

        $product = Product::create($data);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $product->addMedia($image)->toMediaCollection('images');
            }
        }

        DB::commit();

        return response()->json([
            'message' => 'Product created successfully',
            'data' => new ProductResource($product)
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
     * Update the specified product in storage.
     */
public function update(UpdateProductRequest $request, Product $product)
{
    // التحقق من أن المنتج يخص الصيدلية المسجلة
    if ($product->pharmacy_id !== auth()->id()) {
        return response()->json(['message' => 'غير مصرح به'], 403);
    }

    DB::beginTransaction();
    
    try {
        $data = $request->validated();
        
        // تحديث البيانات الأساسية
        $product->update([
            'name' => $data['name'] ?? $product->name,
            'price' => $data['price'] ?? $product->price,
            'tax_rate' => $data['tax_rate'] ?? $product->tax_rate,
            'batch_number' => $data['batch_number'] ?? $product->batch_number,
            // باقي الحقول بنفس الطريقة
        ]);

        // تحديث الصور (إذا وجدت)
        if ($request->hasFile('images')) {
            $product->clearMediaCollection('images');
            foreach ($request->file('images') as $image) {
                $product->addMedia($image)->toMediaCollection('images');
            }
        }

        DB::commit();

        return response()->json([
            'message' => 'تم تحديث المنتج بنجاح',
            'data' => new ProductResource($product->refresh())
        ]);

    } catch (\Exception $e) {
        DB::rollBack();
        return response()->json([
            'message' => 'فشل في تحديث المنتج',
            'error' => $e->getMessage()
        ], 500);
    }
}

    /**
     * Remove the specified product from storage.
     */
    public function destroy(Product $product): JsonResponse
    {
        // Verify the product belongs to the logged in pharmacy
        if ($product->pharmacy_id !== Auth::id()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        DB::beginTransaction();

        try {
            $product->delete();
            DB::commit();

            return response()->json(['message' => 'Product deleted successfully']);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'message' => 'Failed to delete product',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}