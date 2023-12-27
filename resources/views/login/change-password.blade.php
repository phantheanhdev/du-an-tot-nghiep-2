@extends('admin.layout.content')
@section('main-content')
<div class="col-12 col-lg-9" style="font-size: medium;">
    <div class="ibox float-e-margins" id="boxOrder">
        <div class="ibox-content">
            <div class="sk-spinner sk-spinner-wave">
                <div class="sk-rect1"></div>
                <div class="sk-rect2"></div>
                <div class="sk-rect3"></div>
                <div class="sk-rect4"></div>
                <div class="sk-rect5"></div>
            </div>
            <h1 class="text-qr Rest-dark text-center p-2">
                <a href="/restaurant-manager" class="btn btn-outline btn-primary btn-sm float-left">
                    <i class="fa fa-long-arrow-left mt-1"></i>
                </a>
                Đổi mật khẩu
            </h1>
            <input hidden value="Completed" id="lblCompleted" />
            <input hidden value="2" id="txtTableId" />

            <div class="card-body">
                    @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                    @endif
                    <form action="{{ route('update.password') }}" method="post">
                        @csrf
                        <div class="mb-3">
                            <label for="current_password" class="form-label">Mật khẩu cũ:</label>
                            <div class="input-group">
                                <input type="password" name="current_password" class="form-control" id="current_password">
                                <div class="input-group-append">
                                    <button type="button" class="btn btn-outline-secondary show-password" onclick="togglePassword('current_password')">
                                        <i class="fa-regular fa-eye"></i> Show
                                    </button>
                                </div>
                            </div>
                            @error('current_password') <div class="text-danger">{{ $message }}</div> @enderror
                        </div>

                        <div class="mb-3">
                            <label for="new_password" class="form-label">Mật khẩu mới:</label>
                            <div class="input-group">
                                <input type="password" name="new_password" class="form-control" id="new_password">
                                <div class="input-group-append">
                                    <button type="button" class="btn btn-outline-secondary show-password" onclick="togglePassword('new_password')">
                                        <i class="fa-regular fa-eye"></i> Show
                                    </button>
                                </div>
                            </div>
                            @error('new_password') <div class="text-danger">{{ $message }}</div> @enderror
                        </div>

                        <div class="mb-3">
                            <label for="confirm_password" class="form-label">Nhập lại mật khẩu mới:</label>
                            <div class="input-group">
                                <input type="password" name="confirm_password" class="form-control" id="confirm_password">
                                <div class="input-group-append">
                                    <button type="button" class="btn btn-outline-secondary show-password" onclick="togglePassword('confirm_password')">
                                        <i class="fa-regular fa-eye"></i> Show
                                    </button>
                                </div>
                            </div>
                            @error('confirm_password') <div class="text-danger">{{ $message }}</div> @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">Đổi mật khẩu</button>
                    </form>
                </div>



        </div>
    </div>
</div>
<script>
    function togglePassword(inputId) {
        var passwordInput = document.getElementById(inputId);
        var button = document.querySelector('[data-target="'+inputId+'"]');

        if (passwordInput.type == "password") {
            passwordInput.type = "text";
            button.innerHTML = '<i class="fa-regular fa-eye-slash"></i> Hide';
        } else {
            passwordInput.type = "password";
            button.innerHTML = '<i class="fa-regular fa-eye"></i> Show';
        }
    }
</script>
@endsection