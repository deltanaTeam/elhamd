<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\Models\Category;
use App\Trait\DesignButton;
class CategoryController extends Controller
{
   use DesignButton;
    /**
     * Display a listing of the resource.
     */

    public function index()
    {
      return view('admin.categories.index');

    }

    /////////////////////////////////////////////
    public function data() {
        return DataTables::of(Category::query())
            ->addColumn('action', fn($row) => $this->showButtons($$row->id))
            ->addColumn('name_ar', fn($row) => $row->getTranslation('name', 'ar'))
            ->addColumn('name_en', fn($row) => $row->getTranslation('name', 'en'))
            ->rawColumns(['action'])
            ->make(true);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
    /////////////////////////////////////////////////
    public function showButtons($id){
      $model_delete = $this->make_modal($this->deleteRow(route("admin.categories.destroy",$id)),__('lang.delete'),"Delete",$id);
       $edit = $this->make_edit(route("admin.categories.edit",$id));
      return '<div class="btn-group btn-group-sm px-1">'.$this->make_show(route("admin.categories.show",$id))." ".$edit." ".$this->make_delete_modal($id).'</div>'.$model_delete
      ;
    }
}
