@extends('admin.layouts.master')

@section('title', __('lang.point_settings'))

@section('sub-topbar')
<div class=" " >
  <ul class="nav d-flex justify-content-start ">
    <li class="nav-item mx-3 pt-2 ">
       <b  class="text-primary  font-weight-bolder  h3 align-items-center ">
         {{__('lang.point_settings')}}
       </b>
    </li>
  </ul>
</div>
@endsection
@section('content')
 @include('admin.style')
 <style media="screen">

 </style>
 <div class="row" dir="rtl">
   <div class="col-xxl-12 order-2 order-xxl-1">
      <!--begin::Advance Table Widget 2-->
      <div class="card card-custom card-stretch gutter-b p-2">
          <!--begin::Header-->

          <div class="card-body bg-light-info">

            @include('admin.session')
            @include('admin.partials.datatable', [
                       'id' => 'point_table',
                       'columns' => [
                           ['title' => __('lang.order number')],
                           ['title' => __('lang.earning_rate')],
                           ['title' => __('lang.redeem_rate')],
                           ['title' => __('lang.active')],

                           ['title' => __('lang.actions')],
                       ],
                   ])
          </div>
        </div>
    </div>
 </div>


  </section>
@endsection
@section('script')


@include('admin.partials.datatable_script', [
       'id' => 'category_table',
       'ajax_url' => route('admin.categories.index'),
       'datatable_columns' => [
           ['data' => 'DT_RowIndex', 'name' => 'DT_RowIndex', 'orderable' => false, 'searchable' => false],
           ['data' => 'earning_rate', 'name' => 'earning_rate'],
           ['data' => 'redeem_rate', 'name' => 'redeem_rate'],
           ['data' => 'is_active', 'name' => 'is_active'],

           ['data' => 'action', 'name' => 'action', 'orderable' => false],
       ]
   ])
  @include('admin.scripts')
@endsection
