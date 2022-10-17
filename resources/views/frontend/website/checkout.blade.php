@extends('frontend.layouts.master')
@section('content')
<div class="search_img_box">
    <div class="row">
        <div class="col-lg-2"></div>
        <div class="col-lg-10">
            <div class="session-title">
                @if (Session::has('success'))
                </div>
                <div class="text text-success"><h3><b>{{session::get('success')}}</b></h3></div>
                @endif
                @if (Session::has('error'))
                <div class="text text-danger"><h3><b>{{session::get('error')}}</b></h3></div>
                @endif
            </div>
        </div>
    </div>
    <div class="shopper-informations">
        @php
        $sum_product = session('cart');
        // foreach ($sum_product as $id_product){
        //     $id = $id_product['id'];
        //     echo "<pre>"; print_r($id);echo "</pre>";
        //     }
        @endphp
        @if(count($sum_product) >= 1)
        <div class="row">
            <div class="col-sm-1">
            </div>
            <div class="col-sm-6">
                <table id="cart" class="table table-hover table-condensed">
                    <thead>
                        <tr>
                            <th style="width:60%">
                                <h3>Sản Phẩm</h3>
                            </th>
                            <th style="width:40%">
                                <h3>Tổng tiền</h3>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $total = 0 @endphp
                        @if(session('cart'))
                        @foreach(session('cart') as $id => $details)
                        @php $total += $details['price'] * $details['quantity'] @endphp
                        <tr data-id="{{ $id }}">
                            <td data-th="Product">
                                <div class="row">
                                    <div class="col-sm-5 hidden-xs"><img src="{{ $details['image'] }}" width="100"
                                            height="100" class="img-responsive" /></div>
                                    <div class="col-sm-7">
                                        <p>
                                        <h4 class="nomargin">{{ $details['productName'] }}</h4>
                                        <h6> <b> Số lượng: {{ $details['quantity'] }}</b></h6>
                                        </p>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <h4 class="nomargin">{{ $details['price'] * $details['quantity']}} đ</h4>
                            </td>
                        </tr>
                        @endforeach
                        @endif
                    </tbody>
                    <tfoot>
                        <tr>
                            <tbody>
                                <td colspan="5" class="text-center">
                                    <h3 style="color:red ;"><strong>Tổng cộng tiền thanh toán:{{ number_format(
                                            $total)}}
                                            đ</strong></h3>
                                            {{-- @php
                                            foreach ($sum_product as $id_product){
                                                $orders['user_id'] = $userAll->id;
                                                $orders['product_id'] = $id_product['id'];
                                                DB::table('orders')->insert($orders);
                                            }
                                            @endphp--}}
                                    <a href="{{ route('websiteProduct') }}" class="btn btn-warning"><i
                                            class="fa fa-angle-left"></i> Trở về</a>
                                    <button class="btn btn-success remove-from-cart">Mua</button>
                                </td>
                            </tbody>
                        </tr>
                    </tfoot>
                </table>
            </div>
            <div class="col-sm-4">
                <table id="cart" class="table table-hover table-condensed">
                    <thead>
                        <tr>
                            <th>
                                <h3>Thông tin khách hàng</h3>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <h4>Tên khách hàng: </h4>
                            </td>
                            <td>
                                <h4>{{$userAll->userName}}</h4>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <h4>Email: </h4>
                            </td>
                            <td>
                                <h4>{{$userAll->email}}</h4>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <h4>Số điện thoại: </h4>
                            </td>
                            <td>
                                <h4>{{$userAll->phone}}</h4>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <h4>Ngày sinh: </h4>
                            </td>
                            <td>
                                <h4>{{ date('d/m/Y', strtotime($userAll->birthday))}}</h4>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <hr>
            </div>
        </div>
        @else
        <br>
        <div class="row">
            <div class="col-sm-2">
            </div>
            <div class="col-sm-10">
                <h3 class="container">Đơn hàng trống! <a href="{{route('websiteProduct')}}">-> Đi tới trang sản phẩm</a> </h3> 
            </div>
            <br><br><br><br><br><br><br><br>
        </div>
        @endif
        <br>
    </div>
</div>

@endsection

@section('scripts')
<script type="text/javascript">
    $(".remove-from-cart").click(function (e) {
        e.preventDefault();
        var ele = $(this);
        if(confirm('Bạn có chắc muốn mua sản phẩm')) {
            $.ajax({
                url: '{{ route('orders') }}',
                method: "post",
                data: {
                    _token: '{{ csrf_token() }}', 
                    // sum_product: $('.sum_product').val(),
                },

                success: function (response) {
                    window.location.reload();
                }
            });
        }
    });
</script>

@endsection 