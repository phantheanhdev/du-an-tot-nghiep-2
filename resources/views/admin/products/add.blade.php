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
                    <a href="/product" class="btn btn-outline btn-primary btn-sm float-left">
                        <i class="fa fa-long-arrow-left mt-1"></i>
                    </a>
                    Thêm Thực Đơn
                </h3>
                <hr />
                <input hidden value="Completed" id="lblCompleted" />
                <input hidden value="2" id="txtTableId" />

                <div class="col-md-12">
                    <form action="{{ route('create') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="row">
                            <div class="form-group col-12 col-md-6">
                                <label class="font-weight-bold" for="name">Tên</label>
                                <input type="text" name="name" id="name" placeholder="Nhập tên..." class="form-control">
                                @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group col-12 col-md-6">
                                <label class="font-weight-bold" for="price">Giá</label>
                                <input type="number" name="price" id="price" placeholder="0" min="0" step="any"
                                    class="form-control">
                                @error('price')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="font-weight-bold" for="description">Sự Miêu Tả</label>
                            <textarea name="description" id="description" class="form-control" placeholder="Nhập miêu tả..."></textarea>
                            @error('description')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="form-group col-6">
                                <label class="font-weight-bold" for="category">Danh Mục</label>
                                <select name="category_id" id="category" class="form-control">
                                    <option selected disabled value="">Chọn...</option>
                                    @foreach ($category as $detail)
                                        <option value="{{ $detail->id }}">{{ $detail->category_name }}</option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group col-6">
                                <label  class="font-weight-bold" for="status">Trạng Thái</label>
                                <select name="status" id="status" class="form-control">
                                    <option selected disabled value="">Chọn...</option>
                                    <option value="active">Active</option>
                                    <option value="inactive">Inactive</option>
                                </select>
                                @error('status')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-3">
                            <label  class="font-weight-bold" class="form-label mr-5">Hình Ảnh</label>
                            <img id="image_preview"
                                src="https://www.freeiconspng.com/uploads/img-landscape-photo-photography-picture-icon-12.png"
                                alt="Product image" style="height:100px" class="mr-3">

                            <input type="file" name="image" accept="image/*"
                                class="@error('image') is-invalid @enderror" id="image"> <br>
                            @error('image')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Lưu</button>
                            <button type="reset" class="btn btn-primary">Đặt lại</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
