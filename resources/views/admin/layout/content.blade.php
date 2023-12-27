<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>ADMIN-FOODIE</title>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link rel="shortcut icon" type="image/png" href="{{ asset('/admin/images/favicon.png') }}" />
    <link rel="stylesheet" href="{{ asset('/admin/lib/bootstrap/dist/css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('/admin/lib/font-awesome/css/font-awesome.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('/admin/lib/toastr/toastr.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('/admin/css/animate.css') }}" />
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Yeon+Sung&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('/admin/css/site.css') }}" />
    <link rel="stylesheet" href="//cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    {{-- awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
        integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        #table-2 {
            /* Màu nền mặc định */
            background-color: #080807;
            /* Thay thế bằng màu mặc định của bạn */
            color: #fafaf7;
            /* Thay thế bằng màu văn bản mặc định của bạn */
        }

        .black-bg {
            /* Màu nền mặc định */
            background-color: #080807;
            /* Thay thế bằng màu mặc định của bạn */
            color: #fafaf7;
            /* Thay thế bằng màu văn bản mặc định của bạn */
        }

        .red-bg {
            background-color: #ff0000 !important;
            /* Màu nền đỏ */
        }

        .green-bg {
            background-color: #2EFE64 !important;

            /* Hoặc màu sắc xanh lá cây khác tùy thuộc vào yêu cầu của bạn */
        }

        .yellow-bg {
            background-color: #FFFF00 !important;
            /* Màu nền vàng */
            color: #000 !important;
            /* Màu văn bản tương ứng */
        }

        th {
            text-align: center;
            vertical-align: middle !important;
        }

        td {
            text-align: center;
            vertical-align: middle !important;
        }
    </style>

</head>

