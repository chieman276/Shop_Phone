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
                        <input type="text" id="name" name="discountName" placeholder="Nhập mã giảm giá" class="form-control">
                        <label id="name-error" class="error" for="name" style="display: none;color:red">Vui lòng nhập
                            tên mã giảm giá
                        </label>
                    </div>
                    <div class="form-group">
                        <label>Giá tiền</label>
                        <input type="text" id="price" name="price" placeholder="Nhập giá tiền" class="form-control">
                        <label id="price-error" class="error" for="price" style="display: none;color:red">Vui lòng nhập
                            giá tiền
                        </label>
                    </div>
                    <div class="form-group">
                        <label>Sản phẩm</label>
                        <select class="form-select form-control" id="product_id" name="product_id">
                            <option>Vui lòng chọn</option>
                            @foreach($products as $product)
                            <option value="{{ $product->id }}">{{ $product->productName }} </option>
                            @endforeach
                        </select>
                        <label id="product-error" class="error" style="display: none;color:red">Vui lòng nhập
                            sản phẩm
                        </label>
                    </div>
                    <div class="form-group">
                        <label>Khách hàng</label>
                        <select class="form-select form-control" id="user_id" name="user_id">
                            <option>Vui lòng chọn</option>
                            @foreach($users as $user)
                            <option value="{{ $user->id }}">{{ $user->userName }} </option>
                            @endforeach
                        </select>
                        <label id="user-error" class="error" style="display: none;color:red">Vui lòng nhập
                            khách hàng
                        </label>
                    </div>
                    <button style="float: right" class="submit btn btn-primary add_validate">Thêm</button>
                    <a href="{{ route('discounts.index')}}" class="btn btn-secondary">Trở về</a>
                </div>
                <div class="col-lg-3"></div>
            </div>
        </div>
</div>
</form>
</div>
<script>
    $(document).ready(function () {
        $('.add_validate').click(function () {
            var can_submit = true;
            var name = $('#name').val();
            if (name == "") {
                $('#name-error').show();
                can_submit = false;
            }else{
                $('#name-error').hide();
            }

            var name = $('#price').val();
            if (name == "") {
                $('#price-error').show();
                can_submit = false;
            }else{
                $('#price-error').hide();
            }

            
            var name = $('#product_id').val();
            if (name == "Vui lòng chọn") {
                $('#product-error').show();
                can_submit = false;
            }else{
                $('#product-error').hide();
            }

            var name = $('#user_id').val();
            if (name == "Vui lòng chọn") {
                $('#user-error').show();
                can_submit = false;
            }else{
                $('#user-error').hide();
            }


            if (can_submit == false) {
                return false;
            }
        });
    });
</script>
@endsection