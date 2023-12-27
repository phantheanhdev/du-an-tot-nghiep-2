@extends('admin.layout.content')
@section('main-content')
    <div class="col-12 col-lg-9">

        <div class="ibox float-e-margins" id="boxOrder">
            <div class="ibox-content mb-3">

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
                    Quản lý bàn
                    <a href="{{ route('table.create') }}" class="float-right">
                        <button class="btn btn-primary">Thêm bàn</button>
                    </a>

                </h3>
                <input hidden value="Completed" id="lblCompleted" />
                <input hidden value="2" id="txtTableId" />

            </div>

            <div class="row ml-lg-4">

                @foreach ($all_table as $table)
                    <div class="ibox-content col-12 col-lg-3 mb-3 p-0">
                        <div class="card border-0" style="">

                            {{-- img qr --}}
                            <img src="{{ $table->qr }}" class="card-img-top p-0 qr-image" alt="qr code">


                            <div class="card-body text-center">
                                <div class="d-flex justify-content-center">
                                    <a href="{{ route('table.edit', $table->id) }}" class="mx-3">
                                        <button class="btn btn-success">
                                            <i class="fa-solid fa-pen"></i>
                                        </button>
                                    </a>
                                    {{--  --}}                                    

                                    @if (count($table->orders))
                                    <form action="{{ route('table.destroy', $table->id) }}" method="post"
                                        id="table-form-delete" class="mx-3" onsubmit="return confirmDelete()">
                                        @csrf
                                        @method('DELETE')

                                        <button class="btn btn-danger" type="submit" disabled id="table-btn-delete">
                                            <i class="fa-solid fa-trash-can"></i>
                                        </button>
                                    </form>
                                    @else
                                    <form action="{{ route('table.destroy', $table->id) }}" method="post"
                                        id="table-form-delete" class="mx-3" onsubmit="return confirmDelete()">
                                        @csrf
                                        @method('DELETE')

                                        <button class="btn btn-danger" type="submit" id="table-btn-delete">
                                            <i class="fa-solid fa-trash-can"></i>
                                        </button>
                                    </form>
                                    @endif

                                </div>

                                <h3 class="card-title">Tên bàn: {{ $table->name }}</h3>
                                <h3 class="card-title">Loại bàn: {{ $table->type }}</h3>

                                <a href="{{ route('download_qr_code', $table->id) }}" class="btn btn-primary">Tải QR</a>

                            </div>
                        </div>
                    </div>
                    {{-- ô trống --}}
                    <div class="col-lg-1"></div>
                @endforeach
            </div>
        </div>
    </div>

    <script>
        function confirmDelete() {
            var result = confirm("Bạn có chắc chắn muốn xóa không?");
            return result;
        }
    </script>
@endsection
