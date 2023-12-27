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
                    Feedback
                </h3>
                <hr />
                <input hidden value="Completed" id="lblCompleted" />
                <input hidden value="2" id="txtTableId" />


                <div class="col-md-12 mt-4">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4>Tất cả feedback của khách hàng</h4>


                                </div>

                                <div class="card-body">
                                    <table id="myTable" class="table table-responsive-md mb-0">
                                        <thead>
                                            <tr>

                                                <th>STT</th>
                                                <th>Người dùng</th>
                                                <th>Điểm</th>
                                                <th>Feedback</th>
                                                <th>Hành động</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($feedbacks as $feedback)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $feedback->customer->phone }}</td>
                                                    <td>{{ $feedback->rating }} sao</td>
                                                    <td>{{ $feedback->comment }}</td>
                                                    <td>
                                                        <a href="{{ route('feedback.destroy', $feedback->id) }}"
                                                            class="btn btn-danger ml-2 delete-item"><i
                                                                class="fa-solid fa-trash-can"></i></a>
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
