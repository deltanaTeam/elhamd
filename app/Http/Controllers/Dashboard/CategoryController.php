<?php

namespace App\Http\Controllers\Dashboard;

use App\Helpers\JsonResponse;
use App\Http\Requests\{StoreCategoryRequest,UpdateCategoryRequest};
use App\Interfaces\Dashboard\CategoryRepositoryInterface;
use App\Models\Category;
use Exception;
use Illuminate\Support\Facades\Auth;

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

          return DataTables::of(Category::withTrashed()->get())
              ->addIndexColumn()
              ->addColumn('name_en', fn($row) => $row->getTranslation('name', 'en'))
              ->addColumn('name_ar', fn($row) => $row->getTranslation('name', 'ar'))
              ->addColumn('reason_en', fn($row) => $row->getTranslation('reason', 'en'))
              ->addColumn('reason_ar', fn($row) => $row->getTranslation('reason', 'ar'))
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
      $category ->active = $request->is_active;
      $category ->show_home = $request->show_home;
      $category ->position = $request->position;

      if(Auth::guard('web-owner')->check()){
        $category ->status ="admin_insert";
      }
      else {
        $category ->status ="pending";
        $category ->active =0;
      }
      $category->save();
      return redirect()->route('admin.categories.index')->with('success','saved successfully');

    }
    public function edit(string $id)
    {
      $category = Category::findOrFail($id);
      return view('admin.categories.edit',compact('category'));
    }

    public function update(UpdateCategoryRequest $request, Category $category)
    {
      $category ->setTranslation('name', 'en',$request->name_en );
      $category ->setTranslation('name', 'ar',$request->name_ar );
      $category ->setTranslation('reason', 'en',$request->description_en );
      $category ->setTranslation('reason', 'ar',$request->description_ar );
      $category ->active = $request->is_active;
      $category ->show_home = $request->show_home;

      if(Auth::guard('web-owner')->check()){
        $category ->status =$request->status;
        $category ->position = $request->position;
        $category ->show_home = $request->show_home;


      }

      $category->save();

      return redirect()->route('admin.categories.index')->with('success','saved successfully');
    }

    public function destroy(Request $request,$id)
    {
        $category = Category::findOrFail($id);
        // if(Auth::guard('web-owner')->check()){
        //   if($category->products) {
        //     return redirect()->route('admin.categories.index')->with('fail','category contains at least one product');
        //
        //   }
          $category ->delete();
        //}
        return redirect()->route('admin.categories.index')->with('success','deleted successfully');
    }

    public function restore(Request $request ,$id)
    {
        $category = Category::withTrashed()->findOrFail($id);
        $category->restore();
        return redirect()->route('admin.categories.index')->with('success','restored successfully');

    }




    public function forceDelete(Request $request ,$id)
    {

        $category = Category::withTrashed()->findOrFail($id);

        $category->forceDelete();

        return redirect()->route('admin.categories.index')->with('success','forceDelete successfully');
    }

    public function showButtons($id){
      $category = Category::withTrashed()->findOrFail($id);
      $restore ="";
      $force_delete = "";
      $forceModal = "";
      $restoreModal ="";
      $deleteModal =$this->make_delete_modal($id);
      $delete  = $this->make_modal($this->deleteRow(route("admin.categories.destroy",$id)),__('lang.delete'),"Delete",$id);

      if ($category->trashed()) {
        $restore = $this->make_modal($this->restoreRow(route("admin.categories.restore",$id)),__('lang.restore'),"Restore",$id);

        $force_delete = $this->make_modal($this->forceDeleteRow(route("admin.categories.force-delete",$id)),__('lang.forceDelete'),"forceDelete",$id);
        $forceModal =  $this->make_force_delete_modal($id);
        $restoreModal = $this->make_restore_modal($id);
        $deleteModal ="";

        $delete  = "";

      }

       $edit = $this->make_edit(route("admin.categories.edit",$id));
       return '<div class="btn-group btn-group-sm px-1">' .
                   ($edit ?? '') .
                   ($deleteModal ?? '') .
                   ($restoreModal ?? '') .
                   ($forceModal ?? '') .
               '</div>' .
               ($delete ?? '') .
               ($restore ?? '') .
               ($force_delete ?? '');      ;
    }

    // public function showButtons($id){
    //   $model_delete = $this->make_modal($this->deleteRow(route("admin.categories.destroy",$id)),__('lang.delete'),"Delete",$id);
    //    $edit = $this->make_edit(route("admin.categories.edit",$id));
    //   return '<div class="btn-group btn-group-sm px-1">'.$this->make_show(route("admin.categories.show",$id))." ".$edit." ".$this->make_delete_modal($id).'</div>'.$model_delete
    //   ;
    // }
}
