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
                    <a href="{{ route('restaurant-manager') }}" class="btn btn-outline btn-primary btn-sm float-left">
                        <i class="fa fa-long-arrow-left mt-1"></i>
                    </a>

                    Danh sách đơn hàng
                </h3>
                <hr />
                <input hidden value="Completed" id="lblCompleted" />
                <input hidden value="2" id="txtTableId" />
                {{--  --}}

                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                    <button class="nav-link  active" id="nav-home-tab" data-toggle="tab" data-target="#nav-home"
                        type="button" role="tab" aria-controls="nav-home" aria-selected="true">Đơn đặt
                        hàng</button>
                    <button class="nav-link " id="nav-profile-tab" data-toggle="tab" data-target="#nav-profile"
                        type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Đơn hàng đã hoàn
                        thành
                    </button>
                    <button class="nav-link" id="nav-contact-tab" data-toggle="tab" data-target="#nav-contact"
                        type="button" role="tab" aria-controls="nav-contact" aria-selected="false">Đơn hủy</button>
                </div>


                <div class="tab-content " id="nav-tabContent">
                    {{-- đơn đến --}}
                    <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                        <div class="col-md-12">
                            <div class="row table-responsive mt-3" id="nonPayOrder">
                                <table id="appTable" class="table table-hover">
                                    @if (isset($order) && count($order) > 0)
                                        <thead class="">
                                            <tr>
                                                <th>Bàn</th>
                                                <th>Sản phẩm</th>
                                                <th>Tổng cộng</th>
                                                <th>Ghi chú</th>
                                                <th>Thời gian</th>
                                                <th>Trạng thái</th>
                                                <th>Hành động</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($order as $item)
                                                <tr>
                                                    <td>{{ $item->table->name }}</td>
                                                    <td>
                                                        <ul style="list-style: none; padding: 0;">
                                                            @foreach ($item->orderDetails as $orderDetail)
                                                                @if ($orderDetail->product == null)
                                                                    <p style="padding: 5px;color:#910400;text-align:left;">
                                                                        [Không xác định]
                                                                    </p>
                                                                @else
                                                                    <li style="text-align: left">
                                                                        <p class="my-2 h6" style="color: #910400">
                                                                            {{ $orderDetail->quantity }} x
                                                                            {{ $orderDetail->product->name }}
                                                                        </p>
                                                                        @php
                                                                            $variant = json_decode($orderDetail->item);
                                                                            $variant2 = json_decode($variant);
                                                                        @endphp

                                                                        @if ($variant2 != null)
                                                                            @foreach ($variant2 as $value)
                                                                                - {{ $value->name }}<br>

                                                                                <input type="hidden"
                                                                                    value="{{ $value->price }}">
                                                                            @endforeach
                                                                        @endif

                                                                    </li>
                                                                @endif
                                                            @endforeach
                                                        </ul>
                                                    </td>
                                                    <td>{{ formatNumberPrice($item->total_price) }} </td>

                                                    <td>
                                                        @if (isset($item->note) && !empty($item->note))
                                                            {{ $item->note }}
                                                        @else
                                                            Không Có
                                                        @endif
                                                    </td>
                                                    <td>{{ $item->created_at }}</td>
                                                    <th>
                                                        @if ($item->status == 0)
                                                            <span> Chưa xác nhận </span>
                                                        @endif
                                                    </th>
                                                    <td>
                                                        <form action="" method="get">
                                                            <input type="hidden" name="phone"
                                                                value="{{ $item->phone }}">
                                                            <input type="hidden" name="total"
                                                                value="{{ $item->total_price }}">
                                                            <select class="form-control order-status" name="status"
                                                                id="{{ $item->id }}">
                                                                <option value="0"
                                                                    {{ $item->status == 0 ? 'selected' : '' }}>
                                                                    Chưa xác nhận
                                                                </option>
                                                                <option value="1"
                                                                    {{ $item->status == 1 ? 'selected' : '' }}>
                                                                    Đã xác nhận
                                                                </option>
                                                                <option value="2"
                                                                    {{ $item->status == 2 ? 'selected' : '' }}>
                                                                    Hủy bỏ
                                                                </option>
                                                            </select>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    @else
                                        <div class="alert alert-danger" role="alert">
                                            Bạn không có đơn đặt hàng mới <i class="fa-solid fa-bell"></i>
                                        </div>
                                    @endif
                                </table>
                            </div>
                        </div>
                    </div>
                    {{-- đã thanh toán --}}
                    <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                        <div class="col-md-12">
                            <div class="row table-responsive mt-3" id="">
                                <table id="myTable" class="table table-hover">
                                    <thead class="">
                                        <tr>
                                            <th>Bàn</th>
                                            <th>Sản phẩm</th>
                                            <th>Tổng cộng</th>
                                            <th>Ghi chú</th>
                                            <th>Thời gian</th>
                                            <th>Trạng thái</th>
                                            <th>Hành động</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($orders as $key => $item)
                                            <tr>
                                                <td>
                                                    {{ $item->table->name }}
                                                </td>
                                                <td>
                                                    <ul style="list-style: none; padding: 0;">
                                                        @foreach ($item->orderDetails as $orderDetail)
                                                            @if ($orderDetail->product == null)
                                                                <p style="padding: 5px;color:#910400;text-align:left;">
                                                                    [Không xác định]
                                                                </p>
                                                            @else
                                                                <li style="text-align: left">
                                                                    <p class="my-2 h6" style="color: #910400">
                                                                        {{ $orderDetail->quantity }} x
                                                                        {{ $orderDetail->product->name }}
                                                                    </p>
                                                                    @php
                                                                        $variant = json_decode($orderDetail->item);
                                                                        $variant2 = json_decode($variant);
                                                                    @endphp

                                                                    @if ($variant2 != null)
                                                                        @foreach ($variant2 as $value)
                                                                            - {{ $value->name }}<br>

                                                                            <input type="hidden"
                                                                                value="{{ $value->price }}">
                                                                        @endforeach
                                                                    @endif

                                                                </li>
                                                            @endif
                                                        @endforeach
                                                    </ul>
                                                </td>
                                                <td>{{ formatNumberPrice($item->total_price) }}</td>
                                                <td>
                                                    @if (isset($item->note) && !empty($item->note))
                                                        {{ $item->note }}
                                                    @else
                                                        Không Có
                                                    @endif
                                                </td>
                                                <td>{{ $item->created_at }}</td>
                                                <td>
                                                    @if ($item->status == 5)
                                                        <span>Đã thanh toán</span>
                                                    @endif
                                                </td>
                                                <th>
                                                    <a href="{{ url('invoice/' . $item->id) }}"
                                                        class="btn btn-warning btn-sm float-end mx-1"><i
                                                            class="fa-solid fa-eye"></i>
                                                    </a>
                                                    <a id="{{ $item->id }}"
                                                        href="#"class="btn btn-warning btn-sm float-end mx-1 deleteIcon">
                                                        <i class="fa-solid fa-trash-can"></i>
                                                    </a>
                                                </th>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    {{-- hủy --}}
                    <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
                        <div class="col-md-12">
                            <div class="row table-responsive mt-3" id="">
                                <table id="myCancelTable" class="table table-hover">
                                    <thead class="">
                                        <tr>
                                            <th>Bàn</th>
                                            <th>Sản phẩm</th>
                                            <th>Tổng cộng</th>
                                            <th>Ghi chú</th>
                                            <th>Thời gian</th>
                                            <th>Trạng thái</th>
                                            <th>Hành động</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($cancel as $key => $item)
                                            <tr>
                                                <td>
                                                    {{ $item->table->name }}
                                                </td>
                                                <td>
                                                    <ul style="list-style: none; padding: 0;">
                                                        @foreach ($item->orderDetails as $orderDetail)
                                                            @if ($orderDetail->product == null)
                                                                <p style="padding: 5px;color:#910400;text-align:left;">
                                                                    [Không xác định]
                                                                </p>
                                                            @else
                                                                <li style="text-align: left">
                                                                    <p class="my-2 h6" style="color: #910400">
                                                                        {{ $orderDetail->quantity }} x
                                                                        {{ $orderDetail->product->name }}
                                                                    </p>
                                                                    @php
                                                                        $variant = json_decode($orderDetail->item);
                                                                        $variant2 = json_decode($variant);
                                                                    @endphp

                                                                    @if ($variant2 != null)
                                                                        @foreach ($variant2 as $value)
                                                                            - {{ $value->name }}<br>

                                                                            <input type="hidden"
                                                                                value="{{ $value->price }}">
                                                                        @endforeach
                                                                    @endif

                                                                </li>
                                                            @endif
                                                        @endforeach
                                                    </ul>
                                                </td>
                                                <td>{{ formatNumberPrice($item->total_price) }}</td>
                                                <td>
                                                    @if (isset($item->note) && !empty($item->note))
                                                        {{ $item->note }}
                                                    @else
                                                        Không Có
                                                    @endif
                                                </td>
                                                <td>{{ $item->created_at }}</td>
                                                <td>
                                                    @if ($item->status == 2)
                                                        <span>Đã hủy</span>
                                                    @endif
                                                </td>
                                                <th>
                                                    <a href="{{ url('invoice/' . $item->id) }}"
                                                        class="btn btn-warning btn-sm float-end mx-1"><i
                                                            class="fa-solid fa-eye"></i>
                                                    </a>
                                                    <a id="{{ $item->id }}"
                                                        href="#"class="btn btn-warning btn-sm float-end mx-1 deleteIcon">
                                                        <i class="fa-solid fa-trash-can"></i>
                                                    </a>
                                                </th>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <script src="//js.pusher.com/3.1/pusher.min.js"></script>
    <script type="text/javascript">
        var pusher = new Pusher('3f445aa654bdfac71f01', {
            encrypted: true,
            cluster: "ap1"
        });

        var channel = pusher.subscribe('development');

        channel.bind('App\\Events\\HelloPusherEvent', function(data) {
            Command: toastr["warning"](data.message)

            toastr.options = {
                "closeButton": false,
                "debug": false,
                "newestOnTop": false,
                "progressBar": true,
                "positionClass": "toast-top-right",
                "preventDuplicates": false,
                "onclick": null,
                "showDuration": "300",
                "hideDuration": "1000",
                "timeOut": "5000",
                "extendedTimeOut": "1000",
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
            }

            var audio = new Audio('{{ asset('Doorbell.mp3') }}');
            audio.addEventListener('canplaythrough', function() {
                audio.play();
            });;

            updateTable();
        });
    </script>
    <!-- Add the following script to your page -->
    <script>
        function meny() {
            var audio = new Audio('{{ asset('meny.mp3') }}');
            audio.play();
            updateTable();
        }

        function formatDateTime(dateTimeString) {
            const date = new Date(dateTimeString);
            const year = date.getFullYear();
            const month = String(date.getMonth() + 1).padStart(2, '0');
            const day = String(date.getDate()).padStart(2, '0');
            const hours = String(date.getHours()).padStart(2, '0');
            const minutes = String(date.getMinutes()).padStart(2, '0');
            const seconds = String(date.getSeconds()).padStart(2, '0');

            return `${year}-${month}-${day} ${hours}:${minutes}:${seconds}`;
        }
        function processDateTimeString(dateTimeString) {
            // Thay thế "T" bằng dấu cách
            const stringWithoutT = dateTimeString.replace('T', ' ');

            // Tách chuỗi bằng dấu chấm và chỉ lấy phần tử đầu tiên (trước dấu chấm)
            const stringWithoutFraction = stringWithoutT.split('.')[0];

            return stringWithoutFraction;
        }


        function formatNumberWithCommas(number) {
            return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        }

        function updateTable() {

            $.ajax({
                url: '/getOrder',
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    var $tableBody = $('#nonPayOrder tbody');
                    $tableBody.html('');

                    $.each(data, function(index, order) {
                        var row = '<tr>';
                        row += '<td>' + order.table_id + '</td>';
                        row += '<td>';
                        row += '<ul style="list-style: none; padding: 0;">';

                        $.each(order.order_details, function(index, orderDetail) {
                            row +=
                                '<li style="text-align: left"> <p class="my-2 h6" style="color: #910400">' +
                                orderDetail.quantity + ' x ' + orderDetail
                                .product_name + '</p>';

                            let parse_item = JSON.parse(orderDetail.item)
                            let parse_item2 = JSON.parse(parse_item)

                            if (parse_item2 != null) {
                                $.each(parse_item2, function(index, value) {
                                    row += '-' + value.name + '<br>'
                                    row += '<input type="hidden" value=" ' + value
                                        .price + '">'
                                });
                            }

                            row += '</li>';
                        });

                        row += '</ul>';
                        row += '</td>';
                        row += '<td>' + formatNumberWithCommas(order.total_price) + 'đ</td>';
                        row += '<td>' + (order.note ? order.note : 'Không Có') + '</td>';
                        row += '<td>' + processDateTimeString(order.created_at) + '</td>';

                        row += '<td>';

                        if (order.status == 0) {
                            row += '<span> Chưa xác nhận </span>';
                        }
                        row += '</th>';
                        row += '<td>';
                        row += '<form action="" method="get">';
                        row += '<input type="hidden" name="phone" value="' + order.phone + '">';
                        row += '<input type="hidden" name="total" value="' + order.total_price + '">';
                        row += '<select class="form-control order-status" name="status" id="' + order
                            .id + '">';
                        row += '<option value="0" ' + (order.status == 0 ? 'selected' : '') +
                            '>Chưa xác nhận</option>';
                        row += '<option value="1" ' + (order.status == 1 ? 'selected' : '') +
                            '>Đã xác nhận</option>';
                        row += '<option value="2" ' + (order.status == 2 ? 'selected' : '') +
                            '>Hủy bỏ</option>';
                        row += '</select>';
                        row += '</form>';
                        row += '</td>';
                        row += '</tr>';

                        $tableBody.append(row);
                    });
                },
                error: function(error) {
                    console.error('Lỗi khi lấy dữ liệu:', error);
                }
            });
        }

        // setInterval(updateTable, 3000); // Adjust the interval as needed
    </script>
