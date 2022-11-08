@extends('admin.layouts.master')
@section('content')
<div class="container">
    <div class="search_img_box">
        <body>
            <div class="container">
                <div class="col-lg-6">
                    <h1 class="text-center mt-5">Danh sách đơn hàng</h1>
                </div>
                <div class="col-lg-12 mt-3">
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
                            <th>Tên khách hàng</th>
                            <th>Email</th>
                            <th>Số điên thoại</th>
                            {{-- <th>Ngày sinh</th> --}}
                            <th style="width:400px">Sản phẩm</th>
                            <th>Mã giảm giá</th>
                            <th>Giá</th>
                            <th>Trạng thái</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($list_orders as $key => $order)
                        <tr data-id="{{ $order->id }}" class="product_hide">
                            <td>{{ ++$key }}</td>
                            <td>{{ $order->user->userName }}</td>
                            <td>{{ $order->user->email }}</td>
                            <td>{{ $order->user->phone }}</td>
                            {{-- <td>{{ date('d/m/Y', strtotime($order->user->birthday)) }}</td> --}}
                            @php 
                            $total =  $order->product->price * $order->quantity; 
                            $total_discount =  $order['total']; 
                            $discount = $total - $total_discount;
                            @endphp
                            <td>
                                <div class="row">
                                    <div class="col-lg-4"><img src="{{ asset($order->product->image) }}" style="width: 140px"></div>
                                    <div class="col-lg-8"><p>{{$order->product->productName}}</p><p>số lượng: {{$order->quantity}}</p> <p style="color:red">Tổng tiền: {{number_format($total)}} đ</p></div>
                                </div>
                            </td>
                            <td style="color:red">
                                @if($total - $total_discount > 0)
                                <p style="color:red">{{ number_format($discount) }} đ</p>
                                @endif
                            </td>
                            <td style="color:red">{{ number_format($total_discount) }} đ 
                            </td>
                
                            @if($order->status == '0')
                            <td>
                                <button class="btn btn-success activated_status {{$order->id}}"> Chưa kích hoạt 🔒</button>
                            @else
                            <td> <button class="btn btn-secondary"> Đã kích hoạt 🔑 </button> </td>
                            @endif
                        </tr>
                        @endforeach
                </table>
                <div style="float:right">            
                    {{ $list_orders->links() }}
                </div>
            </div>
        
        </body>
        
    </div>
</div>

<script type="text/javascript">
    $(".activated_status").click(function (e) {
        e.preventDefault();
        var ele = $(this);
        if(confirm('Bạn có muốn kích hoạt ?')) {
            $.ajax({
                url: '{{ route('update_list_orders') }}',
                method: "patch",
                data: {
                    _token: '{{ csrf_token() }}', 
                    id: ele.parents("tr").attr("data-id"),
                },

                success: function (response) {
                    window.location.reload();
                }
            });
        }
    });
</script>
@endsection
