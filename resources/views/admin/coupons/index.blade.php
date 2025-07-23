@extends('admin.layouts.master')

@section('title', __('lang.coupons'))

@section('sub-topbar')
<div class=" " >
  <ul class="nav d-flex justify-content-start ">
    <li class="nav-item mx-3 pt-2 ">
       <b  class="text-primary  font-weight-bolder  h3 align-items-center ">
         {{__('lang.coupons')}}
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
                       'id' => 'category_table',
                       'columns' => [
                           ['title' => __('lang.order number')],
                           ['title' => __('lang.discount_type')],
                           ['title' => __('lang.code')],
                           ['title' => __('lang.discount_value')],
                           ['title' => __('lang.start_date')],

                           ['title' => __('lang.end_date')],
                           ['title' => __('lang.usage_limit')],
                           ['title' => __('lang.usage_times')],
                           ['title' => __('lang.is_active')],
                           ['title' => __('lang.pharmacy_id ')],

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
           ['data' => 'discount_type', 'name' => 'discount_type'],
           ['data' => 'code', 'name' => 'code'],
           ['data' => 'discount_value', 'name' => 'discount_value'],
           ['data' => 'start_date', 'name' => 'start_date'],

           ['data' => 'end_date', 'name' => 'end_date'],
           ['data' => 'usage_limit', 'name' => 'usage_limit'],

           ['data' => 'usage_times', 'name' => 'usage_times'],
           ['data' => 'is_active', 'name' => 'is_active'],
           ['data' => 'pharmacy_id', 'name' => 'pharmacy_id'],

           ['data' => 'action', 'name' => 'action', 'orderable' => false],
       ]
   ])
  @include('admin.scripts')
@endsection
