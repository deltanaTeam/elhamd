@extends('admin.layouts.master')

@section('title', __('lang.categories'))

@section('sub-topbar')
<div class=" " >
  <ul class="nav d-flex justify-content-start ">
    <li class="nav-item mx-3 pt-2 ">
       <b  class="text-primary  font-weight-bolder  h3 align-items-center ">
         {{__('lang.categories')}}
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
                           ['title' => __('lang.name_en')],
                           ['title' => __('lang.name_ar')],
                           ['title' => __('lang.reason_en')],
                           ['title' => __('lang.reason_ar')],

                           ['title' => __('lang.status')],
                           ['title' => __('lang.show_home')],
                           ['title' => __('lang.active')],
                           ['title' => __('lang.position')],

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
           ['data' => 'name_en', 'name' => 'name_en'],
           ['data' => 'name_ar', 'name' => 'name_ar'],
           ['data' => 'reason_en', 'name' => 'reason_en'],
           ['data' => 'reason_ar', 'name' => 'reason_ar'],

           ['data' => 'status', 'name' => 'status'],
           ['data' => 'show_home', 'name' => 'show_home'],

           ['data' => 'active', 'name' => 'active'],
           ['data' => 'position', 'name' => 'position'],

           ['data' => 'action', 'name' => 'action', 'orderable' => false],
       ]
   ])
  @include('admin.scripts')
@endsection
