@extends('admin.layouts.master')

@section('title', __('lang.'.$data['title']))

@section('sub-topbar')
<div class=" " >
  <ul class="nav d-flex justify-content-start ">
    <li class="nav-item mx-3 pt-2 ">
       <b  class="text-primary  font-weight-bolder  h3 align-items-center ">
         {{__('lang.'.$data['title'])}}
       </b>
    </li>
  </ul>
</div>
@endsection
@section('content')
 @include('admin.style')
 <style media="screen">
 thead{
   background-color: #002133;
   color:#ffffff;
 }
 </style>
 <div class="row" dir="rtl">
   <div class="col-xxl-12 order-2 order-xxl-1">
      <!--begin::Advance Table Widget 2-->
      <div class="card card-custom card-stretch gutter-b p-2">
          <!--begin::Header-->

          <div class="card-body bg-light-info">

            @include('admin.session')
            <div class="table-responsive">
              {!! $dataTable->table([],true) !!}
            </div>
          </div>
        </div>
    </div>
 </div>


  </section>
@endsection
@section('script')
{!! $dataTable->scripts() !!}
  @include('admin.scripts')
@endsection
