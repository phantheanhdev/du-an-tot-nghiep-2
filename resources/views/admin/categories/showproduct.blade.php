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
                    <a href="{{ route('category.index') }}" class="btn btn-outline btn-primary btn-sm float-left">
                        <i class="fa fa-long-arrow-left mt-1"></i>
                    </a>
                    Danh sách sản phẩm thuộc danh mục <span style="color: red;">{{ $category->category_name }}</span>
                  

                </h3>
                <hr />
                <input hidden value="Completed" id="lblCompleted" />
                <input hidden value="2" id="txtTableId" />

                <div class="col-md-12">
                    <div class="card-body" id="nonPayOrder">
                        <table id="myTable" class="display ">
                            <thead class="thead-dark">
                                <tr>
                                    <th>STT</th>
                                    <th>Hình Ảnh</th>
                                    <th>Tên sản phẩm</th>
                                    <th>Giá tiền</th>
                                    <th>Trạng thái</th>
                                  
                                </tr>
                            </thead>
                         <tbody>
                                @foreach ($products as $key => $item)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td><img width="100px" height="100px"
                                                src="{{ $item->image ? '' . Storage::url($item->image) : 'https://www.freeiconspng.com/uploads/img-landscape-photo-photography-picture-icon-12.png' }}"
                                                alt=""></td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ formatNumberPrice($item->price) }}</td>
                              
            
                                        <td>
                                            @if ($item->status == 'active')
                                                <span class="badge badge-success">Active</span>
                                            @else
                                                <span class="badge badge-danger">Inactive</span>
                                            @endif
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
