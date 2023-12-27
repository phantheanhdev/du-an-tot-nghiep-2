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
                    <a href="/restaurant-manager" class="btn btn-outline btn-primary btn-sm float-left">
                        <i class="fa fa-long-arrow-left mt-1"></i>
                    </a>
                </h3>
                <hr />
                <input hidden value="Completed" id="lblCompleted" />
                <input hidden value="2" id="txtTableId" />

                <div class="col-md-12">
                    <div class="row table-responsive" id="nonPayOrder">
                        <table class="table table-hover text-center">

                            <thead class="thead-dark text-center">
                                <tr>
                                    <th>Table</th>
                                    <th>Product</th>
                                    <th>Customer Name</th>
                                    <th>Note</th>
                                    <th>Clock</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($orders as $item)
                                    <tr>
                                        <td>{{ $item->table->name }}</td>
                                        <td>
                                            <ul style="list-style: none; padding: 0;">
                                                @foreach ($item->orderDetails as $orderDetail)
                                                    <li>
                                                        {{ $orderDetail->quantity }} x
                                                        {{ $orderDetail->product->name }}
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </td>
                                        <td>{{$item->customer_name}}</td>
                                        <td>{{ $item->note }}</td>
                                        <td>{{ $item->created_at }}</td>
                                        <th>
                                            @if ($item->status == 1)
                                                <span>Confirmed </span>
                                            @elseif ($item->status == 3)
                                                <span>Preparing</span>
                                            @elseif ($item->status == 4)
                                                <span>Came out the dish</span>
                                            @endif
                                        </th>
                                        <td>
                                            <form action="" method="get">
                                                <select class="form-control order-status" name="status"
                                                    id="{{ $item->id }}">
                                                    <option value="1"
                                                        {{ $item->status == 1 ? 'selected' : '' }}>
                                                        Confirmed
                                                    </option>
                                                    <option value="3"
                                                        {{ $item->status == 3 ? 'selected' : '' }}>
                                                        Preparing
                                                    </option>
                                                    <option value="4"
                                                        {{ $item->status == 4 ? 'selected' : '' }}>
                                                        Came out the dish
                                                    </option>
                                                </select>
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
@endsection
@push('scripts')
    <script>
        $(document).ready(function() {
            $('body').on('change','.order-status', function() {
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

@endpush
