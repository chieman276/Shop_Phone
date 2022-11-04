@extends('admin.layouts.master')

@section('content')

<main>
    <div class="container-fluid px-4">
        <br><br>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active"><h1 class="">Trang chủ</h1></li>
        </ol>
        <br><br><br><br>
        <div class="row">
            <div class="col-xl-1 col-md-6">
            </div>
            <div class="col-xl-5 col-md-6">
                <div class="card bg-warning text-white mb-4">
                    <h1 class="text-center">Có tổng số {{$user_count}} tài khoản</h1>
                </div>
            </div>
            <div class="col-xl-5 col-md-6">
                <div class="card bg-primary text-white mb-4">
                    <h1 class="text-center">Có tổng số {{$product_count}} sản phẩm</h1>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-3 col-md-6">
            </div>
            <div class="col-xl-5 col-md-6">
                <div class="card bg-info text-white mb-4">
                    <h1 class="text-center">&emsp;Có tổng số {{$order_count}} đơn hàng&emsp;</h1>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-1 col-md-6">
            </div>
            <div class="col-xl-5 col-md-6">
                <div class="card bg-warning text-white mb-4">
                    <h1 class="text-center">Có tổng số {{$discount_count}} mã giảm giá</h1>
                </div>
            </div>
            <div class="col-xl-5 col-md-6">
                <div class="card bg-primary text-white mb-4">
                    <h1 class="text-center">Có tổng số {{$comment_count}} bình luận</h1>
                </div>
            </div>
        </div>
    </div>
</main>

     
@endsection