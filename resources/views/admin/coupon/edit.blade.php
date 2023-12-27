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
                    <a href="{{ route('coupons.index') }}" class="btn btn-outline btn-primary btn-sm float-left">
                        <i class="fa fa-long-arrow-left mt-1"></i>
                    </a>
                    Update Coupon
                </h3>
                <hr />
                <input hidden value="Completed" id="lblCompleted" />
                <input hidden value="2" id="txtTableId" />

                <div class="col-md-12">
                    <form action="{{ route('coupons.update' , $coupon->id) }}" method="POST" autocomplete="off" id="coupon_create_form">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" class="form-control" name="name" id="name_coupon"
                            value="{{ $coupon->name }}" placeholder="Enter coupon name">
                            @error('name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                        </div>

                        <div class="form-group">
                            <label>Code</label>
                            <input type="text" class="form-control" name="code" id="code_coupon"
                            value="{{ $coupon->code }}" placeholder="Enter code coupon">
                            @error('code')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                        </div>


                        <div class="form-group">
                            <label>Quantity</label>
                            <input type="number" class="form-control" name="quantity" id="quantity_coupon"
                            value="{{ $coupon->quantity }}" placeholder="Enter quantity coupon">
                            @error('quantity')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                        </div>



                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Start Date</label>
                                    <input type="date" class="form-control datepicker" id="start_date_coupon"
                                        name="start_date" value="{{ $coupon->start_date }}" placeholder="yyyy-mm-dd">
                                        @error('start_date')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>End Date</label>
                                    <input type="date" class="form-control datepicker" id="end_date_coupon"
                                        name="end_date" value="{{ $coupon->end_date }}" placeholder="yyyy-mm-dd">
                                        @error('end_date')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="inputState">Discount Type</label>
                                    <select id="inputState discount_type_coupon" class="form-control" name="discount_type">
                                        <option {{ $coupon->discount_type == 'percent' ? 'selected' : '' }}
                                            value="percent">Percentage (%)</option>
                                        <option {{ $coupon->discount_type == 'amount' ? 'selected' : '' }}
                                            value="amount">Amount ($)</option>
                                    </select>

                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label>Discount Value</label>
                                    <input type="text" class="form-control" id="discount_coupon" name="discount"
                                    value="{{ $coupon->discount }}" placeholder="discount">
                                    @error('discount')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputState">Status</label>
                            <select id="inputState" class="form-control" name="status">
                                <option {{ $coupon->status == 1 ? 'selected' : '' }} value="1">Active</option>
                                        <option {{ $coupon->status == 0 ? 'selected' : '' }} value="0">Inactive
                            </select>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary" id="add_coupon_btn">Update coupon</button>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection


