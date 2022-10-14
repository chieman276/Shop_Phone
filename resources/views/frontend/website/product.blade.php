@extends('frontend.layouts.master')

@section('content')

<div class="col-sm-12 padding-right">
    <div class="features_items">
        <div class="container">
            @if (Session::has('success'))
            <div class="text text-success"> <h3><b>{{session::get('success')}}</b></h3> </div>
            @endif
        </div>
        <br><br>
        <!--features_items-->
        <h1 class="title text-center">Danh Sách Sản Phẩm</h1>
        @foreach ($products as $product)
        <div class="col-sm-4">
            <div class="product-image-wrapper">
                <div class="single-products">
                    <a href="{{ route('showProduct',$product->id) }}">
                        <div class="productinfo text-center">
                            <img src="{{$product->image}}" width="350px" height="520px" alt="" />
                            <h2 style="color: red">{{ number_format( $product->price) }} đ</h2>
                            <p>{{ $product->productName}}</p>
                            <p class="btn-holder"><a href="{{ route('add.to.cart', $product->id) }}" class="btn btn-warning btn-block text-center" role="button">Thêm vào giỏ hàng</a> </p>

                        </div>
                    </a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    <!--features_items-->

</div>
@endsection