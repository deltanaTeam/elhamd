<?php

namespace App\Http\Controllers\Dashboard;

use App\Helpers\JsonResponse;
use App\Http\Requests\{StoreShippingRequest,UpdateShippingRequest};
use App\Models\Shipping;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\BaseController;
use Yajra\DataTables\Facades\DataTables;
use App\Traits\DesignButton;
class ShippingController extends BaseController
{
  use DesignButton;


    public function index()
    {
      if(request()->ajax()){

          return DataTables::of(Shipping::withTrashed()->get())
              ->addIndexColumn()
              ->addColumn('name_en', fn($row) => $row->getTranslation('name', 'en'))
              ->addColumn('name_ar', fn($row) => $row->getTranslation('name', 'ar'))
              ->addColumn('reason_en', fn($row) => $row->getTranslation('reason', 'en'))
              ->addColumn('reason_ar', fn($row) => $row->getTranslation('reason', 'ar'))
              ->addColumn('action', fn($row) => $this->showButtons($row->id) ) // حطي هنا الزر أو ال view
              ->rawColumns(['action'])
              ->make(true);
        }
      return view('admin.shipping.index');

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
      $code = Str::random(8);
      return view('admin.shippings.create')->with('code',$code);

    }


    public function store(StoreShippingRequest $request)
    {
      $user = auth('pharmacist')->user();

      $shipping = new Shipping;
      $shipping ->value	 = $request->value	;
      $shipping ->type  = $request->type ;
      $shipping ->pharmacy_id  = $user->pharmacy_id;

      $shipping->save();
      return redirect()->route('admin.shippings.index')->with('success','saved successfully');

    }
    public function edit(string $id)
    {
      $shipping = Shipping::findOrFail($id);
      return view('admin.shippings.edit',compact('shipping'));
    }

    public function update(UpdateShippingRequest $request, Shipping $shipping)
    {
      $user = auth('pharmacist')->user();

      $shipping ->value	 = $request->value	;
      $shipping ->type  = $request->type ;
      $shipping ->pharmacy_id  = $user->pharmacy_id;

      $shipping->save();

      return redirect()->route('admin.shippings.index')->with('success','saved successfully');
    }

    public function destroy(Request $request,$id)
    {
        $shipping = Shipping::findOrFail($id);

        $shipping ->delete();

        return redirect()->route('admin.shippings.index')->with('success','deleted successfully');
    }

    public function restore(Request $request ,$id)
    {
        $shipping = Shipping::withTrashed()->findOrFail($id);
        $shipping->restore();
        return redirect()->route('admin.shippings.index')->with('success','restored successfully');

    }




    public function forceDelete(Request $request ,$id)
    {

        $shipping = Shipping::withTrashed()->findOrFail($id);

        $shipping->forceDelete();

        return redirect()->route('admin.shippings.index')->with('success','forceDelete successfully');
    }

    public function showButtons($id){
      $shipping = Shipping::withTrashed()->findOrFail($id);
      $restore ="";
      $force_delete = "";
      $forceModal = "";
      $restoreModal ="";
      $deleteModal =$this->make_delete_modal($id);
      $delete  = $this->make_modal($this->deleteRow(route("admin.shippings.destroy",$id)),__('lang.delete'),"Delete",$id);

      if ($shipping->trashed()) {
        $restore = $this->make_modal($this->restoreRow(route("admin.shippings.restore",$id)),__('lang.restore'),"Restore",$id);

        $force_delete = $this->make_modal($this->forceDeleteRow(route("admin.shippings.force-delete",$id)),__('lang.forceDelete'),"forceDelete",$id);
        $forceModal =  $this->make_force_delete_modal($id);
        $restoreModal = $this->make_restore_modal($id);
        $deleteModal ="";

        $delete  = "";

      }

       $edit = $this->make_edit(route("admin.shippings.edit",$id));
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
    //   $model_delete = $this->make_modal($this->deleteRow(route("admin.shipping.destroy",$id)),__('lang.delete'),"Delete",$id);
    //    $edit = $this->make_edit(route("admin.shipping.edit",$id));
    //   return '<div class="btn-group btn-group-sm px-1">'.$this->make_show(route("admin.shipping.show",$id))." ".$edit." ".$this->make_delete_modal($id).'</div>'.$model_delete
    //   ;
    // }
}
