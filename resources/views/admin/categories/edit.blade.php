@extends('admin.layouts.master')
@section('title', __('lang.edit categoey'))


@section('content')
 @include('admin.style')

 <div class="row" dir="rtl">
   <div class="col-xxl-12 order-2 order-xxl-1">
      <!--begin::Advance Table Widget 2-->
      <div class="card card-custom card-stretch gutter-b p-2 bg-light-info border border-light">
          <!--begin::Header-->
          <div class="cart-header p-5 bg-warning rounded  m-5">
            <b  class="text-light  font-weight-bolder  h3 align-items-center ">
              {{__('lang.edit category')}}
            </b>
          </div>
          <div class="card-body bg-light-info">


            @include('admin.session')
            <form action="{{ route('admin.categories.update',$category->id) }}" method="POST" class="row">
                @csrf
                @method('PUT')
                <div class="mb-3 col-md-6 form-group2">
                    <label class="block">{{__('lang.name_en')}} <span class="required">*</span> :</label>
                    <input type="text" name="name_en" class="form-control " value="{{old('name_en',$category->getTranslations('name')['en']??'')}}">

                </div>
                <div class="mb-3 col-md-6 form-group2">
                    <label class="block">{{__('lang.name_ar')}} <span class="required">*</span> :</label>
                    <input type="text" name="name_ar" class="form-control " value="{{old('name_ar',$category->getTranslations('name')['ar']??'')}}">
                </div>

                <div class="mb-3 col-md-6 form-group2">
                    <label class="block">{{__('lang.description_en')}} <span class="required">*</span> :</label>
                    <input type="text" name="description_en" class="form-control " value="{{old('description_en',$category->getTranslations('reason')['en']??'')}}">

                </div>
                <div class="mb-3 col-md-6 form-group2">
                    <label class="block">{{__('lang.description_ar')}} <span class="required">*</span> :</label>
                    <input type="text" name="description_ar" class="form-control " value="{{old('description_ar',$category->getTranslations('reason')['ar']??'')}}">
                </div>

                <div class="mb-3 col-md-12 form-group2">
                    <label class="block">{{__('lang.position')}} <span class="required">*</span> :</label>
                    <input type="number" name="position" class="form-control " value="{{ old('position',$category->position) }}">
                </div>

                <div class="mb-3 col-md-6 form-group2">
                    <label for="is_active" class="form-label">{{__('lang.activate Category')}}</label>
                    <select name="is_active" class="form-control">
                        <option value="1" {{ $category->is_active ? 'selected' : '' }}>{{__('lang.active')}}</option>
                        <option value="0" {{ !$category->is_active ? 'selected' : '' }}>{{__('lang.inactive')}}</option>
                    </select>
                </div>

                <div class="mb-3 col-md-6 form-group2">
                    <label for="status" class="form-label">{{__('lang.status')}}</label>
                    <select name="status" class="form-control">
                        <option value="pending" {{ $category->status === "pending" ? 'selected' : '' }} >{{__('lang.pending')}}</option>
                        <option value="approved" {{ $category->status ==="approved" ?'selected' : '' }}>{{__('lang.approved')}}</option>
                        <option value="rejected" {{ $category->status ==="rejected" ?'selected' : '' }}>{{__('lang.rejected')}}</option>
                        <option value="admin_insert" {{ $category->status ==="admin_insert"? 'selected' : '' }}>{{__('lang.admin_insert')}}</option>

                    </select>
                </div>
                <div class="mb-3 col-md-6 form-group2">
                    <label class="Banzima-check-container">

                       {{ __('lang.show_home')}}

                      <input type="checkbox" name="show_home" value="show_home"  {{ $category->show_home ? 'checked' : '' }} id="show_home">
                      <span class="banzima-check-checkmark"></span>
                    </label>
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
