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
                <a href="/restaurant-manager" class="btn btn-outline btn-primary btn-sm float-left">
                    <i class="fa fa-long-arrow-left mt-1"></i>
                </a>
                Flash Sale
            </h3>
            <hr />
            <input hidden value="Completed" id="lblCompleted" />
            <input hidden value="2" id="txtTableId" />


            {{-- http://127.0.0.1:8000/order/menu?tableId=6&tableNo=6 --}}

            <div class="col-md-12 mt-4">
                <h4>Thêm sản phẩm Flash Sale</h4>
                {{-- {{ route('flash-sale.add-product') }} --}}
                <form onsubmit="addFlashSaleItem(event)" id="form_flash_sale_add_product" method="post" autocomplete="off">
                    @csrf
                    <div class="form-group">
                        <label>Sản phẩm</label>
                        <select name="product_id[]" multiple class="form-control select2">
                            <option value="">Chọn</option>
                            @foreach ($products as $product)
                            <option value="{{ $product->id }}">{{ $product->name }}</option>
                            @endforeach

                        </select>
                        <span class="text-danger product_id_err formErrors"></span>


                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Ngày bắt đầu</label>
                                <input type="date" name="start_date" value="{{ old('start_date') }}" class="form-control">

                                <span class="text-danger start_date_err formErrors"></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Ngày kết thúc</label>
                                <input type="date" name="end_date" value="{{ old('end_date') }}" class="form-control">

                                <span class="text-danger end_date_err formErrors"></span>
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Tỷ lệ chiết khấu (%)</label>
                                <input type="text" name="discount_rate" value="{{ old('discount_rate') }}" class="form-control">

                                <span class="text-danger discount_rate_err formErrors"></span>
                            </div>
                        </div>
                        {{-- <div class="col-md-6">
                            <div class="form-group">
                                <label>Trạng thái</label>
                                <select name="status" id="" class="form-control">
                                    <option value="1" selected>Hoạt động</option>
                                    <option value="0">Không hoạt động</option>
                                </select>


                            </div>
                        </div> --}}
                    </div>
                    <button type="submit" class="btn btn-primary">Lưu</button>
                </form>
            </div>


            <div class="col-md-12 mt-4">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Tất cả sản phẩm Flash Sale</h4>


                            </div>
                            <form action="{{ route('flash-sale.deleteAll') }}" method="post">
                                @csrf
                                <div class="card-body">
                                    <table id="myTable" class="table table-responsive-md mb-0">
                                        <thead>
                                            <tr>
                                                <th>
                                                    <input type="checkbox" name="checkAll" class="checkContainer">
                                                </th>
                                                <th>STT</th>
                                                <th>Sản phẩm</th>
                                                <th>Ngày bắt đầu</th>
                                                <th>Ngày kết thúc</th>
                                                <th>Tỷ lệ chiết khấu</th>
                                                {{-- <th>Trạng thái</th> --}}
                                                <th> <button type="submit" class="btn btn-danger">Delete</button></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($flashSaleItem as $item)
                                            <tr>
                                                <td>
                                                    <input type="checkbox" name="list_check[]" class="checkItem" value="{{ $item->id }}">
                                                </td>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $item->product->name }}</td>
                                                <td>{{ $item->start_date }}</td>
                                                <td>{{ $item->end_date }}</td>
                                                <td>{{ $item->discount_rate }}(%)</td>
                                                {{-- <td>

                                                    <form action="" method="get">
                                                        <select class="form-control change-status-flash-sale" name="status" id="{{ $item->id }}">

                                                            <option value="1" {{ $item->status == 1 ? 'selected' : '' }}>
                                                                Hoạt động
                                                            </option>
                                                            <option value="0" {{ $item->status == 0 ? 'selected' : '' }}>
                                                                Không hoạt động
                                                            </option>
                                                        </select>
                                                    </form>
                                                </td> --}}
                                                <td>
                                                    <a href="{{ route('flash-sale.destory', $item->id) }}" class="btn btn-danger ml-2 delete-item"><i class="fa-solid fa-trash-can"></i></a>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>

                                </div>



                            </form>



                        </div>
                    </div>
                </div>
            </div>
        </div>



    </div>
</div>
@endsection

@push('scripts')
<script>
    let table = new DataTable('#myTable', {
        responsive: true
    });
</script>

<script>
    function addFlashSaleItem(e) {
        e.preventDefault();
        var flashSaleItemForm = $('#form_flash_sale_add_product')[0];
        var flashSaleItemData = new FormData(flashSaleItemForm);
        $.ajax({
            method: "POST",
            url: "{{ route('flash-sale.add-product') }}",
            data: flashSaleItemData,
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

                    $("#form_flash_sale_add_product")[0].reset();
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
<script>
    $(document).ready(function() {
        $('body').on('change',
            '.change-status-flash-sale',
            function() {
                let status = $(this).find(':selected').val();
                let id = $(this).attr('id');
                $.ajax({
                    url: "{{ route('flash-sale-status') }}",
                    method: 'GET',
                    data: {
                        id: id,
                        status: status
                    },
                    success: function(data) {
                        toastr.success(data.message)
                    },
                    error: function(xhr, status, error) {
                        console.log(error);
                    }
                })
            })
    })
</script>
<script>
    $(".checkContainer").click(function() {
        var checked = $(this).is(':checked');
        $('.checkItem').prop('checked', checked);
    })
</script>
@endpush