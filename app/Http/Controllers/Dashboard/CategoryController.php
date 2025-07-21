<?php

namespace App\Http\Controllers\Dashboard;

use App\Helpers\JsonResponse;
use App\Http\Requests\{StoreCategoryRequest,UpdateCategoryRequest};
use App\Interfaces\Dashboard\CategoryRepositoryInterface;
use App\Models\Category;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\BaseController;
use Yajra\DataTables\Facades\DataTables;
use App\Traits\DesignButton;
class CategoryController extends BaseController
{
  use DesignButton;
    protected mixed $crudRepository;

    public function __construct(CategoryRepositoryInterface $pattern)
    {
        $this->crudRepository = $pattern;
    }

    public function index()
    {
      if(request()->ajax()){

          return DataTables::of(Category::get())
              ->addIndexColumn()
              ->addColumn('name_en', fn($row) => $row->getTranslation('name', 'en'))
              ->addColumn('name_ar', fn($row) => $row->getTranslation('name', 'ar'))
              ->addColumn('action', fn($row) => $this->showButtons($row->id) ) // حطي هنا الزر أو ال view
              ->rawColumns(['action'])
              ->make(true);
        }
      return view('admin.categories.index');

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
      return view('admin.categories.create');

    }


    public function store(StoreCategoryRequest $request)
    {

      $category = new Category;

      $category ->setTranslation('name', 'en',$request->name_en );
      $category ->setTranslation('name', 'ar',$request->name_ar );
      $category ->setTranslation('reason', 'en',$request->description_en );
      $category ->setTranslation('reason', 'ar',$request->description_ar );
      if(Auth::guard('owner')->ckeck()){
        $category ->status ="admin_insert";
      }else {
        $category ->status ="pending";
      }
      $category->save();
            return redirect()->route('admin.categories.index')->with('success','saved successfully');

    }
    public function edit(string $id)
    {
      $category = Category::findOrFail($id);
      return view('admin.categories.edit',compact('category'));
    }

    public function update(UpdateCategoryRequest $request, Category $category): ?\Illuminate\Http\JsonResponse
    {

            $this->crudRepository->update($request->validated(), $category->id);

            $category = Category::find($category->id);
            $this->crudRepository->AddMediaCollection('image', $category);

           return redirect()->route('admin.categories.index')->with('success','saved successfully');
    }

    public function destroy(Request $request)
    {

        $this->crudRepository->deleteRecords('categories', $request['items']);
return redirect()->route('admin.categories.index')->with('success','deleted successfully');
    }

    public function restore(Request $request)
    {

          $this->crudRepository->restoreItem(Category::class, $request['items']);
          return redirect()->route('admin.categories.index')->with('success','restored successfully');

    }




    public function forceDelete(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'items' => 'required|array',
            'items.*' => 'integer|exists:teams,id',
        ]);



            $items = $request->input('items');

            // Fetch the soft-deleted items
            $softDeletedItems = Category::withTrashed()
                ->whereIn('id', $items)
                ->whereNotNull('deleted_at')
                ->get();

            if ($softDeletedItems->isEmpty()) {
              return redirect()->route('admin.categories.index')->with('fail','One or more records do not exist or are not soft deleted. Please refresh the page.');

            }

            // Force delete the soft-deleted items
            foreach ($softDeletedItems as $item) {
                $item->forceDelete();
            }

return redirect()->route('admin.categories.index')->with('success','forceDelete successfully');
    }

    public function showButtons($id){
      $model_delete = $this->make_modal($this->deleteRow(route("admin.categories.destroy",$id)),__('lang.delete'),"Delete",$id);
       $edit = $this->make_edit(route("admin.categories.edit",$id));
      return '<div class="btn-group btn-group-sm px-1">'.$this->make_show(route("admin.categories.show",$id))." ".$edit." ".$this->make_delete_modal($id).'</div>'.$model_delete
      ;
    }
}