@endsection
@push('scripts')
    <script>
        let table = new DataTable('#myTable', {
            responsive: true
        });
        let tables = new DataTable('#appTable', {
            responsive: true
        });
        let tabless = new DataTable('#myCancelTable', {
            responsive: true
        });
    </script>
    <script>
        $(document).ready(function() {
            $('body').on('change', '.order-status', function() {
                let status = $(this).find(':selected').val();
                let id = $(this).attr('id');
                $.ajax({
                    url: '{{ route('order-status') }}',
                    method: 'GET',
                    data: {
                        status: status,
                        id: id
                    },
                    success: function(data) {
                        toastr.success(data.message)
                        window.location.reload()
                    },
                    error: function(xhr, status, error) {
                        console.log(error);
                    }
                })
            })
        })
    </script>


    <script>
        $(document).on('click', '.deleteIcon', function(e) {
            e.preventDefault();
            let id = $(this).attr('id');
            let csrf = '{{ csrf_token() }}';
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '{{ route('detete-order') }}',
                        method: 'delete',
                        data: {
                            id: id,
                            _token: csrf
                        },
                        success: function(response) {
                            console.log(response);
                            Swal.fire(
                                'Deleted!',
                                'Your file has been deleted.',
                                'success'
                            )
                            window.location.reload();

                        }
                    });
                }
            })
        });
    </script>
@endpush
