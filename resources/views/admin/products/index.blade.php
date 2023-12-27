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
                    Danh Sách Thực Đơn
                    <a href="{{ route('create') }}" class="float-right">
                        <button class="btn btn-primary">+ Thêm mới</button>
                    </a>
                </h3>
                <hr />
                <input hidden value="Completed" id="lblCompleted" />
                <input hidden value="2" id="txtTableId" />

                <div class="col-md-12">
                    <div class="row table-responsive" id="nonPayOrder">
                        <table id="myTable" class="display">
                            <thead class="thead-dark">
                                <tr>
                                    <th>STT</th>
                                    <th>Hình Ảnh</th>
                                    <th>Tên Món</th>
                                    <th>Giá</th>
                                    <th>Sự Miêu Tả</th>
                                    <th>Tên Danh Mục</th>
                                    <th>Trạng Thái</th>
                                    <th>Hành Động</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($product as $key => $item)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>
                                            <img width="100px" height="100px"
                                                src="{{ $item->image ? Storage::url($item->image) : 'https://www.freeiconspng.com/uploads/img-landscape-photo-photography-picture-icon-12.png' }}"
                                                alt="">
                                        </td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ formatNumberPrice($item->price) }}</td>
                                        <td>{{ \Illuminate\Support\Str::limit( $item->description, 20, $end = '...') }}</td>
                                        <td>{{ $item->category_name }}</td>
                                        <td>
                                            @if ($item->status == 'active')
                                                <span class="badge badge-success">Active</span>
                                            @else
                                                <span class="badge badge-danger">Inactive</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('products-variant.index', ['product' => $item->id]) }}"
                                                class="btn btn-primary"><i class="fa-solid fa-gear"></i></a>
                                            <a id="edit" href="{{ route('product.edit', ['id' => $item->id]) }}">
                                                <button class="btn btn-success"><i class="fa-solid fa-pen"></i></button>
                                            </a>


                                            {{-- @php
                                                $orderDetail = \App\Models\OrderDetail::where('product_id', $item->id)->count();
                                            @endphp
                                            @if ($orderDetail > 0)
                                                <a id="delete" href="{{ route('product.delete', ['id' => $item->id]) }}">
                                                    <button class="btn btn-danger" disabled><i
                                                            class="fa-solid fa-trash-can"></i></button>
                                                </a>
                                            @else
                                                <a id="delete"
                                                    href="{{ route('product.delete', ['id' => $item->id]) }}">
                                                    <button class="btn btn-danger"><i
                                                            class="fa-solid fa-trash-can"></i></button>
                                                </a>
                                            @endif --}}
                                            <a id="delete"
                                            href="{{ route('product.delete', ['id' => $item->id]) }}">
                                            <button class="btn btn-danger"><i
                                                    class="fa-solid fa-trash-can"></i></button>
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
@endsection

@push('scripts')
    <script>
        let table = new DataTable('#myTable', {
            responsive: true
        });
    </script>
@endpush
