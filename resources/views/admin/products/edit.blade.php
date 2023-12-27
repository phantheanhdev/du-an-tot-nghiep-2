@extends('admin.layout.content')

@section('main-content')
    <div class="col-12 col-lg-9">
        <div class="ibox float-e-margins" id="boxOrder">
            <div class="ibox-content">
                <h3 class="text-qr Rest-dark text-center p-2">
                    <a href="/product" class="btn btn-outline btn-primary btn-sm float-left">
                        <i class="fa fa-long-arrow-left mt-1"></i>
                    </a>
                    Sửa Thực Đơn
                </h3>
                <hr>
                <form method="POST" action="{{ route('product.edit', ['id' => $product->id]) }}"
                    enctype="multipart/form-data" id="edit_product">
                    @method('POST')
                    @csrf

                    <div class="row">
                        <div class="mb-3 col-12 col-md-6">
                            <label class="font-weight-bold" class="form-label">Tên</label>
                            <input type="text" name="name" class="form-control" placeholder="Nhập tên..." value="{{ $product->name }}">
                            <div class="form-text" id="name" style="color: red"></div>
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3 col-12 col-md-6">
                            <label class="font-weight-bold" class="form-label">Giá</label>
                            <input type="number" name="price" placeholder="0" min="0" step="any" class="form-control"
                                value="{{ $product->price }}">
                            <div class="form-text" id="price" style="color: red"></div>
                            @error('price')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="font-weight-bold" class="form-label">Sự Miêu Tả</label>
                        <textarea name="description" class="form-control" placeholder="Nhập miêu tả...">{{ $product->description }}</textarea>
                        <div class="form-text" id="description" style="color: red"></div>
                        @error('description')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="row">
                        <div class="mb-3 col-6">
                            <label class="font-weight-bold" class="form-label" for="category_id">Danh Mục</label>
                            <select id="category_id" name="category_id" class="form-control"1>
                                <option selected disabled value="">Chọn...</option>
                                @foreach ($category as $category)
                                    <option value="{{ $category->id }}"
                                        {{ $product->category_id == $category->id ? 'selected' : '' }}>
                                        {{ $category->category_name }}
                                    </option>
                                @endforeach
                            </select>
                            <div class="form-text" id="category_id" style="color: red"></div>
                            @error('category_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3 col-6">
                            <label class="font-weight-bold" class="form-label" for="status">Trạng Thái</label>
                            <select id="status" name="status" class="form-control">
                                <option selected disabled value="">Chọn...</option>
                                <option value="active" {{ $product->status == 'active' ? 'selected' : '' }}>Active</option>
                                <option value="inactive" {{ $product->status == 'inactive' ? 'selected' : '' }}>Inactive
                                </option>
                            </select>
                            <div class="form-text" id="status" style="color: red"></div>
                            @error('status')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="font-weight-bold" class="form-label">Hình Ảnh</label>
                        <input id="image" type="file"
                            class="form-control image-file @error('image') is-invalid @enderror" name="image"
                            accept="image/*">
                        <br>
                        <img id="image_preview"
                            src="{{ $product->image ? Storage::url($product->image) : 'https://www.freeiconspng.com/uploads/img-landscape-photo-photography-picture-icon-12.png' }}"
                            alt="" width="100px" height="100px"> <br>
                        @error('image')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary mr-2" id="btn_edit_product">Lưu</button>
                    <button type="reset" class="btn btn-primary">Đặt Lại</button>
                </form>
            </div>
        </div>
    </div>
@endsection
