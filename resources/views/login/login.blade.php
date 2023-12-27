<html>

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login - QR MENU</title>
    <link rel="shortcut icon" type="image/png" href="/images/favicon.png" />
    <link rel="stylesheet" href="{{ asset('/lib/bootstrap/dist/css/bootstrap.min.css') }}" />
    <link href="{{ asset('/lib/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('admin/css/animate.css') }}" rel="stylesheet" />
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Yeon+Sung&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('admin/css/site.css') }}" />
    <link href="{{ asset('/css/chapterTitle.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('/lib/iCheck/square/red.css') }}">
</head>

<body class="gray-bg">
    <div class="loginColumns animated fadeInDown">
        <div class="row">
            <div class="col-lg-6 ibox-content" id="lg-land" style="background-image: url('{{ asset('qr-menu.jpg') }}'); background-size: cover;">
            </div>
            <div class="col-lg-6" id="loginBox">
                <div class="col-md-12 ibox-content">
                    <div class="sk-spinner sk-spinner-wave">
                        <div class="sk-rect1"></div>
                        <div class="sk-rect2"></div>
                        <div class="sk-rect3"></div>
                        <div class="sk-rect4"></div>
                        <div class="sk-rect5"></div>
                    </div>
                    <br>
                    <div class="enhanced-hr enhanced-hr-2">
                        <span>WELCOME </span>
                    </div>
                    <br>
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <span class="text-danger field-validation-valid" data-valmsg-for="UserName" data-valmsg-replace="true"></span>
                        <div class="form-group">
                            <input placeholder="Username" class="form-control" type="text" data-val="true" data-val-required="Please enter username." id="UserName" name="username" value="">
                            @error('username')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div> <span class="text-danger field-validation-valid" data-valmsg-for="Password" data-valmsg-replace="true"></span>
                        <div class="form-group">
                            <input type="password" placeholder="Password" class="form-control" data-val="true" data-val-required="Please enter password." id="Password" name="password">
                            @error('password')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror

                        </div>
                        <button type="submit" class="btn btn-outline btn-primary btn-block">
                            <span>LOGIN</span>
                        </button>
                        <br>
                </div>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-lg-6"></div>
            <div class="col-lg-6 text-right">
                <small>Copyright &#xA9; 2023</small>

            </div>
        </div>
    </div>
    <script src="{{ asset('/lib/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('/lib/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('/admin/lib/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('/admin/lib/jquery/dist/jquery.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
    </script>
    <script src="{{ asset('/admin/lib/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('/admin/lib/toastr/toastr.min.js') }}"></script>

    <script src="{{ asset('/admin/js/restaurantManagerController.js') }}"></script>
    <script src="{{ asset('/admin/js/ordersOfTableController.js') }}"></script>

    {{-- js xử lý riêng từng file --}}
    <script src="{{ asset('/admin/js/table/table-create.js') }}"></script>
    <script src="{{ asset('/admin/js/table/table-delete.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="{{ asset('backend/assets/js/code.js') }}"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="//cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="{{ asset('backend/assets/js/tagsinput.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
         @if(Session::has('message'))
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
</body>

</html>