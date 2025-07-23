@extends('admin.layouts.master')
@section('title', __('lang.create coupon'))


@section('content')
 @include('admin.style')

 <div class="row" dir="rtl">
   <div class="col-xxl-12 order-2 order-xxl-1">
      <!--begin::Advance Table Widget 2-->
      <div class="card card-custom card-stretch gutter-b p-2 bg-light-info border border-light">
          <!--begin::Header-->
          <div class="cart-header p-5 bg-success rounded  m-5">
            <b  class="text-light  font-weight-bolder  h3 align-items-center ">
              {{__('lang.create new coupon')}}
            </b>
          </div>
          <div class="card-body bg-light-info">


            @include('admin.session')
            <form action="{{ route('admin.coupons.store') }}" method="POST" class="row">
                @csrf
                <div class="form-group2 col-md-6">
                <label for=""> {{ __('lang.code')}}<span class="required"> * </span> :</label>
                <input type="text" name="code" value="{{$code??old('code')}}" class="form-control">
              </div>

              <div class="form-group2 col-md-6">
                <label for="">{{ __('lang.discount_type')}}<span class="required"> * </span> :</label>
                <select class="form-control" name="discount_type">
                  <option value="percentage" >{{ __('lang.percentage')}}</option>
                  <option value="fixed" >{{ __('lang.fixed')}}</option>
                </select>
              </div>

              <div class="form-group2 col-md-6">
                <label for=""> {{ __('lang.discount_value')}}<span class="required"> * </span> :</label>
                <input type="number" min="0"  name="discount_value" value="{{old('discount_value')}}" class="form-control"  id="value">
              </div>
              <div class="form-group2 col-md-6">
                  <label for="usr">{{ __('lang.start_date')}} <span class="required"> * </span> :</label>
                  <input type="text"  class="form-control BanzinaDate  " name="start_date" value="{{old('start_date')}}">
              </div>

              <div class="form-group2 col-md-6">
                  <label for="usr">{{ __('lang.end_date')}} <span class="required"> * </span> :</label>
                  <input type="text"  class="form-control BanzinaDate " name="end_date" value="{{old('end_date')}}">
              </div>

              <div class="form-group2 col-md-6">
                  <label for="usr">{{ __('lang.usage_limit')}} :</label>
                  <input type="number"  class="form-control " name="usage_limit" value="{{old('usage_limit')}}">
              </div>

              <div class="mb-3 col-md-6 form-group2">
                  <label for="is_active" class="form-label">{{__('lang.activate Category')}}</label>
                  <select name="is_active" class="form-control">
                      <option value="1" >{{__('lang.active')}}</option>
                      <option value="0" >{{__('lang.inactive')}}</option>
                  </select>
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
