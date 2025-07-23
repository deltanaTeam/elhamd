@extends('admin.layouts.master')
@section('title', __('lang.edit coupon'))


@section('content')
 @include('admin.style')

 <div class="row" dir="rtl">
   <div class="col-xxl-12 order-2 order-xxl-1">
      <!--begin::Advance Table Widget 2-->
      <div class="card card-custom card-stretch gutter-b p-2 bg-light-info border border-light">
          <!--begin::Header-->
          <div class="cart-header p-5 bg-warning rounded  m-5">
            <b  class="text-light  font-weight-bolder  h3 align-items-center ">
              {{__('lang.edit coupon')}}
            </b>
          </div>
          <div class="card-body bg-light-info">


            @include('admin.session')
            <form action="{{ route('admin.coupons.update',$coupon->id) }}" method="POST" class="row">
                @csrf
                @method('PUT')
                <div class="form-group2 col-md-6">
                <label for=""> {{ __('lang.code')}}<span class="required"> * </span> :</label>
                <input type="text" name="code" value="{{old('code',$coupon->)}}" class="form-control">
              </div>

              <div class="form-group2 col-md-6">
                <label for="">{{ __('lang.discount_type')}}<span class="required"> * </span> :</label>
                <select class="form-control" name="discount_type">
                  <option value="percentage" {{$coupon->discount_type ==="percentage" ? 'selected' : '' }}>{{ __('lang.percentage')}}</option>
                  <option value="fixed" {{$coupon->discount_type  ==="fixed"? 'selected' : '' }}>{{ __('lang.fixed')}}</option>
                </select>
              </div>

              <div class="form-group2 col-md-6">
                <label for=""> {{ __('lang.discount_value')}}<span class="required"> * </span> :</label>
                <input type="number" min="0"  name="discount_value" value="{{old('discount_value',$coupon->discount_value)}}" class="form-control"  id="value">
              </div>
              <div class="form-group2 col-md-6">
                  <label for="usr">{{ __('lang.start_date')}} <span class="required"> * </span> :</label>
                  <input type="text"  class="form-control BanzinaDate  " name="start_date" value="{{old('start_date',$coupon->start_date)}}">
              </div>

              <div class="form-group2 col-md-6">
                  <label for="usr">{{ __('lang.end_date')}} <span class="required"> * </span> :</label>
                  <input type="text"  class="form-control BanzinaDate " name="end_date" value="{{old('end_date',$coupon->end_date)}}">
              </div>

              <div class="form-group2 col-md-6">
                  <label for="usr">{{ __('lang.usage_limit')}} :</label>
                  <input type="number"  class="form-control " name="usage_limit" value="{{old('usage_limit',$coupon->usage_limit)}}">
              </div>

              <div class="mb-3 col-md-6 form-group2">
                  <label for="is_active" class="form-label">{{__('lang.activate Category')}}</label>
                  <select name="is_active" class="form-control">
                      <option value="1" {{$coupon->is_active ? 'selected' : '' }}>{{__('lang.active')}}</option>
                      <option value="0" {{ !$coupon->is_active ? 'selected' : '' }}>{{__('lang.inactive')}}</option>
                  </select>
              </div>
                <div class="col-9"></div>

                <div class="col-3"><button type="submit" class="btn btn-warning btn-block"><i class="fas fa-edit"></i>{{__('lang.Save')}}</button></div>
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
