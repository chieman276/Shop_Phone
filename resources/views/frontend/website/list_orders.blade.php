@extends('admin.layouts.master')
@section('content')
<div class="container">
    <div class="search_img_box">
        <body>
            <div class="container">
                {{-- @php  $sum_product = session('cart'); 
                echo "<pre>"; print_r($sum_product); die();
                @endphp --}}
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
                            <th>Ngày sinh</th>
                            <th style="width:400px">Sản phẩm</th>
                            <th>Giá</th>
                            <th>Trạng thái</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($list_orders as $order)
                        <tr data-id="{{ $order->id }}" class="product_hide">
                            <td>{{ $order->id }}</td>
                            <td>{{ $order->user->userName }}</td>
                            <td>{{ $order->user->email }}</td>
                            <td>{{ $order->user->phone }}</td>
                            <td>{{ date('d/m/Y', strtotime($order->user->birthday)) }}</td>
                            <td>
                                <div class="row">
                                    <div class="col-lg-4"><img src="{{ asset($order->product->image) }}" style="width: 140px"></div>
                                    <div class="col-lg-8"><p>số lượng: {{$order->quantity}}</p><p>{{$order->product->productName}}</p></div>
                                </div>
                            </td>

                            <td style="color:red">{{ number_format($order->product->price * $order->quantity) }} đ</td>
                
                            @if($order->status == '0')
                            <td>
                                <button class="btn btn-success activated_status {{$order->id}}"> Chưa kích hoạt </button>
                            @else
                            <td> <button class="btn btn-secondary"> Đã kích hoạt </button> </td>
                            @endif
                        </tr>
                        @endforeach
        
                    </tbody>
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
