@extends('admin.layouts.master')

@section('content')


<body>
    <div class="container">

        <div class="col-lg-6">
            <h1 class="text-center mt-5">Danh sách mã giảm giá</h1>
        </div>
        <div class="col-lg-12 mt-3">
            <a href="{{route('discounts.create')}}" class="btn btn-primary">Thêm</a>
        </div>
        <br>

        @if (Session::has('success'))
        <div class="alert alert-success">{{session::get('success')}}</div>
        @endif
        @if (Session::has('error'))
        <div class="text text-danger">{{session::get('error')}}</div>
        @endif
        <br>
        <table class="table table-bordered mt-3">
            <thead>
                <tr class="text-center">
                    <th>#</th>
                    <th>Tên mã giảm giá</th>
                    <th>Giá tiền</th>
                    <th>Sản phẩm</th>
                    <th>Khách hàng</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($discounts as $key => $discount)
                <tr class="text-center">
                    <td>{{ ++$key }}</td>
                    <td>{{ $discount->discountName }}</td>
                    <td>{{ $discount->price }}</td>
                    <td>{{ $discount->product->productName}}</td>
                    <td>{{ $discount->user->userName}}</td>
                </tr>
                @endforeach

            </tbody>
        </table>
        <div style="float:right">
        {{$discounts->links()}}
        </div>
    </div>

</body>



@endsection