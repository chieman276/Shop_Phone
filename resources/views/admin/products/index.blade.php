@extends('admin.layouts.master')

@section('content')


<body>
    <div class="container">

        <div class="col-lg-6">
            <h1 class="text-center mt-5">Danh sách sản phẩm</h1>
        </div>
        <div class="col-lg-12 mt-3">
            <div class="row">
                <div class="col-lg-2">
                    <a href="{{route('products.create')}}" class="btn btn-primary">Thêm sản phẩm</a>
                </div>
                <div class="col-lg-5">

                    <a href="{{route('products.export')}}" class="btn btn-primary">
                        <i class="fas fa-file"></i>
                        <span class="ml-1">Xuất Sản Phẩm</span>
                    </a>
                </div>
                <div class="col-lg-5">
                    <form action="{{ route('products.import') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-lg-5"><button class="btn btn-success">Thêm Nhiều Sản Phẩm</button>
                            </div>
                            <div class="col-lg-7">
                                <input type="file" name="file" class="form-control">
                            </div>
                        </div>
                </div>
                </form>
            </div>


        </div>

        <br>
        @if (Session::has('success'))
        <div class="alert alert-success">{{session::get('success')}}</div>
        @endif
        @if (Session::has('error'))
        <div class="text text-danger">{{session::get('error')}}</div>
        @endif
        <br>
        <form action="{{ route('delete_many')}}" style="display:inline" method="post">
            @csrf
            @method('delete')
            <button type="submit" onclick="return confirm('Bạn có chắc muốn xóa sản phẩm !')" class="btn btn-success sent">Xóa Nhanh</button>
            @if ($errors->any())
            <p style="color:red">{{ $errors->first('ids') }}</p>
            @endif
            <table class="table table-bordered mt-3">
                <thead>
                    <tr class="text-center">
                        <th><input type="checkbox" id="checkAll">#</th>
                        <th>Tên sản phẩm</th>
                        <th>hình ảnh</th>
                        <th>Giá sản phẩm</th>
                        <th>Chức năng</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                    <tr class="text-center">
                        <td><input type="checkbox" class="checkItem" name="ids[{{$product->id}}]"
                            value="{{$product->id}}">{{ $product->id }}</td>
                        <td style="width: 120px">{{ $product->productName }} </td>
                        <td><img src="{{ asset($product->image) }}" style="width: 140px"> </td>
                        <td>{{ number_format($product->price) }}</td>

                        <td>
                            {{-- <a href="{{ route('products.show',$product->id )}}" class="btn btn-primary">Xem</a> --}}
                            <a href="{{ route('products.edit',$product->id )}}" class="btn btn-warning">Sửa</a>
                            <form action="{{ route('products.destroy',$product->id )}}" style="display:inline"
                                method="post">
                                @csrf
                                @method('delete')
                                <button class="btn btn-danger"
                                    onclick="return confirm('Xóa {{$product->productName}} ?')">Xóa</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </form>
    
    </div>
</body>
<script>
    $('#checkAll').click(function () {
        $(':checkbox.checkItem').prop('checked', this.checked);
    });
    $('#checkItem').click(function () {
        $(':checkbox.checkItem').prop('checked', this.checked);
    });
</script>
@endsection