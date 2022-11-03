@extends('admin.layouts.master')

@section('content')

<div class="container">
    <h1 class="text-center mt-3">Sửa Người Dùng </h1>
    <form method="post" action="{{route('users.update',$user->id)}}">
        @csrf
        @method('PUT')
        <div class="container">
            <div class="row">
                <div class="col-lg-3"></div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label>Tên người dùng</label>
                        <input type="text" id="name" name="userName" value="{{ $user->userName}}" class="form-control">
                        <label id="name-error" class="error" for="name" style="display: none;color:red">Vui lòng nhập
                            tên người dùng
                        </label>
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="text" id="email" name="email" value="{{ $user->email}}" class="form-control">
                        <label id="email-error" class="error" for="email" style="display: none;color:red">Vui lòng nhập
                        email
                        </label>
                    </div>
                    <div class="form-group">
                        <label>Số điện thoại</label>
                        <input type="text" id="phone" name="phone" value="{{ $user->phone}}" class="form-control">
                        <label id="phone-error" class="error" for="phone" style="display: none;color:red">Vui lòng nhập
                            số điện thoại
                        </label>
                    </div>
                    <div class="form-group">
                        <label>Ngày sinh</label>
                        <input type="date" id="birthday" name="birthday" value="{{ $user->birthday}}" class="form-control">
                        <label id="birthday-error" class="error" for="birthday" style="display: none;color:red">Vui lòng nhập
                            ngày sinh
                        </label>
                    </div>
                    <div class="form-group">
                        <label>Mật khẩu</label>
                        <input type="password" id="password" name="password" value="{{ $user->password}}" class="form-control">
                        <label id="password-error" class="error" for="password"  style="display: none;color:red">Vui lòng nhập
                            mật khẩu
                        </label>
                    </div>
                    <button style="float: right" class="submit btn btn-primary">sửa</button>
                    <a href="{{ route('users.index')}}" class="btn btn-secondary">Trở về</a>
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

            var email = $('#email').val();
            if (email == '') {
                $('#email-error').show();
                can_submit = false;
            } else {
                $('#email-error').hide();
            }

            var name = $('#phone').val();
            if (name == '') {
                $('#phone-error').show();
                can_submit = false;
            } else {
                $('#phone-error').hide();
            }

            var name = $('#birthday').val();
            if (name == '') {
                $('#birthday-error').show();
                can_submit = false;
            } else {
                $('#birthday-error').hide();
            }

            var name = $('#password').val();
            if (name == '') {
                $('#password-error').show();
                can_submit = false;
            } else {
                $('#password-error').hide();
            }

            if (can_submit == false) {
                return false;
            }
        });
    });
</script>
@endsection