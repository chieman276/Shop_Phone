@extends('backend.layouts.master')

@section('content')

<div class="container">
    <h1 class="text-center mt-3">Thêm Người Dùng </h1>
    <form method="post" action="{{route('users.store')}}">
        @csrf
        <div class="container">
            <div class="row">
                <div class="col-lg-3"></div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label>Tên người dùng</label>
                        <input type="text" id="name" name="name" class="form-control">
                        <label id="name-error" class="error" for="name" style="display: none;color:red">Vui lòng nhập
                            tên người dùng
                        </label>
                        <label>Email</label>
                        <input type="text" id="email" name="email" class="form-control">
                        <label id="email-error" class="error" for="email" style="display: none;color:red">Vui lòng nhập
                        email
                        </label>
                        <label>Số điện thoại</label>
                        <input type="text" id="phone" name="phone" class="form-control">
                        <label id="phone-error" class="error" for="phone" style="display: none;color:red">Vui lòng nhập
                            số điện thoại
                        </label>
                        <label>Ngày sinh</label>
                        <input type="date" id="birthday" name="birthday" class="form-control">
                        <label id="birthday-error" class="error" for="birthday" style="display: none;color:red">Vui lòng nhập
                            ngày sinh
                        </label>
                        <label>Mật khẩu</label>
                        <input type="password" id="password" name="password" class="form-control">
                        <label id="password-error" class="error" for="password" style="display: none;color:red">Vui lòng nhập
                            mật khẩu
                        </label>
                        <label for="tf1">Nhóm nhân viên</label>
                        <select class="form-select form-control" name="user_group_id">

                            @foreach($userGroups as $userGroup)
                            <option value="{{ $userGroup->id }}">{{ $userGroup->name }} </option>
                            @endforeach
                        </select>
                    </div>
                    <button style="float: right" class="submit btn btn-primary">Thêm</button>
                    <a href="{{ route('categories.index')}}" class="btn btn-secondary">Trở về</a>
                </div>
                <div class="col-lg-3"></div>
            </div>
        </div>
</div>
</form>
</div>

<script>
    $(document).ready(function () {
        $('.submit').click(function () {
            var can_submit = true;
            var name = $('#name').val();
            if (name == '') {
                $('#name-error').show();
                can_submit = false;
            } else {
                $('#name-error').hide();

            }
            if (can_submit == false) {
                return false;
            }
        });
    });
</script>
@endsection