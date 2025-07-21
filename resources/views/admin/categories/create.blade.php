@extends('admin.layouts.master')
@section('title', __('lang.create categoey'))


@section('content')
 @include('admin.style')

 <div class="row" dir="rtl">
   <div class="col-xxl-12 order-2 order-xxl-1">
      <!--begin::Advance Table Widget 2-->
      <div class="card card-custom card-stretch gutter-b p-2 bg-light-info border border-light">
          <!--begin::Header-->
          <div class="cart-header p-5 bg-success rounded  m-5">
            <b  class="text-light  font-weight-bolder  h3 align-items-center ">
              {{__('lang.create new category')}}
            </b>
          </div>
          <div class="card-body bg-light-info">


            @include('admin.session')
            <form action="{{ route('admin.categories.store') }}" method="POST" class="row">
                @csrf
                <div class="mb-3 col-md-6 form-group2">
                    <label class="block">{{__('lang.name_en')}} <span class="required">*</span> :</label>
                    <input type="text" name="name_en" class="form-control " value="{{ old('name_en') }}">

                </div>
                <div class="mb-3 col-md-6 form-group2">
                    <label class="block">{{__('lang.name_ar')}} <span class="required">*</span> :</label>
                    <input type="text" name="name_ar" class="form-control " value="{{ old('name_ar') }}">
                </div>

                <div class="mb-3 col-md-6 form-group2">
                    <label class="block">{{__('lang.description_en')}} <span class="required">*</span> :</label>
                    <input type="text" name="description_en" class="form-control " value="{{ old('description_en') }}">

                </div>
                <div class="mb-3 col-md-6 form-group2">
                    <label class="block">{{__('lang.description_ar')}} <span class="required">*</span> :</label>
                    <input type="text" name="description_ar" class="form-control " value="{{ old('description_ar') }}">
                </div>

                <div class="mb-3 col-md-12 form-group2">
                    <label class="block">{{__('lang.position')}} <span class="required">*</span> :</label>
                    <input type="number" name="position" class="form-control " value="{{ old('position') }}">
                </div>

                <div class="mb-3 col-md-6 form-group2">
                    <label class="Banzima-check-container">

                       {{ __('lang.active')}}

                      <input type="checkbox" name="active" value="is_active"  id="is_active">
                      <span class="banzima-check-checkmark"></span>
                    </label>
                 </div>

                 <div class="mb-3 col-md-6 form-group2">
                     <label class="Banzima-check-container">

                        {{ __('lang.show_home')}}

                       <input type="checkbox" name="show_home" value="show_home"  id="show_home">
                       <span class="banzima-check-checkmark"></span>
                     </label>
                  </div>




                <div class="col-9"></div>

                <div class="col-3"><button type="submit" class="btn btn-success btn-block"><i class="fas fa-save"></i>{{__('lang.Save')}}</button></div>
            </form>
          </div>
        </div>
    </div>
 </div>


  </section>
@endsection
@section('script')
  @include('admin.scripts')
@endsection
