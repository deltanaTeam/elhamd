<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\PointSetting;
use Yajra\DataTables\Facades\DataTables;

use App\Traits\DesignButton;

class PointSettingController extends Controller
{
  use DesignButton;
  public function index()
  {
    if(request()->ajax()){

        return DataTables::of(PointSetting::get())
            ->addIndexColumn()
            ->addColumn('pharmacyName', fn($row) => $row->pharmacy?->name)

            ->addColumn('action', fn($row) => $this->showButtons($row->id) ) // حطي هنا الزر أو ال view
            ->rawColumns(['action'])
            ->make(true);
      }
    return view('admin.point_settings.index');

  }
  public function create()
  {
      return view('admin.point_settings.form');
  }

  public function edit($id)
  {
      $user = Auth::guard('pharmacist')->user();
      $pharmacyId = $user->pharmacy_id;
      $setting = PointSetting::where('pharmacy_id', $pharmacyId)->where('id', $id)->first();

      return view('admin.point_settings.edit',compact('setting'));
  }

  public function store(Request $request)
  {
      $user = Auth::guard('pharmacist')->user();
      $pharmacyId = $user->pharmacy_id;

      $PointSetting = PointSetting::where('pharmacy_id' ,$pharmacyId)->first();
      if($PointSetting){
        return back()->with('fail','system has setting you can only update');
      }
      $validated = $request->validate([
          'earning_rate' => 'required|numeric|min:0',
          'redeem_rate'  => 'required|numeric|min:0|max:1',
          'is_active'    => 'required|boolean',
      ]);

    $point = new  PointSetting;
    $point-> pharmacy_id = $pharmacyId;
    $point-> earning_rate = $request->earning_rate;
    $point-> redeem_rate = $request->redeem_rate;
    $point-> is_active = $request->is_active;
    $point->save();
    return redirect()->back()->with('success', 'saved successfully');
  }

  public function update(Request $request ,$id)
  {
      $user = Auth::guard('pharmacist')->user();
      $pharmacyId = $user->pharmacy_id;
      $point = PointSetting::where('pharmacy_id' ,$pharmacyId)->where('id',$id)->first();

      $validated = $request->validate([
          'earning_rate' => 'required|numeric|min:0',
          'redeem_rate'  => 'required|numeric|min:0|max:1',
          'is_active'    => 'required|boolean',
      ]);

      $point-> pharmacy_id = $pharmacyId;
      $point-> earning_rate = $request->earning_rate;
      $point-> redeem_rate = $request->redeem_rate;
      $point-> is_active = $request->is_active;
      $point->save();

      return redirect()->back()->with('success', 'saved successfully');
  }

  public function showButtons($id){

     $edit = $this->make_edit(route("admin.point-settings.edit",$id));
     return '<div class="btn-group btn-group-sm px-1">' .
                 ($edit ?? '') .
             '</div>'
                 ;
  }
}
