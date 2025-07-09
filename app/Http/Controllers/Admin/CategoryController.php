<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Http\Requests\{StoreCategoryRequest,UpdateCategoryRequest};
use App\Http\Resources\Admin\CategoryResource;
use App\Traits\DesignButton;
use App\Helpers\JsonResponse;
use Exception;
class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index()
    {

      try {
           return CategoryResource::collection(Category::latest()->get())->additional(JsonResponse::success());
       } catch (Exception $e) {
           return JsonResponse::respondError($e->getMessage());
       }

    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
      try {
           return CategoryResource::collection(Category::select('id','name')->get())->additional(JsonResponse::success());
       } catch (Exception $e) {
           return JsonResponse::respondError($e->getMessage());
       }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request)
    {
      try {
          $category = new Category;
          $category ->setTranslation('name', 'en',$request->name_en );
          $category ->setTranslation('name', 'ar',$request->name_ar );
          $category ->setTranslation('description', 'en',$request->description_en );
          $category ->setTranslation('description', 'ar',$request->description_ar );
          $category->parent_id = $request->parent_id;
          if ($request->hasFile('image')) {
            $path = $this->storeImage($file);
            $category->image =$path ;
          }
          $category->save();
          return CategoryResource($category)->additional(JsonResponse::success());
       } catch (Exception $e) {
           return JsonResponse::respondError($e->getMessage());
       }
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        try {
          return CategoryResource($category)->additional(JsonResponse::success());

        } catch (Exception $e) {
            return JsonResponse::respondError($e->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        try {
          return CategoryResource($category)->additional(JsonResponse::success());

        } catch (Exception $e) {
            return JsonResponse::respondError($e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        $try {
            $category ->setTranslation('name', 'en',$request->name_en );
            $category ->setTranslation('name', 'ar',$request->name_ar );
            $category ->setTranslation('description', 'en',$request->description_en );
            $category ->setTranslation('description', 'ar',$request->description_ar );
            $category->parent_id = $request->parent_id;
            if ($request->hasFile('image')) {
              $path = $this->storeImage($file);
              $this->deleteFile($category->image);
              $category->image =$path ;
            }
            $category->save();
            return CategoryResource($category)->additional(JsonResponse::success());
         } catch (Exception $e) {
             return JsonResponse::respondError($e->getMessage());
         }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {

        try
         {
            if(!$category->children)
            {
              $this->deleteFile($category->image);

              $category->delete();
              return JsonResponse::respondSuccess("deleted successfully");
            }
            return JsonResponse::respondError("deleted successfully");
          }
          catch (Exception $e)
          {
            return JsonResponse::respondError('category has subcategories');
          }

    }
    ////////////////////////////////////////////////
}
