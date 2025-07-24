<?php

namespace App\Http\Controllers\Pharmacy\Api;
// namespace App\Http\Controllers\Pharmacy\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
  use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Cache;

class PharmacyProductController extends Controller
{
    /**
     * عرض جميع المنتجات التي تخص الصيدلية.
     */
public function index()
{
    $cacheKey = 'products_' . auth()->id();
    $pharmacy_id = Auth::user()->pharmacy_id ?? 1;

    $products = Cache::remember($cacheKey, now()->addHours(2), function() use ($pharmacy_id) {
        return Product::where('pharmacy_id', $pharmacy_id)
            ->with(['brand', 'category', 'manufacturer', 'pharmacy'])
            ->paginate(10);
    });

    $categories = Cache::remember('categories', now()->addDay(), function() {
        return Category::all();
    });

    return view('admin.product.index', compact('products', 'categories'));
}


    /**
     * عرض نموذج إضافة منتج جديد.
     */
    public function create()
    {
        // استرجاع الفئات والعلامات التجارية لإظهارها في النموذج
      $pharmacy_id = 1;  // الحصول على `pharmacy_id` من المستخدم الحالي

        $categories = Category::all();
        $brands = Brand::all();

        return view('admin.product.create', compact('categories', 'brands'));
    }

    /**
     * تخزين منتج جديد في قاعدة البيانات.
     */
    public function store(StoreProductRequest $request)
    {
        DB::beginTransaction();

        try {
            $data = $request->validated();
            $data['pharmacy_id'] = 1; // تعيين `pharmacy_id` إلى 1 أو يمكنك استخدام Auth::id() إذا كان المنتج ينتمي إلى الصيدلية الحالية
            //    $data['pharmacy_id'] = Auth::id();
            $product = Product::create($data);

            // إضافة الصور إذا كانت موجودة
            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $image) {
                    $product->addMedia($image)->toMediaCollection('images');
                }
            }

            DB::commit();

            return redirect()->route('admin.product.index')->with('success', 'تم إنشاء المنتج بنجاح');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('admin.product.index')->withErrors(['message' => 'فشل في إنشاء المنتج', 'error' => $e->getMessage()]);
        }
    }

    /**
     * تحديث المنتج.
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        if ($product->pharmacy_id !== Auth::id()) {
            return redirect()->route('admin.product.index')->with('error', 'غير مصرح به');
        }

        DB::beginTransaction();

        try {
            $data = $request->validated();
            $product->update($data);

            // إذا كانت هناك صور تم رفعها
            if ($request->hasFile('images')) {
                $product->clearMediaCollection('images');
                foreach ($request->file('images') as $image) {
                    $product->addMedia($image)->toMediaCollection('images');
                }
            }

            DB::commit();

            return redirect()->route('admin.product.index')->with('success', 'تم تحديث المنتج بنجاح');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('admin.product.index')->withErrors(['message' => 'فشل في تحديث المنتج', 'error' => $e->getMessage()]);
        }
    }

    /**
     * حذف المنتج.
     */
    public function destroy(Product $product)
    {
        if ($product->pharmacy_id !== Auth::id()) {
            return redirect()->route('admin.product.index')->with('error', 'غير مصرح به');
        }

        DB::beginTransaction();

        try {
            $product->delete();
            DB::commit();

            return redirect()->route('admin.product.index')->with('success', 'تم حذف المنتج بنجاح');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('admin.product.index')->withErrors(['message' => 'فشل في حذف المنتج', 'error' => $e->getMessage()]);
        }
    }
}
