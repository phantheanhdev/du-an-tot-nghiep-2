@extends('admin.layout.content')

@section('main-content')
    <div class="col-12 col-lg-9">
        <div class="ibox float-e-margins" id="boxOrder">
            <div class="ibox-content">
                <h3 class="text-qr Rest-dark text-center p-2">
                    <a href="/category" class="btn btn-outline btn-primary btn-sm float-left">
                        <i class="fa fa-long-arrow-left mt-1"></i>
                    </a>
                    Sửa danh mục
                </h3>
                <hr>
                <form method="POST" action="{{ route('category.edit', ['id' => $category->id]) }}" enctype="multipart/form-data" id="create_categories">
                    @method('POST')
                    @csrf
                    <div class="mb-3">
                        <label class="font-weight-bold">Tên Danh Mục</label>
                        <input type="text" name="category_name" class="form-control"placeholder="Nhập tên danh mục..." value="{{ $category->category_name }}">
                        <div class="form-text" id="category_name" style="color: red"></div>
                        @error('category_name')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="font-weight-bold">Ghi Chú</label>
                        <input type="text" name="note" class="form-control" placeholder="Nhập ghi chú..." value="{{ $category->note }}">
                        <div class="form-text" id="note" style="color: red"></div>
                        @error('note')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="font-weight-bold" for="status">Trạng Thái</label>
                        <select id="status" name="status" class="form-control">
                            <option selected disabled value="">Chọn...</option>
                            <option value="active" {{ $category->status == 'active' ? 'selected' : '' }}>Active</option>
                            <option value="inactive" {{ $category->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
                        </select>
                        @error('status')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="font-weight-bold">Hình Ảnh</label>
                        <input id="image" type="file"
                        class="form-control image-file @error('category_image') is-invalid @enderror"
                        name="image" accept="image/*"><br>
                    <img id="image_preview"
                        src="{{ $category->image ? Storage::url($category->image) : 'https://www.freeiconspng.com/uploads/img-landscape-photo-photography-picture-icon-12.png' }}"
                        alt="" width="100px" height="100px"> <br>
                        @error('image')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary mr-2" id="btn_create_category">Lưu</button>
                    <button type="reset" class="btn btn-primary">Đặt lại</button>
                </form>
            </div>
        </div>
    </div>
@endsection
