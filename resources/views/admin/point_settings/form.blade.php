@extends('admin.layouts.master')
@section('title', __('lang.create PointSetting'))


@section('content')
 @include('admin.style')

 <div class="row" dir="rtl">
   <div class="col-xxl-12 order-2 order-xxl-1">
      <!--begin::Advance Table Widget 2-->
      <div class="card card-custom card-stretch gutter-b p-2 bg-light-info border border-light">
          <!--begin::Header-->
          <div class="cart-header p-5 bg-secondary rounded  m-5">
            <b  class="text-dark  font-weight-bolder  h3 align-items-center ">
              {{__('lang.create PointSetting')}}
            </b>
          </div>
          <div class="card-body bg-light-info">


            @include('admin.session')
            <form action="{{ route('admin.point-settings.store') }}" method="POST" class="row">
                @csrf


                <div class="mb-3 col-md-6 form-group2">
                    <label for="earning_rate" class="form-label">{{__('lang.pointing rate when purchase')}}</label>
                    <input type="number" step="0.01" min="0" name="earning_rate" class="form-control" value="{{ old('earning_rate') }}">
                </div>

                <div class="mb-3 col-md-6 form-group2">
                    <label for="redeem_rate" class="form-label">{{__('lang.rate to convert points into a balance')}}</label>
                    <input type="number" step="0.0001" min="0" max="1" name="redeem_rate" class="form-control" value="{{ old('redeem_rate') }}">
                </div>

                <div class="mb-3 col-md-12 form-group2">
                    <label for="is_active" class="form-label">{{__('lang.activate points')}}</label>
                    <select name="is_active" class="form-control">
                        <option value="1" >{{__('lang.active')}}</option>
                        <option value="0" >{{__('lang.inactive')}}</option>
                    </select>
                </div>

                <div class="col-9"></div>

                <div class="col-3"><button type="submit" class="btn btn-success btn-block"><i class="fas fa-plus"></i> {{__('lang.Save')}} </button></div>
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
