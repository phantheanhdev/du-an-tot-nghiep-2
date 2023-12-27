<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>FOODIE</title>
    <link rel="shortcut icon" type="image/png" href="/images/favicon.png" />
    <link rel="stylesheet" href="{{ asset('lib/bootstrap/dist/css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('/admin/lib/font-awesome/css/font-awesome.min.css') }}" />
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="stylesheet" href="{{ asset('/admin/lib/toastr/toastr.min.css') }}" />
    <link href="{{ asset('/admin//css/animate.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('user/css/site.css') }}" />
    <link
        href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,600;0,700;1,300;1,400;1,700&display=swap"
        rel=stylesheet>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons|Material+Icons+Round" rel=stylesheet>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
    integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        td {
            vertical-align: middle !important;
        }

        .spacer {
            height: 70px;
        }
        .product_qty_wrapper {
            display: flex;
        }

        .product_qty_wrapper>.product-qty {
            width: 43px;
            height: 36px;
            padding-left: 5px;
            text-align: center;
        }
    </style>
    <link href="{{ asset('user/css/orderMenu.css') }}" rel="stylesheet">

</head>

<body>