<body>
    <div id="wrapper">
        <div id="page-wrapper" class="gray-bg">
            <nav class="navbar navbar-expand-sm navbar-toggleable-sm navbar-dark bg-primary box-shadow mb-3">
                <div class="container">
                    <a class="navbar-brand" href="{{ route('restaurant-manager') }}">FOODIE</a>
                    <button class="custom-toggler navbar-toggler" type="button" data-toggle="collapse"
                        data-target=".navbar-collapse" aria-controls="navbarSupportedContent" aria-expanded="false"
                        aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"><i class="fa fa-bars"
                                style="color:#fafafa; font-size:28px;"></i></span>
                    </button>
                    <div class="navbar-collapse collapse d-sm-inline-flex justify-content-between">
                        <ul class="navbar-nav mx-auto">
                            {{-- <li class="nav-item">
                                <div class="dropdown profile-element">
                                    <a class="nav-link" data-toggle="dropdown" aria-expanded="false">
                                        <span>
                                            <i class="fa fa-globe mr-2"></i>Language<i
                                                class="fa fa-chevron-down ml-1"></i>
                                        </span>
                                    </a>
                                    <ul class="dropdown-menu animated fadeInRight m-t-xs">
                                        <li class="dropdown-item">
                                            <a
                                                href="/home/SetCulture?culture=en&returnUrl=/restaurant-manager">English</a>
                                        </li>
                                        <li class="dropdown-item">
                                            <a
                                                href="/home/SetCulture?culture=es&returnUrl=/restaurant-manager">Spanish</a>
                                        </li>
                                        <li class="dropdown-item">
                                            <a
                                                href="/home/SetCulture?culture=de&returnUrl=/restaurant-manager">German</a>
                                        </li>
                                        <li class="dropdown-item">
                                            <a
                                                href="/home/SetCulture?culture=ru&returnUrl=/restaurant-manager">Russian</a>
                                        </li>
                                        <li class="dropdown-item">
                                            <a
                                                href="/home/SetCulture?culture=zh&returnUrl=/restaurant-manager">Chinese</a>
                                        </li>
                                        <li class="dropdown-item">
                                            <a
                                                href="/home/SetCulture?culture=ar&returnUrl=/restaurant-manager">Arabic</a>
                                        </li>
                                        <li class="dropdown-item">
                                            <a
                                                href="/home/SetCulture?culture=hi&returnUrl=/restaurant-manager">Hindi</a>
                                        </li>
                                        <li class="dropdown-item">
                                            <a
                                                href="/home/SetCulture?culture=pt&returnUrl=/restaurant-manager">Portuguse</a>
                                        </li>
                                        <li class="dropdown-item">
                                            <a
                                                href="/home/SetCulture?culture=tr&returnUrl=/restaurant-manager">Turkish</a>
                                        </li>
                                        <li class="dropdown-item">
                                            <a
                                                href="/home/SetCulture?culture=ja&returnUrl=/restaurant-manager">Japanese</a>
                                        </li>
                                        <li class="dropdown-item">
                                            <a
                                                href="/home/SetCulture?culture=fr&returnUrl=/restaurant-manager">French</a>
                                        </li>
                                        <li class="dropdown-item">
                                            <a
                                                href="/home/SetCulture?culture=pl&returnUrl=/restaurant-manager">Polish</a>
                                        </li>
                                        <li class="dropdown-item">
                                            <a
                                                href="/home/SetCulture?culture=it&returnUrl=/restaurant-manager">&#x130;talian</a>
                                        </li>
                                    </ul>
                                </div>
                            </li> --}}
                        </ul>

                        <ul class="nav navbar-top-links">

                            <li class="nav-item">

                                <div class="dropdown profile-element">
                                    <a class="nav-link" data-toggle="dropdown" aria-expanded="false">
                                        <span>
                                            <i class="fa fa-cutlery mr-2"></i>
                                            <i class="fa fa-chevron-down ml-1"></i>
                                        </span>
                                    </a>
                                    <ul class="dropdown-menu animated fadeInRight m-t-xs">

                                        <li class="dropdown-item">
                                            <a href="{{ route('show.password.form') }}">Đổi mật khẩu</a>
                                        </li>
                                        <li class="divider"></li>
                                        <li class="dropdown-item"><a href="{{ route('logout') }}">Đăng xuất</a></li>
                                    </ul>
                                </div>
                            </li>

                        </ul>
                    </div>
                </div>
            </nav>
            <div class="wrapper wrapper-content mx-4">
                <div {{-- class="container" --}} style="height: 100%;">

                    <div class="row">
                        <div class="col-lg-3">
                            <div class="contact-box center-version">
                                <a style="text-decoration:none; color:black;">
                                    <img alt="image" class="img-lg"
                                        src="{{ asset('storage/images/icon_form_user.svg') }}">
                                    <h3 class="m-b-xs">Xin chào: <strong>
                                            @php
                                                if (Session::has('username') && Session::get('username') != '') {
                                                    echo Session::get('username');
                                                }
                                            @endphp
                                        </strong></h3>
                                    {{-- <address class="m-t-md">
                                        Quang<br>
                                        <abbr title="Phone"><i class="fa fa-phone"></i></abbr>
                                        <p> (098) 765-4321</p>
                                    </address>
                                    <strong>Description</strong>
                                    <p>Linh</p> --}}
                                </a>

                                <div class="contact-box-footer">
                                    {{-- order --}}
                                    <button id="btnOrder" onclick="getLink('restaurant-manager')"
                                        class="btn btn-outline btn-primary btn-block">
                                        <i class="fa fa-th float-left mt-1"></i>
                                        Quản lý bàn</button>
                                    {{-- order_list --}}
                                    <button id="btnOrderAlternative" onclick="getLink('orderAlternative')"
                                        class="btn btn-outline btn-primary btn-block"><i
                                            class="fa fa-list-ol float-left mt-1"></i>Danh sách đơn hàng</button>
                                    {{-- order-board - quản lý món ra  --}}
                                    {{-- <button id="btnOrderBoard" onclick="getLink('orderBoard')"
                                        class="btn btn-outline btn-primary btn-block"><i
                                            class="fa fa-columns fa-square-kanban float-left mt-1"></i>ORDER
                                        BOARD</button> --}}
                                    {{-- qr builder --}}
                                    {{-- <button id="qr-builder" onclick="getLink('qr-builder')"
                                        class="btn btn-outline btn-primary btn-block">
                                        <i class="fa fa-columns fa-square-kanban fa-sharp fa-solid fa-qrcode float-left mt-1"
                                            style="color: #d35352;"></i>
                                        Xây dựng QR
                                    </button> --}}
                                    {{-- tale --}}
                                    @if (Auth::user()->role == 1)
                                        <button id="table" onclick="getLink('table')"
                                            class="btn btn-outline btn-primary btn-block">
                                            <i class="fa-regular fa-table fa fa-columns fa-square-kanban fa-sharp fa-solid float-left mt-1"
                                                style="color: #d35352;"></i>
                                            Quản lý QR - Table
                                        </button>
                                        {{-- category --}}
                                        <button id="category" onclick="getLink('category')"
                                            class="btn btn-outline btn-primary btn-block">
                                            <i class="fa-solid fa-bars fa-square-kanban fa-sharp fa-solid float-left mt-1"
                                                style="color: #d35352;"></i>
                                            Danh mục thực phẩm
                                        </button>


                                        {{-- product --}}
                                        <button id="table" onclick="getLink('product')"
                                            class="btn btn-outline btn-primary btn-block">
                                            <i class="fa-solid fa-mug-hot  fa-square-kanban fa-sharp fa-solid float-left mt-1"
                                                style="color: #d35352;"></i>
                                            Menu thực phẩm
                                        </button>
                                    @endif
                                    {{-- khách hàng --}}
                                    <button id="staff" onclick="getLink('customer')"
                                        class="btn btn-outline btn-primary btn-block">
                                        <i class="fa-solid fa-user-group fa-square-kanban fa-sharp fa-solid float-left mt-1"
                                            style="color: #d35352;"></i>
                                        Khách hàng
                                    </button>
                                    @if (Auth::user()->role == 1)
                                        {{-- employee --}}
                                        <button id="staff" onclick="getLink('staff')"
                                            class="btn btn-outline btn-primary btn-block">
                                            <i class="fa-solid fa-user fa-square-kanban fa-sharp fa-solid float-left mt-1"
                                                style="color: #d35352;"></i>
                                            Nhân viên
                                        </button>
                                        {{-- Coupon admin --}}
                                        {{-- <button id="btnOrder" onclick="getLink('coupons')"
                                        class="btn btn-outline btn-primary btn-block">
                                        <i class="fa-solid fa-table-columns float-left mt-1"></i>
                                        Phiếu mua hàng</button> --}}
                                        {{-- Flash Sale admin --}}
                                        <button id="btnOrder" onclick="getLink('flash-sale')"
                                            class="btn btn-outline btn-primary btn-block">

                                            <i class="fa-solid fa-bolt float-left mt-1"></i>
                                            Giảm giá thần tốc</button>

                                        {{-- Quản lí tài khoản --}}
                                        <button id="btnOrder" onclick="getLink('showUser')"
                                            class="btn btn-outline btn-primary btn-block">
                                            <i class="fa-solid fa-user float-left mt-1"></i>
                                            Quản lí tài khoản</button>


                                        {{-- Dashboard admin --}}
                                        <button id="btnOrder" onclick="getLink('dashboard')"
                                            class="btn btn-outline btn-primary btn-block">
                                            <i class="fa-solid fa-table-columns float-left mt-1"></i>
                                            Thống kê</button>


                                        {{-- Feedback admin --}}
                                        <button id="btnOrder" onclick="getLink('reviews')"
                                            class="btn btn-outline btn-primary btn-block">
                                            <i class="fa-solid fa-table-columns float-left mt-1"></i>
                                            Phản hồi</button>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <script>
                            const getLink = (param) => {
                                switch (param) {
                                    case 'dashboard':
                                        window.location.href = '/dashboard';
                                        return;
                                    case 'restaurant-manager':
                                        window.location.href = '/restaurant-manager';
                                        return;
                                    case 'orderAlternative':
                                        window.location.href = '/list-order';
                                        return;
                                    case 'orderBoard':
                                        window.location.href = '/order-board';
                                        return;
                                    case 'qr':
                                        window.location.href = '/qrcode';
                                        return;
                                    case 'menuFeatures':
                                        window.location.href = '/menuproductfeature';
                                        return;
                                    case 'settings':
                                        window.location.href = '/Restaurant/settings';
                                        return;
                                    case 'customer':
                                        window.location.href = '/customer';
                                        return;
                                    case 'staff':
                                        window.location.href = '/staff';
                                        return;
                                    case 'reports':
                                        window.location.href = '/report';
                                        return;
                                    case 'qr-builder':
                                        window.location.href = '/qr-builder';
                                        return;
                                    case 'table':
                                        window.location.href = '/table';
                                        return;
                                    case 'category':
                                        window.location.href = '/category';
                                        return;
                                    case 'product':
                                        window.location.href = '/product';
                                        return;
                                    case 'coupons':
                                        window.location.href = '/coupons';
                                        return;
                                    case 'flash-sale':
                                        window.location.href = '/flash-sale';
                                        return;
                                    case 'reviews':
                                        window.location.href = '/reviews';
                                        return;
                                    case 'showUser':
                                        window.location.href = '/showUser';
                                        return;
                                    default:
                                        return;
                                }
                            }
                        </script>

                        {{-- nội dung chính bỏ vào đây main-content --}}
                        @yield('main-content')

                    </div>

                    <div class="modal inmodal" id="delete-modal" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content animated fadeIn">
                                <div class="ibox">
                                    <div class="ibox-content">
                                        <p class="p-y m-t text-center">
                                            <i class="fa fa-remove text-warning fa-5x"></i>
                                            <button type="button" class="close mr-3" data-dismiss="modal">
                                                <span aria-hidden="true">&#xD7;</span><span
                                                    class="sr-only">Close</span>
                                            </button>
                                        </p>
                                        <div class="modal-header">
                                        </div>
                                        <div class="modal-body">
                                            <p class="text-center">Are you sure you want to cancel?</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary text-white"
                                                data-dismiss="modal" style="color:#910400;">No</button> <a
                                                onclick="cancelOrder()" class="btn btn-primary text-white">Yes</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal inmodal" id="call-modal" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content animated fadeIn">
                                <div class="ibox">
                                    <div class="ibox-content">
                                        <p class="p-y m-t text-center">
                                            <img id="imgCall" />
                                        </p>
                                        <div class="modal-body">
                                            <h3 class="text-center" id="txtCallMessage"></h3>
                                            <div class="mt-4">
                                                <table class="table">
                                                    <tr>
                                                        <td><b>Table No : </b></td>
                                                        <td id="waiter-tableNo"></td>
                                                    </tr>
                                                    <tr>
                                                        <td><b>Table Name : </b></td>
                                                        <td id="waiter-tableName"></td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-primary text-white"
                                                data-dismiss="modal" style="color:#910400;">Okey</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal inmodal" id="pay-modal" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content animated fadeIn">
                                <div class="ibox">
                                    <div class="ibox-content">
                                        <p class="p-y m-t text-center">
                                            <i class="fa fa-remove text-warning fa-5x"></i>
                                            <button type="button" class="close mr-3" data-dismiss="modal">
                                                <span aria-hidden="true">&#xD7;</span><span
                                                    class="sr-only">Close</span>
                                            </button>
                                        </p>
                                        <div class="modal-header">
                                        </div>
                                        <div class="modal-body">
                                            <p class="text-center">All orders will be saved as completed and paid. Do
                                                you approve the
                                                payment?</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary text-white"
                                                data-dismiss="modal" style="color:#910400;">No</button> <a
                                                onclick="payOrder()" class="btn btn-primary text-white">Yes</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <div class="footer exact-fit">
                <div class="container" id="lg-footer">
                    <div class="float-right"> <strong>Version</strong> 2.0.0</div>
                    <div> &#xA9; 2023</div>
                </div>

            </div>
        </div>
    </div>

    <script src="{{ asset('/admin/lib/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('/admin/lib/jquery/dist/jquery.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
        integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
    </script>
    <script src="{{ asset('/admin/lib/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('/admin/lib/toastr/toastr.min.js') }}"></script>

    <script src="{{ asset('/admin/js/restaurantManagerController.js') }}"></script>
    <script src="{{ asset('/admin/js/ordersOfTableController.js') }}"></script>

    {{-- js xử lý riêng từng file --}}
    <script src="{{ asset('/admin/js/table/table-create.js') }}"></script>
    <script src="{{ asset('/admin/js/table/table-delete.js') }}"></script>


    <script>
        $(function() {
            function readURL(input, selector) {
                if (input.files && input.files[0]) {
                    let reader = new FileReader();

                    reader.onload = function(e) {
                        $(selector).attr('src', e.target.result);
                    };

                    reader.readAsDataURL(input.files[0]);
                }
            }
            $("#image").change(function() {
                readURL(this, '#image_preview');
            });

        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="{{ asset('backend/assets/js/code.js') }}"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="//cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="{{ asset('backend/assets/js/tagsinput.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        @if (Session::has('message'))
            var type = "{{ Session::get('alert-type', 'success') }}"
            switch (type) {
                case 'info':
                    toastr.info(" {{ Session::get('message') }} ");
                    break;

                case 'success':
                    toastr.success(" {{ Session::get('message') }} ");
                    break;

                case 'warning':
                    toastr.warning(" {{ Session::get('message') }} ");
                    break;

                case 'error':
                    toastr.error(" {{ Session::get('message') }} ");
                    break;
            }
        @endif
    </script>
    <script>
        @if ($errors->any())
            @foreach ($errors->all() as $error)
                toastr.error("{{ $error }}")
            @endforeach
        @endif
    </script>

    <script>
        $(document).ready(function() {
            $('.select2').select2();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $('body').on('click',
                '.delete-item',
                function(event) {
                    event.preventDefault();
                    let deleteUrl = $(this).attr('href');
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
                                type: 'DELETE',
                                url: deleteUrl,
                                success: function(data) {
                                    if (data.status == 'success') {
                                        Swal.fire(
                                            'Deleted!',
                                            data.message,
                                            'success'
                                        )
                                        window.location.reload();
                                    } else if (data.status == 'error') {
                                        Swal.fire(
                                            'Cant Delete',
                                            data.message,
                                            'error'
                                        )
                                    }
                                },
                                error: function(xhr, status, error) {
                                    console.log(error);
                                }
                            })
                        }
                    })
                })
        });
    </script>

    @stack('scripts')

</body>

</html>
