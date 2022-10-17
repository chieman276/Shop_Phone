@extends('backend.layouts.master')

@section('content')

<main>
    <div class="container-fluid px-4">
        <br>
        <button id="start">Start</button>
        <button id="stop">Stop</button>
        <div></div>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active"><h1 class="">Trang chủ</h1></li>
        </ol>
        <div class="row">
            <div class="col-xl-1 col-md-6">
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card bg-primary text-white mb-4">
                    <div class="card-body">Danh mục sản phẩm</div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="{{ route('categories.index')}}">Xem chi tiết</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card bg-warning text-white mb-4">
                    <div class="card-body">Danh sách sản phẩm</div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="{{ route('products.index')}}">Xem chi tiết</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card bg-success text-white mb-4">
                    <div class="card-body">Danh sách khách hàng</div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="{{ route('customers.index')}}">Xem chi tiết</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>
            {{-- <div class="col-xl-3 col-md-6">
                <div class="card bg-danger text-white mb-4">
                    <div class="card-body">Danger Card</div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="#">View Details</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div> --}}
        </div>
        <div class="row">
            <div class="col-lg-6">
                <h1><b> Tổng Sản Phẩm: {{$products}}</b></h1>
            </div>
            <div class="col-lg-6">
                <h1><b> Tổng Số Khách Hàng: {{$customers}}</b></h1>
            </div>
        </div>
    </div>
</main>
<script>
    $( "#start" ).click(function() {
      var myDiv = $( "div" );
      myDiv.show( "slow" );
      myDiv.animate({
        left:"+=200"
      }, 5000 );
     
      myDiv.queue(function() {
        var that = $( this );
        that.addClass( "newcolor" );
        that.dequeue();
      });
     
      myDiv.animate({
        left:"-=200"
      }, 1500 );
      myDiv.queue(function() {
        var that = $( this );
        that.removeClass( "newcolor" );
        that.dequeue();
      });
      myDiv.slideUp();
    });
     
    $( "#stop" ).click(function() {
      var myDiv = $( "div" );
      myDiv.clearQueue();
      myDiv.stop();
    });
    </script>
     
@endsection