@extends('admin.layout.content')

@section('main-content')
    <div class="col-12 col-lg-9">
        <div class="ibox float-e-margins" id="boxOrder">
            <div class="ibox-content">
                <div class="sk-spinner sk-spinner-wave">
                    <div class="sk-rect1"></div>
                    <div class="sk-rect2"></div>
                    <div class="sk-rect3"></div>
                    <div class="sk-rect4"></div>
                    <div class="sk-rect5"></div>
                </div>
                <h3 class="text-qr Rest-dark text-center p-2">
                    <a href="{{ route('products-variant-item.index', ['productId' => $product->id, 'variantId' => $variant->id]) }}"
                        class="btn btn-outline btn-primary btn-sm float-left">
                        <i class="fa fa-long-arrow-left mt-1"></i>
                    </a>
                    Thêm Biến Thể Chi Tiết
                </h3>
                <hr />
                <input hidden value="Completed" id="lblCompleted" />
                <input hidden value="2" id="txtTableId" />

                <div class="col-md-12">
                    <form action="{{ route('products-variant-item.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label>Tên biến thể</label>
                            <input type="text" class="form-control" name="variant_name" value="{{ $variant->name }}"
                                readonly>
                        </div>

                        <div class="form-group">
                            <input type="hidden" class="form-control" name="variant_id" value="{{ $variant->id }}">
                        </div>
                        <div class="form-group">
                            <input type="hidden" class="form-control" name="product_id" value="{{ $product->id }}">
                        </div>

                        <div class="form-group">
                            <label>Tên item</label>
                            <input type="text" class="form-control" name="name" value="{{ old('name') }}">
                        </div>

                        <div class="form-group">
                            <label>Giá <code>(Đặt 0 để làm cho nó miễn phí)</code></label>
                            <input type="text" class="form-control" name="price" value="{{ old('price') }}">
                        </div>


                        <button type="submmit" class="btn btn-primary">Thêm</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
