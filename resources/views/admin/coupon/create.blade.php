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
                    Create Coupon
                </h3>
                <hr />
                <input hidden value="Completed" id="lblCompleted" />
                <input hidden value="2" id="txtTableId" />

                <div class="col-md-12">
                    <div id="form-errors" class="text-danger"></div>
                    <form method="POST" autocomplete="off" id="coupon_create_form" onsubmit="saveCouponForm(event)">
                        @csrf
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" class="form-control" name="name" id="name_coupon"
                                value="{{ old('name') }}" placeholder="Enter coupon name">
                            <span class="text-danger name_err formErrors"></span>
                        </div>

                        <div class="form-group">
                            <label>Code</label>
                            <input type="text" class="form-control" name="code" id="code_coupon"
                                value="{{ old('code') }}" placeholder="Enter code coupon">
                            <span class="text-danger code_err formErrors"></span>
                        </div>


                        <div class="form-group">
                            <label>Quantity</label>
                            <input type="text" class="form-control" name="quantity" id="quantity_coupon"
                                value="{{ old('quantity') }}" placeholder="Enter quantity coupon">
                            <span class="text-danger quantity_err formErrors"></span>
                        </div>



                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Start Date</label>
                                    <input type="date" class="form-control datepicker" id="start_date_coupon"
                                        name="start_date" value="{{ old('start_date') }}" placeholder="yyyy-mm-dd">

                                    <span class="text-danger start_date_err formErrors"></span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>End Date</label>
                                    <input type="date" class="form-control datepicker" id="end_date_coupon"
                                        name="end_date" value="{{ old('end_date') }}" placeholder="yyyy-mm-dd">
                                    <span class="text-danger end_date_err formErrors"></span>
                                </div>
                            </div>

                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="inputState">Discount Type</label>
                                    <select id="inputState discount_type_coupon" class="form-control" name="discount_type">
                                        <option value="percent">Percentage (%)</option>
                                        <option value="amount">Amount ($)</option>
                                    </select>

                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label>Discount Value</label>
                                    <input type="text" class="form-control" id="discount_coupon" name="discount"
                                        value="{{ old('discount') }}" placeholder="discount">
                                    <span class="text-danger discount_err formErrors"></span>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputState">Status</label>
                            <select id="inputState" class="form-control" name="status">
                                <option value="1" selected>Active</option>
                                <option value="0">Inactive</option>
                            </select>

                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary" id="add_coupon_btn">Create coupon</button>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        function saveCouponForm(e) {
            e.preventDefault();

            var couponDate = $('#coupon_create_form')[0];
            var couponDateData = new FormData(couponDate);


            $.ajax({
                method: "POST",
                url: "{{ route('coupons.store') }}",
                data: couponDateData,
                cache: false,
                contentType: false,
                processData: false,
                dataType: 'json',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    if (response.status == 'success') {
                        toastr.success(response.message)
                        $("#add_coupon_btn").text('Create coupon');
                        $("#coupon_create_form")[0].reset();
                        window.location.reload();
                    }
                },
                error: function(error) {
                    var formErr = error.responseJSON.errors;
                    console.log(error);
                    for (var err in formErr) {
                        $('.' + err + '_err').html(formErr[err][0]);
                    }
                }
            })
        }
    </script>
@endpush
