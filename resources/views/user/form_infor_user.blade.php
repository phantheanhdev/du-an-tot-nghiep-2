<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>FOODIE</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</head>

<body class="bg-white">
    <div class="container">

        <div class="text-center">
            <img src="{{ asset('storage/images/icon_form_user.svg') }}" alt="" class="img-fluid">
        </div>


        <div class="mt-3">
            <h2>Foodie. Xin kính chào bạn!</h2>
            <p class="py-3">Mời bạn nhập số điện thoại để nhà hàng phục vụ bạn nhanh chóng hơn, chính xác hơn</p>
        </div>

        <div class="">
            <form action="{{ route('login.customer') }}" class="text-center" method="POST">
                @csrf
                <input type="text" name="tableId" value="{{ $table_id }}" hidden>
                <input type="text" name="tableNo" value="{{ $table_no }}" hidden>
                <input type="hidden" name="password" value="foodiepassword">
                <div class="mb-3">
                    <input type="text" name="phone" class="form-control p-3 bg-body-secondary text-center"
                        placeholder="Số điện thoại của bạn">
                    @error('phone')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <button type="submit" class="btn text-white w-100 p-2"
                        style="background-color: #910400 !important;">Bắt đầu</button>
                </div>
            </form>
        </div>
    </div>
</body>

</html>
