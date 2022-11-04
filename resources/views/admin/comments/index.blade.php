@extends('admin.layouts.master')

@section('content')


<body>
    <div class="container">

        <div class="col-lg-6">
            <h1 class="text-center mt-5">Danh sách đánh giá từ khách hàng</h1>
        </div>
        {{-- <div class="col-lg-12 mt-3">
            <a href="{{route('discounts.create')}}" class="btn btn-primary">Thêm</a>
        </div> --}}
        <br>

        @if (Session::has('success'))
        <div class="alert alert-success">{{session::get('success')}}</div>
        @endif
        @if (Session::has('error'))
        <div class="text text-danger">{{session::get('error')}}</div>
        @endif
        <br>
        <div class="container">
            <table class="table table-bordered mt-3">
                <thead>
                    <tr class="text-center">
                        <th>#</th>
                        <th>Sản phẩm</th>
                        <th>Tên khách hàng</th>
                        <th style="width:500px">Đánh giá của khách hàng </th>
                        <th>Chức năng</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($comments as $key => $comment)
                    <tr class="text-center">
                        <td>{{ ++$key }}</td>
                        <td>{{ $comment->product->productName }} <div> <img src="{{$comment->product->image}}" style="width: 120px" alt=""> </div> </td>
                        <td>{{ $comment->user->userName}}</td>
                        <td>{{ $comment->comment_name}}</td>
                        <td>
                            <form action="{{ route('comments.destroy',$comment->id )}}" style="display:inline"
                                method="post">
                                @csrf
                                @method('delete')
                                <button class="btn btn-danger"
                                    onclick="return confirm('Bạn muốn xóa đánh giá này?')">Xóa</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
        {{-- <div style="float:right">
        {{$discounts->links()}}
        </div> --}}
    </div>

</body>



@endsection