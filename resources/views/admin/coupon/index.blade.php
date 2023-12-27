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
                    Manage coupons
                    <a href="{{ route('coupons.create') }}" class="float-right">
                        <button class="btn btn-primary">Create coupon</button>
                    </a>
                </h3>
                <hr />
                <input hidden value="Completed" id="lblCompleted" />
                <input hidden value="2" id="txtTableId" />

                <div class="col-md-12">
                    <div class="row table-responsive" id="nonPayOrder">
                        <table id="myTable" class="table table-hover">
                            <thead class="thead-dark">
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Code</th>
                                    <th>Discount Type</th>
                                    <th>Discount</th>
                                    <th>Start date</th>
                                    <th>End date</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($coupons as $key => $item)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->code }}</td>
                                        <td>{{ $item->discount_type }}</td>
                                        <td>{{ $item->discount }}</td>
                                        <td>{{ $item->start_date }}</td>
                                        <td>{{ $item->end_date }}</td>

                                        <td>
                                            <form action="" method="get">
                                                <select class="form-control change-status" name="status"
                                                    id="{{ $item->id }}">

                                                    <option value="1" {{ $item->status == 1 ? 'selected' : '' }}>
                                                        Active
                                                    </option>
                                                    <option value="0" {{ $item->status == 0 ? 'selected' : '' }}>
                                                        Inactive
                                                    </option>
                                                </select>
                                            </form>
                                        </td>
                                        <td>
                                            <a id="edit" href="{{ route('coupons.edit', $item->id) }}">
                                                <button class="btn btn-secondary">Edit</button>
                                            </a>
                                            <a id="{{ $item->id }}" class="deleteIcon" href="#">
                                                <button class="btn btn-danger">Delete</button>
                                            </a>
                                            {{-- {{ route('coupons.destroy', $item->id) }} --}}
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
            $('body').on('change', '.change-status', function() {
                let status = $(this).find(':selected').val();
                let id = $(this).attr('id');
                $.ajax({
                    url: "{{ route('coupons.change-status') }}",
                    method: 'GET',
                    data: {
                        status: status,
                        id: id
                    },
                    success: function(data) {
                        toastr.success(data.message)
                    },
                    error: function(xhr, status, error) {
                        console.log(error);
                    }
                })
            })
        })
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
                        url: '{{ route('delete') }}',
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
