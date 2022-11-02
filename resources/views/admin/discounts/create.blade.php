@extends('admin.layouts.master')

@section('content')

<div class="container">
    <h1 class="text-center mt-3">Thêm Mã Giảm Giá </h1>
    <form method="post" action="{{route('discounts.store')}}">
        @csrf
        <div class="container">
            <div class="row">
                <div class="col-lg-3"></div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label>Tên mã giảm giá</label>
                        <input type="text" id="name" name="discountName" class="form-control">
                        <label id="name-error" class="error" for="name" style="display: none;color:red">Vui lòng nhập
                            tên mã giảm giá
                        </label>
                        <label>Giá tiền</label>
                        <input type="text" id="price" name="price" class="form-control">
                        <label id="price-error" class="error" for="price" style="display: none;color:red">Vui lòng nhập
                         giá tiền
                        </label>
                        <label>Sản phẩm</label>
                        <select class="form-select form-control" name="product_id">
                            <option>Vui lòng chọn</option>
                            @foreach($products as $product)
                            <option value="{{ $product->id }}">{{ $product->productName }} </option>
                            @endforeach
                        </select>

                        <label>Khách hàng</label>
                        <select class="form-select form-control" name="user_id">
                            <option>Vui lòng chọn</option>
                            @foreach($users as $user)
                            <option value="{{ $user->id }}">{{ $user->userName }} </option>
                            @endforeach
                        </select>
                    </div>
                    <button style="float: right" class="submit btn btn-primary">Thêm</button>
                    <a href="{{ route('discounts.index')}}" class="btn btn-secondary">Trở về</a>
                </div>
                <div class="col-lg-3"></div>
            </div>
        </div>
</div>
</form>
</div>

@endsection