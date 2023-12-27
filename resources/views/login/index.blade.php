@extends('admin.layout.content')
@section('main-content')
<div class="col-12 col-lg-9">
    @include('error')
    <div class="ibox float-e-margins" id="boxOrder">
        <div class="ibox-content">
            <div class="sk-spinner sk-spinner-wave">
                <div class="sk-rect1"></div>
                <div class="sk-rect2"></div>
                <div class="sk-rect3"></div>
                <div class="sk-rect4"></div>
                <div class="sk-rect5"></div>
            </div>
            <h2 class="text-qr Rest-dark text-center p-2">
                <a href="#" id="goBackButton" class="btn btn-outline btn-primary btn-sm float-left">
                    <i class="fa fa-long-arrow-left mt-1"></i>
                </a>
                Quản lí tài khoản
                <a href="{{ route('register') }}" class="float-right">
                    <button class="btn btn-primary">Tạo tài khoản</button>
                </a>

            </h2>
            <input hidden value="Completed" id="lblCompleted" />
            <input hidden value="2" id="txtTableId" />

            <div class="col-md-12">
                <div class="row table-responsive" id="nonPayOrder">
                    <table class="table table-hover">
                        <thead class="thead-dark">
                            <tr>
                                <th>#</th>
                                <th>Tên đăng nhập</th>
                                <th>Loại tài khoản</th>
                                <th>Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($user as $key => $user)
                            <tr>
                                <td>{{$key +1}}</td>
                                <td>{{$user->username }}</td>
                                <td>
                                    @if ($user->role == 0)
                                    <span class="badge badge-primary">Nhân viên</span>
                                    @elseif ($user->role == 1)
                                    <span class="badge badge-danger">Admin</span>
                                    @endif
                                </td>
                                <td class="d-flex justify-content-center">
                                    <a id="edit" class="px-2" href="{{ route('user.edit', ['id' => $user->id]) }}">
                                        <button class="btn btn-success">
                                            <i class="fa-solid fa-pen"></i>
                                        </button>
                                    </a>
                                    <a id="delete" href="{{ route('user.delete', ['id' => $user->id]) }}">
                                        <button class="btn btn-danger">
                                            <i class="fa-solid fa-trash-can"></i>
                                        </button>
                                    </a>
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
<script>
    document.getElementById('goBackButton').addEventListener('click', function() {
        history.back();
    });
</script>
@endsection