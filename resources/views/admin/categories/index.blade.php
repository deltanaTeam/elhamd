@extends('admin.layouts.master')

@section('title', __('lang.title))

@section('sub-topbar')
<div class=" " >
  <ul class="nav d-flex justify-content-start ">
    <li class="nav-item mx-3 pt-2 ">
       <b  class="text-primary  font-weight-bolder  h3 align-items-center ">
         title
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
              <table id="#category-table" class=" datatable table table-bordered w-100" data-url="{{ route('users.data') }}">
    <thead>
        <tr>
            <th>الرقم</th>
            <th>الاسم</th>
            <th>البريد</th>
            <th>خيارات</th>
        </tr>
    </thead>
</table>



            </div>
          </div>
        </div>
    </div>
 </div>


  </section>
@endsection
@section('script')
@push('scripts')
<script>
    initDataTable('#category-table', '{{ route('admin.categories.data') }}', [
        { data: 'id', name: 'id' },
        { data: 'name', name: 'name' },
        { data: 'email', name: 'email' },
        { data: 'action', name: 'action', orderable: false, searchable: false },
    ]);
</script>
@endpush
  @include('admin.datatable')
@endsection
