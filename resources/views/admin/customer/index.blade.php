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
                    Khách hàng
                    {{-- <a href="{{ route('create') }}" class="float-right">
                    <button class="btn btn-primary">+ Thêm mới</button>
                </a> --}}
                </h3>
                <hr />
                <input hidden value="Completed" id="lblCompleted" />
                <input hidden value="2" id="txtTableId" />

                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-12 m5-2">
                            <div class="card">
                                <div class="d-flex card-header justify-content-between align-items-center">
                                    <h4 class="header-title">Danh sách khách hàng</h4>
                                </div>

                                <div class="card-body py-0 mb-3 mt-3">
                                    <table class="table table-responsive-md mb-0" id="myTableCustomer">
                                        <thead>
                                            <tr>
                                                <th>STT</th>
                                                <th>Số điện thoại</th>
                                                <th>Số lần mua</th>
                                                <th>Tổng tiền</th>
                                                <th>Tổng điểm </th>
                                                <th>Hành Động</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($customer as $key => $item)
                                                <tr>
                                                    <td>{{ $key + 1 }}</td>
                                                    <td>{{ $item->phone }}</td>
                                                    <td>
                                                        @php
                                                            $countPurchases = $item->orders->where('status', 5)->count();
                                                        @endphp
                                                        @if ($countPurchases > 0)
                                                            {{ $countPurchases }}
                                                        @else
                                                            0
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @php
                                                            $totalAmount = $item->orders->where('status', 5)->sum('total_price');
                                                        @endphp
                                                        {{ number_format($totalAmount) }}đ
                                                    </td>
                                                    <td>{{ number_format($item->point) }}</td>
                                                    <td>
                                                        <a href="{{ url('show-customer/' . $item->id) }}"
                                                            class="btn btn-warning btn-sm float-end mx-1">
                                                            <i class="fa-regular fa-eye"></i>
                                                        </a>
                                                        {{-- <a id="{{ $item->id }}" href=""
                                                class="btn btn-danger btn-sm float-end mx-1 deleteIcon">
                                                <i class="fa-solid fa-trash-can"></i>
                                            </a> --}}
                                                    </td>
                                                </tr>
                                            @endforeach



                                        </tbody>
                                    </table>
                                </div> <!-- end slimscroll -->
                            </div>
                            <!-- end card-->
                        </div>

                    </div>

                </div>

            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        let table = new DataTable('#myTableCustomer', {
            responsive: true
        });
    </script>
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

        });
    </script>
    <script>
        $(document).on('click', '.deleteIcon', function(e) {
            e.preventDefault();
            let id = $(this).attr('id');
            let csrf = '{{ csrf_token() }}';
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
                        url: '{{ route('delete-customer') }}',
                        method: 'delete',
                        data: {
                            id: id,
                            _token: csrf
                        },
                        success: function(response) {
                            console.log(response);
                            Swal.fire(
                                'Deleted!',
                                'Your file has been deleted.',
                                'success'
                            )
                            window.location.reload();

                        }
                    });
                }
            })
        });
    </script>
@endpush
