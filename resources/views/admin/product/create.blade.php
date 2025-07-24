@extends('admin.layouts.master')

@section('title', __('lang.create_product'))

@section('sub-topbar')
<div class=" ">
  <ul class="nav d-flex justify-content-start ">
    <li class="nav-item mx-3 pt-2 ">
       <b class="text-primary font-weight-bolder h3 align-items-center ">
         {{__('lang.create_product')}}
       </b>
    </li>
  </ul>
</div>
@endsection

@section('content')
 @include('admin.style')

 <style media="screen">
 .form-group label {
   font-weight: bold;
 }
 </style>

 <div class="row" dir="rtl">
   <div class="col-xxl-12 order-2 order-xxl-1">
      <!--begin::Card-->
      <div class="card card-custom card-stretch gutter-b p-2">
          <div class="card-body bg-light-info">
            @include('admin.session')
            <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="pharmacy_id" value="1">

                <!-- اسم المنتج -->
                <div class="form-group">
                    <label for="name">{{ __('lang.name') }}</label>
                    <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
                </div>

                <!-- السعر -->
                <div class="form-group">
                    <label for="price">{{ __('lang.price') }}</label>
                    <input type="number" name="price" class="form-control" value="{{ old('price') }}" required>
                </div>

                <!-- معدل الضريبة -->
                <div class="form-group">
                    <label for="tax_rate">{{ __('lang.tax_rate') }}</label>
                    <input type="number" name="tax_rate" class="form-control" value="{{ old('tax_rate') }}" required>
                </div>

                <!-- الفئة -->
                <div class="form-group">
                    <label for="category">{{ __('lang.category') }}</label>
                    <select name="category_id" class="form-control" required>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- العلامة التجارية -->
                <div class="form-group">
                    <label for="brand">{{ __('lang.brand') }}</label>
                    <select name="brand_id" class="form-control" required>
                        @foreach($brands as $brand)
                            <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- الكمية -->
                <div class="form-group">
                    <label for="quantity">{{ __('lang.quantity') }}</label>
                    <input type="number" name="quantity" class="form-control" value="{{ old('quantity') }}" min="0">
                </div>

                <!-- الحد الأدنى للمخزون -->
                <div class="form-group">
                    <label for="min_stock">{{ __('lang.min_stock') }}</label>
                    <input type="number" name="min_stock" class="form-control" value="{{ old('min_stock') }}" min="0">
                </div>

                <!-- رقم الدُفعة -->
                <div class="form-group">
                    <label for="batch_number">{{ __('lang.batch_number') }}</label>
                    <input type="text" name="batch_number" class="form-control" value="{{ old('batch_number') }}" required>
                </div>

                <!-- شروط التخزين -->
                <div class="form-group">
                    <label for="storage_conditions">{{ __('lang.storage_conditions') }}</label>
                    <input type="text" name="storage_conditions" class="form-control" value="{{ old('storage_conditions') }}">
                </div>

                <!-- وصفة طبية مطلوبة؟ -->
                <div class="form-group">
                    <label for="prescription_required">{{ __('lang.prescription_required') }}</label>
                    <input type="checkbox" name="prescription_required" value="1" {{ old('prescription_required') ? 'checked' : '' }}>
                </div>

              <div class="form-group">
    <label for="production_date">{{ __('lang.production_date') }}</label>
    <input type="date" name="production_date" class="form-control" id="production_date">
</div>

<div class="form-group">
    <label for="expiry_date">{{ __('lang.expiry_date') }}</label>
    <input type="date" name="expiry_date" class="form-control" id="expiry_date">
</div>

<script>
    // تعيين التاريخ الحالي تلقائيًا عند تحميل الصفحة
    document.getElementById('production_date').value = new Date().toISOString().split('T')[0];
    document.getElementById('expiry_date').value = new Date().toISOString().split('T')[0];
</script>

                <!-- الصور -->
                <div class="form-group">
                    <label for="images">{{ __('lang.images') }}</label>
                    <input type="file" name="images[]" class="form-control" multiple>
                </div>

                <button type="submit" class="btn btn-success">{{ __('lang.save') }}</button>
            </form>
          </div>
      </div>
    </div>
 </div>
@endsection

@section('script')
@include('admin.scripts')
@endsection
