@extends('admin.layout.content')

@section('main-content')
    <div class="col-12 col-lg-9">
        <div class="ibox float-e-margins" id="boxOrder">
            <div class="ibox-content">
                <h3 class="text-qr Rest-dark text-center p-2">
                    <a href="{{ route('employee.index')}}" class="btn btn-outline btn-primary btn-sm float-left">
                        <i class="fa fa-long-arrow-left mt-1"></i>
                    </a>
                    Tạo nhân viên
                </h3>
                <hr>
                <form method="POST" action="{{ route('employee.create') }}" enctype="multipart/form-data" id="create_categories">

                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Tên nhân viên</label>
                        <input type="text" name="name" class="form-control"  value="{{ old('name') }}">
                        @error('name')
    <span class="text-danger">{{ $message }}</span>
@enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Số điện thoại</label>
                        <input type="text" name="phone" class="form-control" value="{{ old('phone') }}">
                        @error('phone')
    <span class="text-danger">{{ $message }}</span>
@enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Địa chỉ</label>
                        <input type="text" name="address" class="form-control" value="{{ old('address') }}">
                        @error('address')
    <span class="text-danger">{{ $message }}</span>
@enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Vị trí</label>
                        <input type="text" name="position" class="form-control" value="{{ old('position') }}">
                      @error('position')
    <span class="text-danger">{{ $message }}</span>
@enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Ca làm việc</label>
                        <input type="text" name="shift" class="form-control" value="{{ old('shift') }}">
                          @error('shift')
                          <span class="text-danger">{{ $message }}</span>
                      @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Ngày tuyển dụng</label>
                        <input type="date" name="hire_date" class="form-control" value="{{ old('hire_date') }}">
                        @error('hire_date')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror

                    </div>

                    <button type="submit" class="btn btn-primary mr-2" id="btn_create_category">Thêm</button>
                    <button type="reset" class="btn btn-primary">Tạo lại</button>
                </form>
            </div>
        </div>
    </div>
@endsection
