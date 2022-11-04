@extends('frontend.layouts.master')

@section('content')

<div class="container" id="exampleModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-7">
                        <div>
                            <p class="product_id">{{$showProduct->id}}</p>
                            <img src="{{asset($showProduct->image)}}" height="350px" width="330px" alt="#">
                        </div>
                    </div>
                    <div class="col-lg-5">
                        <div class="quickview-content">
                            <h3>{{$showProduct->productName}}</h3>
                            <h3 style="color: red;">{{number_format($showProduct->price)}} đ</h3>
                            <div class="quickview-peragraph">
                                <b>{{$showProduct->description}}</b>
                            </div>
                        </div>
                        <a href="{{ route('add.to.cart', $showProduct->id) }}" style="margin-top:15px"
                            class="btn btn-info"><i class="fa fa-shopping-cart"></i>Thêm vào giỏ
                            hàng</a>
                        <button class="btn btn-primary" onclick="window.history.go(-1); return false;">Hủy</button>
                    </div>
                </div>
            </div>
        </div>
        <hr>
        <form method="post" action="">
            @csrf
            <div class="form-group">
                <textarea class="form-control comment_name" type="text" placeholder="Đánh giá sản phẩm"
                    name="comment_name"></textarea>
            </div>
            <div class="form-group">
                <input style="background: rgb(252, 43, 15);" type="submit" class="btn btn-success sent_comment"
                    value="Gửi" />
            </div>
        </form>
        <hr>
        <div>
        @if (Session::has('success'))
        <div class="text text-success">
            <h4><b>{{session::get('success')}}</b></h4>
        </div>
         @endif
        </div>
        <div class="dropdown">
            <button class="btn btn-success dropdown-toggle" type="button" data-toggle="dropdown"><b>Bình
                    Luận:</b>
                <span class="caret"></span></button>
            <ul style="border: 5px solid #ccc; width:600px" class="dropdown-menu">
                <div class="container">
                        <div class="quickview-content">
                            <div class="row">
                                <div class="col-lg-6">
                                    @foreach($comments as $comment)
                                    @if($comment->product_id == $showProduct->id )
                                    <li><b class="text-center"> &emsp; {{$comment->user->userName}}:</b>{{$comment->comment_name}} </li>
                                    <hr>
                                    @endif
                                    @endforeach
                                </div>
                                <div class="col-lg-2"></div>
                            </div>
                    </div>
                </div>
            </ul>
        </div>
    </div>

</div>
@endsection
@section('scripts')
<script type="text/javascript">
    $('.product_id').hide();
    $('.sent_comment').click(function (e) {
        e.preventDefault();
        var ele = $(this);
        var product_id = $('.product_id').text();
        var comment_name = $('.comment_name').val();
        $.ajax({
            url: '{{ route('add_comment') }}',
            method: "post",
            data: {
                product_id: product_id,
                data: comment_name,
                _token: '{{ csrf_token() }}',
            },
            success: function (response) {
                window.location.reload();
            }
        });
    });
</script>
@endsection