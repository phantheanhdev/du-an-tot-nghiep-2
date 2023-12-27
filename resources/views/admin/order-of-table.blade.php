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
                <h3 class="text-qrRest-dark text-center">
                    <a href="{{ route('restaurant-manager') }}" class="btn btn-outline btn-primary btn-sm float-left"><i
                            class="fa fa-long-arrow-left mt-1"></i>
                    </a>
                    Bàn số : {{ $table->name }}
                </h3>
                <hr />
                <input hidden value="Completed" id="lblCompleted" />
                <input type="hidden" name="" id="id" value="{{ $table->id }}">


                <div class="col-md-12">
                    <div class="row table-responsive" id="nonPayOrder">
                        <table id="myTable" class="table table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">Bàn</th>
                                    <th scope="col">Sản phẩm</th>
                                    <th scope="col">Ghi chú </th>
                                    <th scope="col">Thời Gian </th>
                                    <th scope="col">Tổng Tiền </th>
                                    <th scope="col">Trạng Thái</th>
                                    <th scope="col">Hành Động</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($orders->sortByDesc('created_at') as $order)

                                    <tr>
                                        <td>{{ $order->table_id }}</td>
                                        <td>

                                            {{-- order product --}}
                                            <ul style="list-style: none; padding: 0;">
                                                @foreach ($order->orderDetails as $orderDetail)
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

                                                                    <input type="hidden" value="{{ $value->price }}">
                                                                @endforeach
                                                            @endif

                                                        </li>
                                                    @endif
                                                @endforeach
                                            </ul>

                                        </td>
                                        <td>
                                            @if (isset($order->note) && !empty($order->note))
                                                {{ $order->note }}
                                            @else
                                                Không Có
                                            @endif
                                        </td>
                                        <td>{{ $order->created_at }}</td>
                                        <td>{{ formatNumberPrice($order->total_price) }}</td>
                                        <td>
                                            @if ($order->status == 0)
                                                <span class="badge badge-warning">Chưa xác nhận</span>
                                            @elseif ($order->status == 1)
                                                <span class="badge badge-success">Đã xác nhận</span>
                                            @endif
                                        </td>
                                        <td>
                                            <form action="{{ route('admin.orders.updateStatus', ['id' => $order->id]) }}"
                                                method="post">
                                                @csrf
                                                @method('PATCH')

                                                <input type="hidden" name="phone" value="{{ $order->phone }}">
                                                <input type="hidden" name="total" value="{{ $order->total_price }}">

                                                @if ($order->status == 0)
                                                    <button onclick="callOrder({{ $order->phone }})" type="submit" name="status" value="1"
                                                        class="btn btn-info btn-sm float-end mx-1"><i
                                                            class="fa-solid fa-check px-1"></i></button>
                                                    <button onclick="cancelOrder({{ $order->phone }})" type="submit" name="status" value="2"
                                                        class="btn btn-danger btn-sm float-end mx-1"><i
                                                            class="fa-solid fa fa-trash-o"></i></button>
                                                @endif
                                            </form>
                                            <form action="{{ route('admin.orders.updateStatus', ['id' => $order->id]) }}"
                                                method="POST" target="_blank">
                                                @csrf
                                                @method('PATCH')
                                                <input type="hidden" name="phone" value="{{ $order->phone }}">
                                                <input type="hidden" name="total" value="{{ $order->total_price }}">

                                                @if ($order->status == 1)
                                                    <a class="btn btn-secondary btn-sm float-end mx-1 print-btn"
                                                        href="{{ url('/order-form/' . $order->id) }}" target="_blank"><i
                                                            class="fa-solid fa-print"></i></a>
                                                    <button type="submit" name="status" value="5"
                                                        class="btn btn-primary btn-sm float-end mx-1" onclick="meny()"><i
                                                            class="fa-solid fa fa-credit-card mt-1"></i></button>
                                                @endif
                                            </form>

                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Include jQuery library -->
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
            var idtable = document.getElementById("id").value;
            $.ajax({
                url: '/getOrder/' + idtable,
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
                        row += '<td>' + (order.note ? order.note : 'Không Có') + '</td>';
                        row += '<td>' + processDateTimeString(order.created_at) + '</td>';
                        row += '<td>' + formatNumberWithCommas(order.total_price) + 'đ</td>';
                        row += '<td>';

                        if (order.status == 0) {
                            row +=
                                '<span class="badge badge-warning">Chưa xác nhận</span>';
                        } else if (order.status == 1) {
                            row +=
                                '<span class="badge badge-success">Đã xác nhận</span>';
                        }

                        row += '</td>';
                        row += '<td>';
                        row += '<form action="' + '/admin/orders/' + order.id +
                            '/update-status" method="POST">';
                        row += '<input type="hidden" name="_token" value="' + $(
                            'meta[name="csrf-token"]').attr('content') + '">';
                        row += '<input type="hidden" name="_method" value="PATCH">';
                        row += '<input type="hidden" name="phone" value="' + order.phone + '">';
                        row += '<input type="hidden" name="total" value="' + order.total_price + '">';

                        if (order.status == 0) {
                            row +=
                                '<button onclick="callOrder('+ order.phone +')" type="submit" name="status" value="1" class="btn btn-info btn-sm float-end mx-1"><i class="fa-solid fa-check px-1"></i></button>';
                            row +=
                                '<button onclick="cancelOrder('+ order.phone +')" type="submit" name="status" value="2" class="btn btn-danger btn-sm float-end mx-1"><i class="fa-solid fa fa-trash-o"></i></button>';
                        }

                        row +=
                            '</form>';
                        row += '<form action="' + '/admin/orders/' + order.id +
                            '/update-status" method="POST" target="_blank">';
                        row += '<input type="hidden" name="_token" value="' + $(
                            'meta[name="csrf-token"]').attr('content') + '">';
                        row += '<input type="hidden" name="_method" value="PATCH">';
                        row += '<input type="hidden" name="phone" value="' + order.phone + '">';
                        row += '<input type="hidden" name="total" value="' + order.total_price + '">';

                        if (order.status == 1) {
                            row += '<a class="btn btn-secondary btn-sm float-end mx-1" href="' +
                                '/order-form/' + order.id + '"><i class="fa-solid fa-print"></i></a>';
                            row +=
                                '<button type="submit"  name="status" value="5" class="btn btn-primary btn-sm float-end mx-1" onclick="meny()"><i class="fa-solid fa fa-credit-card mt-1"></i></button>';
                        }
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

    <script>
        let printButtonClickCount = 0;

        document.querySelectorAll('.print-btn').forEach((btn) => {
            btn.addEventListener('click', (event) => {
                printButtonClickCount++;
                if (printButtonClickCount == 2) {
                    const confirmPrint = confirm('Bạn có muốn in lại không?');
                    if (confirmPrint) {
                        window.open(btn.getAttribute('href'), '_blank');
                    } else {
                        event.preventDefault();
                        printButtonClickCount = 1;
                    }
                }
            });
        });
        
        function callOrder(id) {
            var contentsData = "Đơn hàng đã được xác nhận !";

            var postData = {
                contents: contentsData,
                id: id

            };

            $.ajax({
                url: '/client', // Đường dẫn tới trang xử lý
                type: 'GET', // Phương thức HTTP POST
                data: postData, // Dữ liệu POST
                // dataType: 'json', // Loại dữ liệu bạn mong muốn nhận được từ máy chủ
                success: function(response) {
                    Command: toastr["success"]("Yêu cầu đã được gửi đi")

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
                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });

        }
        function cancelOrder(id) {
            var contentsData = "Đơn hàng đã được hủy !";

            var postData = {
                contents: contentsData,
                id: id

            };

            $.ajax({
                url: '/client', // Đường dẫn tới trang xử lý
                type: 'GET', // Phương thức HTTP POST
                data: postData, // Dữ liệu POST
                // dataType: 'json', // Loại dữ liệu bạn mong muốn nhận được từ máy chủ
                success: function(response) {
                    Command: toastr["success"]("Yêu cầu đã được gửi đi")

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
                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });

        }
    </script>
    
    <script>
        function openNewTab() {
            var form = document.getElementById('orderForm');
            form.submit();
            window.open('', '_blank');
        }
    </script>
    @push('scripts')
        <script>
            let table = new DataTable('#myTable', {
                responsive: true
            });
        </script>
    @endpush
@endsection
