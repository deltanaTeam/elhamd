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

 <div class="row" dir="rtl">
   <div class="col-xxl-12 order-2 order-xxl-1">
      <!--begin::Advance Table Widget 2-->
      <div class="card card-custom card-stretch gutter-b p-2">
          <!--begin::Header-->

          <div class="card-body bg-light-info">

            @include('admin.session')
            <div class="table-responsive">
              <table id="#category-table" class=" datatable table table-bordered w-100" data-url="{{ route('admin.categories.data') }}">
    <thead>
        <tr>
            <th>{{__('lang.number')}}</th>
            <th>{{__('lang.name_ar')}}</th>
            <th>{{__('lang.name_en')}}</th>
            <th>{{__('lang.description_ar')}}</th>
            <th>{{__('lang.description_en')}}</th>
            <th>{{__('lang.options')}}</th>
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
        { data: 'name_ar', name: 'name_ar' },
        { data: 'name_en', name: 'name_en' },

        { data: 'action', name: 'action', orderable: false, searchable: false },
    ]);
</script>
@endpush
  @include('admin.datatable')
@endsection
