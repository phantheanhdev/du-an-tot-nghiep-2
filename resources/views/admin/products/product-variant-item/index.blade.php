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
                    <a href="{{ route('products-variant.index', ['product' => $product->id]) }}"
                        class="btn btn-outline btn-primary btn-sm float-left">
                        <i class="fa fa-long-arrow-left mt-1"></i>
                    </a>
                    Danh Sách Biến Thể Chi Tiết ({{ $variant->name }})
                    <a href="{{ route('products-variant-item.create', ['productId' => $product->id, 'variantId' => $variant->id]) }}"
                        class="float-right">
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
                                    <th class="text-center">STT</th>
                                    <th class="text-center">Tên</th>
                                    <th class="text-center">Tên biến thể</th>
                                    <th class="text-center">Giá</th>
                                    <th class="text-center">Hành Động</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($variantItem as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->productVariant->name }}</td>
                                        <td>{{ $item->price }}</td>
                                        <td>

                                            <a href="{{ route('products-variant-item.edit', $item->id) }}"
                                                class="btn btn-primary"><i class='far fa-edit'></i></a>
                                            <a href="{{ route('products-variant-item.destroy', $item->id) }}"
                                                class="btn btn-danger ml-2 delete-item"><i class='far fa-trash-alt'></i></a>
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
