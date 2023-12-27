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
                    <a href="/customer" class="btn btn-outline btn-primary btn-sm float-left">
                        <i class="fa fa-long-arrow-left mt-1"></i>
                    </a>
                    Lịch sử mua hàng
                    {{-- <a href="{{ route('create') }}" class="float-right">
                    <button class="btn btn-primary">+ Thêm mới</button>
                </a> --}}
                </h3>
                <hr />
                <input hidden value="Completed" id="lblCompleted" />
                <input hidden value="2" id="txtTableId" />

                <div class="col-md-12">
                    <div class="row table-responsive mt-3" id="nonPayOrder">
                        <table id="myTable" class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Bàn</th>
                                    <th>Sản phẩm</th>
                                    <th>Giá tiền</th>
                                    <th>Thời gian</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($customer->orders as $item)
                                    @if ($item->status == 5)
                                        <tr>
                                            <td>{{ $item->table->name }}</td>
                                            <td>
                                                <ul style="list-style: none; padding: 0;">
                                                    @foreach ($item->orderDetails as $value)
                                                       @if ($value->product == null)
                                                       <li style="text-align: left">
                                                        <p class="my-2 h6" style="color: #DFA018">
                                                            [Không xác định]
                                                        </p>
                                                    </li>
                                                       @else
                                                       <li style="text-align: left">
                                                        <p class="my-2 h6" style="color: #DFA018">
                                                            {{ $value->product->name }}
                                                        </p>
                                                    </li>
                                                       @endif

                                                    @endforeach
                                                </ul>
                                            </td>
                                            <td>{{ $item->total_price }}</td>
                                            <td>{{ $item->created_at }}</td>
                                        </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        let table = new DataTable('#myTable', {
            responsive: true
        });
    </script>
@endpush
