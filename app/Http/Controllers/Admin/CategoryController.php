<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\Models\Category;
use App\Traits\DesignButton;
use Illuminate\Validation\Rule;
class CategoryController extends Controller
{
   use DesignButton;
    /**
     * Display a listing of the resource.
     */

    public function index()
    {
      if(request()->ajax()){

          return DataTables::of(Category::select(['id', 'name']))
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
      $categories = Category::whereNull('parent_id')->get('name','id');
      return view('admin.categories.create',compact('categories'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       $request->validate([
          'name_en' => ['required', 'string', 'max:100','unique:categories,name->en'],
          'name_ar' => ['required', 'string', 'max:100','unique:categories,name->ar'],
          'description_en' => ['nullable', 'string', 'max:255'],
          'description_ar' => ['nullable', 'string', 'max:255'],
      ]);

      $category = new Category;

      $category ->setTranslation('name', 'en',$request->name_en );
      $category ->setTranslation('name', 'ar',$request->name_ar );
      $category ->setTranslation('description', 'en',$request->description_en );
      $category ->setTranslation('description', 'ar',$request->description_ar );
      $category->save();
    //  dd($category);
      return redirect()->route('admin.categories.index')->with('success','saved successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
      $category = Category::findOrFail($id);
      $categories = Category::whereNull('parent_id')->get('name','id');
      return view('admin.categories.edit',compact('categories','category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $category =  Category::findOrFail($id);

        $request->validate([
           'name_en' => ['required', 'string', 'max:100',Rule::unique('categories','name->ar')->ignore($category->id)],
           'name_ar' => ['required', 'string', 'max:100',Rule::unique('categories','name->ar')->ignore($category->id)],
           'description_en' => ['nullable', 'string', 'max:255'],
           'description_ar' => ['nullable', 'string', 'max:255'],
       ]);


       $category ->setTranslation('name', 'en',$request->name_en );
       $category ->setTranslation('name', 'ar',$request->name_ar );
       $category ->setTranslation('description', 'en',$request->description_en );
       $category ->setTranslation('description', 'ar',$request->description_ar );
       $category->save();
       return redirect()->route('admin.categories.index')->with('success','updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
       $category = Category::findOrFail($id);
       if(!$category->children){
         $category->delete();
         return redirect()->route('admin.categories.index')->with('success','deleted successfully');
       }
       return redirect()->route('admin.categories.index')->with('fail','category has sub categories');


    }
    /////////////////////////////////////////////////
    public function showButtons($id){
      $model_delete = $this->make_modal($this->deleteRow(route("admin.categories.destroy",$id)),__('lang.delete'),"Delete",$id);
       $edit = $this->make_edit(route("admin.categories.edit",$id));
      return '<div class="btn-group btn-group-sm px-1">'.$this->make_show(route("admin.categories.show",$id))." ".$edit." ".$this->make_delete_modal($id).'</div>'.$model_delete
      ;
    }
}
