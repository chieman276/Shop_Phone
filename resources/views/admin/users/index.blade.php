@extends('admin.layouts.master')

@section('content')


<body>
    <div class="container">

        <div class="col-lg-6">
            <h1 class="text-center mt-5">Danh sách người dùng</h1>
        </div>
        <div class="col-lg-12 mt-3">
            <a href="{{route('users.create')}}" class="btn btn-primary">Thêm</a>
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
                    <th>Tên</th>
                    <th>Email</th>
                    <th>Số điên thoại</th>
                    <th>Ngày sinh</th>
                    {{-- <th>Mật Khẩu</th> --}}
                    <th>Chức năng</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                <tr class="text-center">
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->userName }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->phone }}</td>
                    <td>{{ $user->birthday }}</td>
                    {{-- <td>{{ $user->password }}</td> --}}
                    <td>
                        {{-- <a href="{{ route('users.show',$user->id )}}" class="btn btn-primary">Xem</a> --}}
                        <a href="{{ route('users.edit',$user->id )}}" class="btn btn-warning">Sửa</a>
                        <form action="{{ route('users.destroy',$user->id )}}" style="display:inline" method="post">

                            <button class="btn btn-danger" onclick="return confirm('Xóa {{$user->name}} ?')">Xóa</button>
                            @csrf
                            @method('delete')
                        </form>
                    </td>
                </tr>
                @endforeach

            </tbody>
        </table>
        <div style="float:right">
            {{ $users->links() }}
        </div>
    </div>

</body>



@endsection