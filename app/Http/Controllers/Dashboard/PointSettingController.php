<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\PointSetting;
class PointSettingController extends Controller
{

  public function index()
  {
    if(request()->ajax()){

        return DataTables::of(PointSetting::get())
            ->addIndexColumn()

            ->addColumn('action', fn($row) => $this->showButtons($row->id) ) // حطي هنا الزر أو ال view
            ->rawColumns(['action'])
            ->make(true);
      }
    return view('admin.point_settings.index');

  }
  public function form()
  {
      $pharmacy = Auth::guard('pharmacist')->user()->pharmacy;
      $setting = PointSetting::firstOrNew(['pharmacy_id' => $pharmacy->id]);

      return view('admin.point_settings.form', compact('setting'));
  }

  public function save(Request $request)
  {
      $pharmacy = Auth::guard('pharmacist')->user()->pharmacy;

      $validated = $request->validate([
          'earning_rate' => 'required|numeric|min:0',
          'redeem_rate'  => 'required|numeric|min:0|max:1',
          'is_active'    => 'required|boolean',
      ]);

      PointSetting::updateOrCreate(
          ['pharmacy_id' => $pharmacy->id],
          $validated
      );

      return redirect()->back()->with('success', 'saved successfully');
  }

  public function showButtons($id){

     $edit = $this->make_edit(route("admin.point-settings.form",$id));
     return '<div class="btn-group btn-group-sm px-1">' .
                 ($edit ?? '') .
             '</div>'
                 ;
  }
}
