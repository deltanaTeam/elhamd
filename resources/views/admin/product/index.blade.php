@extends('admin.layouts.master')

@section('title', 'إدارة المنتجات')

@section('content')
<div class="container-fluid">
    <div class="card shadow-lg">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0">قائمة المنتجات</h5>
            <a href="{{ route('admin.products.create') }}" class="btn btn-light">
                <i class="fas fa-plus"></i> إضافة منتج
            </a>
        </div>
        
        <div class="card-body">
            
            <div class="table-responsive">
                <table class="table table-hover table-striped" id="products-table">
                    <thead class="table-dark">
                        <tr>
                            <th width="5%">#</th>
                            <th width="15%">الصورة</th>
                            <th>الاسم</th>
                            <th>العلامة التجارية</th>
                            <th>السعر</th>
                            <th>الكمية</th>
                            <th>الحالة</th>
                            <th width="15%">الإجراءات</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($products as $product)
                        <tr>
                            <td>{{ $product->id }}</td>
                            <td>
                                <img src="{{ $product->image_url }}" alt="{{ $product->name }}" 
                                     class="img-thumbnail" width="60" height="60">
                            </td>
                            <td>{{ $product->name }}</td>
                            <td>{{ $product->brand->name ?? 'N/A' }}</td>
                            <td>{{ number_format($product->price, 2) }} ر.س</td>
                            <td>
                                <span class="badge bg-{{ $product->quantity > 0 ? 'success' : 'danger' }}">
                                    {{ $product->quantity }}
                                </span>
                            </td>
                            <td>
                                <span class="badge bg-{{ $product->status ? 'success' : 'secondary' }}">
                                    {{ $product->status ? 'نشط' : 'غير نشط' }}
                                </span>
                            </td>
                            <td>
                                <div class="btn-group" role="group">
                                    <a href="{{ route('admin.products.edit', $product->id) }}" 
                                       class="btn btn-sm btn-outline-primary">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger"
                                                onclick="return confirm('هل أنت متأكد؟')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                
                <!-- Pagination -->
                <div class="d-flex justify-content-center mt-4">
                    {{ $products->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script type="module">
    import 'datatables.net-bs5';
    
    $(document).ready(function() {
        $('#products-table').DataTable({
            responsive: true,
            paging: false, // نعتمد على Laravel Pagination
            info: false,
            language: {
                url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/ar.json'
            }
        });
    });
</script>
@endpush