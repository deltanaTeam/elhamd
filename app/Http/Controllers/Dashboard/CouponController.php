<?php

namespace App\Http\Controllers\Dashboard;

use App\Helpers\JsonResponse;
use App\Http\Requests\{StoreCouponRequest,UpdateCouponRequest};
use App\Models\Coupon;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\BaseController;
use Yajra\DataTables\Facades\DataTables;
use App\Traits\DesignButton;
class CouponController extends BaseController
{
  use DesignButton;


    public function index()
    {
      if(request()->ajax()){

          return DataTables::of(Coupon::withTrashed()->get())
              ->addIndexColumn()
              ->addColumn('name_en', fn($row) => $row->getTranslation('name', 'en'))
              ->addColumn('name_ar', fn($row) => $row->getTranslation('name', 'ar'))
              ->addColumn('reason_en', fn($row) => $row->getTranslation('reason', 'en'))
              ->addColumn('reason_ar', fn($row) => $row->getTranslation('reason', 'ar'))
              ->addColumn('action', fn($row) => $this->showButtons($row->id) ) // حطي هنا الزر أو ال view
              ->rawColumns(['action'])
              ->make(true);
        }
      return view('admin.coupon.index');

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
      $code = Str::random(8);
      return view('admin.coupons.create')->with('code',$code);

    }


    public function store(StoreCouponRequest $request)
    {
      $user = auth('pharmacist')->user();

      $coupon = new Coupon;
      $coupon ->discount_type	 = $request->discount_type	;
      $coupon ->code  = $request->code ;
      $coupon ->discount_value = $request->discount_value;
      $coupon ->start_date = $request->start_date;
      $coupon ->end_date	 = $request->end_date	;
      $coupon ->usage_limit = $request->usage_limit;
      $coupon ->usage_times = $request->usage_times;
      $coupon ->is_active = $request->is_active;
      $coupon ->pharmacy_id  = $user->pharmacy_id;

      $coupon->save();
      return redirect()->route('admin.coupons.index')->with('success','saved successfully');

    }
    public function edit(string $id)
    {
      $coupon = Coupon::findOrFail($id);
      return view('admin.coupons.edit',compact('coupon'));
    }

    public function update(UpdateCouponRequest $request, Coupon $coupon)
    {
      $user = auth('pharmacist')->user();

      $coupon ->discount_type	 = $request->discount_type	;
      $coupon ->code  = $request->code ;
      $coupon ->discount_value = $request->discount_value;
      $coupon ->start_date = $request->start_date;
      $coupon ->end_date	 = $request->end_date	;
      $coupon ->usage_limit = $request->usage_limit;
      $coupon ->usage_times = $request->usage_times;
      $coupon ->is_active = $request->is_active;
      $coupon ->pharmacy_id  = $user->pharmacy_id;

      $coupon->save();

      return redirect()->route('admin.coupons.index')->with('success','saved successfully');
    }

    public function destroy(Request $request,$id)
    {
        $coupon = Coupon::findOrFail($id);

        $coupon ->delete();

        return redirect()->route('admin.coupons.index')->with('success','deleted successfully');
    }

    public function restore(Request $request ,$id)
    {
        $coupon = Coupon::withTrashed()->findOrFail($id);
        $coupon->restore();
        return redirect()->route('admin.coupons.index')->with('success','restored successfully');

    }




    public function forceDelete(Request $request ,$id)
    {

        $coupon = Coupon::withTrashed()->findOrFail($id);

        $coupon->forceDelete();

        return redirect()->route('admin.coupons.index')->with('success','forceDelete successfully');
    }

    public function showButtons($id){
      $coupon = Coupon::withTrashed()->findOrFail($id);
      $restore ="";
      $force_delete = "";
      $forceModal = "";
      $restoreModal ="";
      $deleteModal =$this->make_delete_modal($id);
      $delete  = $this->make_modal($this->deleteRow(route("admin.coupons.destroy",$id)),__('lang.delete'),"Delete",$id);

      if ($coupon->trashed()) {
        $restore = $this->make_modal($this->restoreRow(route("admin.coupons.restore",$id)),__('lang.restore'),"Restore",$id);

        $force_delete = $this->make_modal($this->forceDeleteRow(route("admin.coupons.force-delete",$id)),__('lang.forceDelete'),"forceDelete",$id);
        $forceModal =  $this->make_force_delete_modal($id);
        $restoreModal = $this->make_restore_modal($id);
        $deleteModal ="";

        $delete  = "";

      }

       $edit = $this->make_edit(route("admin.coupons.edit",$id));
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
    //   $model_delete = $this->make_modal($this->deleteRow(route("admin.coupon.destroy",$id)),__('lang.delete'),"Delete",$id);
    //    $edit = $this->make_edit(route("admin.coupon.edit",$id));
    //   return '<div class="btn-group btn-group-sm px-1">'.$this->make_show(route("admin.coupon.show",$id))." ".$edit." ".$this->make_delete_modal($id).'</div>'.$model_delete
    //   ;
    // }
}
