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
                <input hidden value="Table No" id="lblTableNo" />
                <input hidden value="1" id="lblRestaurantId" />
                <input hidden value="You have a new order!" id="lblNewOrderMessage" />
                <input hidden value="Have a new order" id="lblNewOrderNotification" />
                <input hidden value="The waiter has been called." id="lblCallWaiter" />
                <input hidden value="Invoice is requested" id="lblCallBill" />

                <h3 class="text-qrRest-dark text-center">Thống kê</h3>

                <hr />


                <div class="col-md-12">
                    {{-- <h4 class="page-title">Doanh thu</h4> --}}

                    <div class="row">
                        <div class="col-sm-3 mt-2">
                            <div class="card widget-flat">
                                <div class="card-body">
                                    <div class="float-end">
                                        <i class="mdi mdi-account-multiple widget-icon"></i>
                                    </div>
                                    <h5 class="text-muted fw-normal mt-0" title="Number of Customers">Tổng đơn hôm nay</h5>
                                    <h3 class="mt-3 mb-3">{{ $todaysOrder }}</h3>
                                </div> <!-- end card-body-->
                            </div> <!-- end card-->
                        </div> <!-- end col-->

                        <div class="col-sm-3 mt-2">
                            <div class="card widget-flat">
                                <div class="card-body">
                                    <div class="float-end">
                                        <i class="mdi mdi-cart-plus widget-icon"></i>
                                    </div>
                                    <h5 class="text-muted fw-normal mt-0" title="Number of Orders">Đơn chờ xử lý</h5>
                                    <h3 class="mt-3 mb-3">{{ $totalPendingOrders }}</h3>
                                </div> <!-- end card-body-->
                            </div> <!-- end card-->
                        </div> <!-- end col-->

                        <div class="col-sm-3 mt-2">
                            <div class="card widget-flat">
                                <div class="card-body">
                                    <div class="float-end">
                                        <i class="mdi mdi-account-multiple widget-icon"></i>
                                    </div>
                                    <h5 class="text-muted fw-normal mt-0" title="Number of Customers">Đơn đã hoàn thành hôm
                                        nay</h5>
                                    <h3 class="mt-3 mb-3">{{ $totalCompleteOrders }}</h3>
                                </div> <!-- end card-body-->
                            </div> <!-- end card-->
                        </div> <!-- end col-->

                        <div class="col-sm-3 mt-2">
                            <div class="card widget-flat">
                                <div class="card-body">
                                    <div class="float-end">
                                        <i class="mdi mdi-cart-plus widget-icon"></i>
                                    </div>
                                    <h5 class="text-muted fw-normal mt-0" title="Number of Orders">Đơn hủy hôm nay</h5>
                                    <h3 class="mt-3 mb-3">{{ $totalCancelOrders }}</h3>
                                </div> <!-- end card-body-->
                            </div> <!-- end card-->
                        </div> <!-- end col-->

                    </div> <!-- end row -->

                    <div class="row mt-2 ">
                        <div class="col-sm-4 mt-2">
                            <div class="card widget-flat">
                                <div class="card-body">
                                    <div class="float-end">
                                        <i class="mdi mdi-account-multiple widget-icon"></i>
                                    </div>
                                    <h5 class="text-muted fw-normal mt-0" title="Number of Customers">Doanh thu hôm nay</h5>
                                    <h3 class="mt-3 mb-3">{{ formatNumberPrice($todaysEarnings) }}</h3>

                                </div> <!-- end card-body-->
                            </div> <!-- end card-->
                        </div> <!-- end col-->
                        <div class="col-sm-4 mt-2">
                            <div class="card widget-flat">
                                <div class="card-body">
                                    <div class="float-end">
                                        <i class="mdi mdi-account-multiple widget-icon"></i>
                                    </div>
                                    <h5 class="text-muted fw-normal mt-0" title="Number of Customers">Doanh thu tháng nay
                                    </h5>
                                    <h3 class="mt-3 mb-3"> {{ formatNumberPrice($monthEarnings) }}</h3>
                                </div> <!-- end card-body-->
                            </div> <!-- end card-->
                        </div> <!-- end col-->
                        <div class="col-sm-4 mt-2">
                            <div class="card widget-flat">
                                <div class="card-body">
                                    <div class="float-end">
                                        <i class="mdi mdi-account-multiple widget-icon"></i>
                                    </div>
                                    <h5 class="text-muted fw-normal mt-0" title="Number of Customers">Doanh thu năm nay</h5>
                                    <h3 class="mt-3 mb-3">{{ formatNumberPrice($yearEarnings) }}</h3>
                                </div> <!-- end card-body-->
                            </div> <!-- end card-->
                        </div> <!-- end col-->
                    </div> <!-- end row -->

                    {{-- <div class="col-md-12">
                        <div class="title">
                            <p style="font-size: 25px" class="text-danger">Số lượng sản phẩm và danh mục</p>
                        </div>
                        <div class="row">
                            <a href="" class="text-white">
                                <div id="table-2" class="widget bg-danger p-lg text-center">

                                    <div class="m-b-md">

                                        <p id="table-notification-2" style="font-size: 15px">Tổng số danh mục</p>

                                        <h3 class="font-bold no-margins ">
                                            {{ $totalCategories }}
                                        </h3>
                                    </div>
                                </div>
                            </a>


                            <a href="" class="text-white">
                                <div id="table-2" class="widget bg-danger p-lg text-center">

                                    <div class="m-b-md">

                                        <p id="table-notification-2" style="font-size: 15px">Tổng số sản phẩm</p>

                                        <h3 class="font-bold no-margins ">
                                            {{ $totalProducts }}
                                        </h3>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div> --}}
                    {{--
                    <div class="row mt-4">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="align-items-center">

                                <div class="card-body pt-0 mt-2 mb-2">
                                    <div id="curve_chart" style="width: 100%; height: 400px"></div>
                                </div>
                            </div>
                            </div> <!-- end card-->
                        </div> <!-- end col-->
                    </div>
                     

 --}}
                    <div class="row">
                        <div class="col-xl-12 col-lg-12 order-lg-1 mt-2">
                            <div class="card">
                                <div class="d-flex card-header justify-content-between align-items-center">
                                    <h4 class="header-title">Top 5 sản phẩm bán chạy nhất</h4>
                                </div>

                                <div class="card-body py-0 mb-3">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th scope="col">Tên</th>
                                                <th scope="col">Giá</th>
                                                <th scope="col">Lượt bán</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if (count($topProduct) > 0)
                                                @foreach ($topProduct as $item)
                                                    <tr>

                                                        <td>{{ $item->name }}</td>
                                                        <td style="color: red;">{{ formatNumberPrice($item->price) }}</td>
                                                        <td>{{ $item->purchases }}</td>

                                                    </tr>
                                                @endforeach
                                            @else
                                                <tr>
                                                    <td colspan="2">Chưa có sản phẩm nào hết</td>
                                                </tr>
                                            @endif



                                        </tbody>
                                    </table>
                                </div> <!-- end slimscroll -->
                            </div>
                            <!-- end card-->
                        </div>
                    </div>
                    {{-- Thông kê theo mốc thời gian --}}
                    <div class="row">
                        <div class="col-xl-12 col-lg-12 order-lg-1 mt-2">
                            <div class="card">
                                <div class="d-flex card-header justify-content-between align-items-center">
                                    <h4 class="header-title" id="title-filter">Tổng tiền theo mốc thời gian</h4>
                                </div>

                                <div class="card-body py-0 mb-3">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th scope="col">Thời gian bắt đầu</th>
                                                <th scope="col">Thời gian kết thúc</th>
                                                <td scope="col">Hành động</td>
                                                <th scope="col">Tổng tiền</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td> <input type="date" id="start_day" name="start_day"></td>
                                                <td> <input type="date" id="end_day" name="end_day"></td>
                                                <td> <a href="" class="filter_money">Thống kê</a></td>
                                                <td colspan="4"><span class="doanh_thu_theo_moc">0</span> đ</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div> <!-- end slimscroll -->
                            </div>
                            <!-- end card-->
                        </div>
                    </div>
                    {{--  --}}

                    <div class="row mt-2">
                        @if (count($statisticsMonth) > 0)
                            <div class="col-xl-6 col-lg-6 order-lg-1 mt-2">
                                <div class="card">
                                    <div class="d-flex card-header justify-content-between align-items-center">
                                        <h4 class="header-title">Doanh thu theo 6 tháng gần đây trong năm nay</h4>
                                    </div>

                                    <div class="card-body pt-0">
                                        <table class="table">
                                            <thead>
                                                <tr>

                                                    <th scope="col">Tháng</th>
                                                    <th scope="col">Tổng số đơn đặt hàng</th>
                                                    <th scope="col">Tổng cộng</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                                @foreach ($statisticsMonth as $item)
                                                    <tr>

                                                        <td>{{ $item->month }}</td>
                                                        <td>{{ $item->total_orders }}</td>
                                                        <td style="color: red;">
                                                            {{ number_format($item->total_amount, 0) }} đ</td>
                                                    </tr>
                                                @endforeach


                                            </tbody>
                                        </table>

                                    </div>
                                </div> <!-- end card-->
                            </div> <!-- end col-->
                        @endif


                        @if (count($statisticsYear) > 0)
                            <div class="col-xl-6 col-lg-6 order-lg-1 mt-2">
                                <div class="card">
                                    <div class="d-flex card-header justify-content-between align-items-center">
                                        <h4 class="header-title">Doanh thu theo 3 năm gần đây</h4>
                                    </div>

                                    <div class="card-body py-0 mb-3">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Năm</th>
                                                    <th scope="col">Tổng số đơn đặt hàng</th>
                                                    <th scope="col">Tổng cộng</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                                @foreach ($statisticsYear as $item)
                                                    <tr>

                                                        <td>{{ $item->year }}</td>
                                                        <td>{{ $item->total_orders }}</td>
                                                        <td style="color: red;">
                                                            {{ number_format($item->total_amount, 0) }} đ</td>
                                                    </tr>
                                                @endforeach


                                            </tbody>
                                        </table>
                                    </div> <!-- end slimscroll -->
                                </div>
                                <!-- end card-->
                            </div>
                            <!-- end col -->
                        @endif
                    </div>

                </div>
            </div>

        </div>
        
    @endsection
    @push('scripts')
        <script>
        
        function formatNumberWithCommas(number) {
            return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        }
            $(document).on('click', '.filter_money', function(e) {
                e.preventDefault();
                var start_day = $('#start_day').val();
                var end_day = $('#end_day').val();
                var ischeck = true;
                if (start_day == "") {
                    toastr.error("Nhập thời gian bắt đầu lọc")
                    ischeck = false
                }
                if (end_day == "") {
                    toastr.error("Nhập thời gian kết thúc lọc")
                    ischeck = false
                }
                if (ischeck == true) {
                    $.ajax({
                        url: "{{ route('statistical.filtering') }}",
                        method: 'get',
                        data: {
                            start_day: start_day,
                            end_day: end_day,
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            if (response.status === 'success') {
                                toastr.success(response.message)
                                if(response.data == null){
                                    $(".doanh_thu_theo_moc").text('0');
                                }else{
                                    var price = formatNumberWithCommas(response.data);
                                    $(".doanh_thu_theo_moc").text(price);
                                }
                            }
                        }
                    })
                }

            })
        </script>
    @endpush
