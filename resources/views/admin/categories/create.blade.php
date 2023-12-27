@extends('admin.layout.content')

@section('main-content')
    <div class="col-12 col-lg-9">
        <div class="ibox float-e-margins" id="boxOrder">
            <div class="ibox-content">
                <h3 class="text-qr Rest-dark text-center p-2">
                    <a href="/category" class="btn btn-outline btn-primary btn-sm float-left">
                        <i class="fa fa-long-arrow-left mt-1"></i>
                    </a>
                    Thêm Danh Mục
                </h3>
                <hr>
                <form method="POST" action="{{ route('category.store') }}" enctype="multipart/form-data" id="create_categories">
                    @method('POST')
                    @csrf
                    <div class="mb-3">
                        <label class="font-weight-bold" >Tên Danh Mục</label>
                        <input type="text" name="category_name" class="form-control" placeholder="Nhập tên...">
                        <div class="form-text" id="category_name" style="color: red"></div>
                        @error('category_name')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="font-weight-bold" for="note">Ghi Chú</label>
                        <input type="text" name="note" class="form-control" placeholder="Nhập ghi chú...">
                        <div class="form-text" id="note" style="color: red"></div>
                        @error('note')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="font-weight-bold" for="status">Trạng Thái</label>
                        <select id="status" name="status"  class="form-control">
                            <option selected disabled value="" >Chọn...</option>
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                        </select>
                        @error('status')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="font-weight-bold">Hình Ảnh</label>
                        <img id="image_preview" src="https://www.freeiconspng.com/uploads/img-landscape-photo-photography-picture-icon-12.png" alt="Product image" style="height:100px" >
                        <input type="file" name="image" accept="image/*" class="@error('image') is-invalid @enderror" id="image"> <br>
                        @error('image')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary mr-2" id="btn_create_category">Lưu</button>
                    <button type="reset" class="btn btn-primary mr-2">Đặt lại</button>
                </form>
            </div>
        </div>
    </div>
@endsection
