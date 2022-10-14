<!doctype html>
<html lang="en">
  <head>
  	<title>Đăng nhập</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	
	<link rel="stylesheet" href="{{asset('login/css/style.css')}}">

	</head>
	<body style="background-image: url(https://i0.wp.com/idisqus.com/wp-content/uploads/2022/07/James-Webb-Telescope-iPhone-Wallpapers.jpg?fit=750%2C500&ssl=1);">
		<section class="ftco-section">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-md-6 text-center mb-5">
					<h2 class="heading-section">Đăng nhập</h2>
				</div>
			</div>
			<div class="row justify-content-center">
				<div class="col-md-8 col-lg-6">
					<div class="login-wrap py-5">
		      	<div class="img d-flex align-items-center justify-content-center" style="background-image: url({{asset('login/images/bg.jpg')}});"></div>
		      	<h3 class="text-center mb-0">Welcome</h3>
				<form action="{{route('post_login')}}" method="post" class="login-form">
					@csrf
					<div>
						@if (Session::has('success'))
						<div class="text text-success"><b>{{session::get('success')}}</b></div>
						@endif
						@if (Session::has('error_login'))
						<div class="text text-danger"><b>{{session::get('error_login')}}</b></div>
						@endif
					</div>
					<div class="form-group">
						<div class="icon d-flex align-items-center justify-content-center"><span class="fa fa-user"></span></div>
						<input type="email" name="email" class="form-control" placeholder="Nhập email">
						@if ($errors->any())
						<p style="color:red">{{ $errors->first('email') }}</p>
						@endif
					</div>

					<div class="form-group">
						<div class="icon d-flex align-items-center justify-content-center"><span class="fa fa-lock"></span></div>
						<input type="password" name="password" class="form-control" placeholder="Nhập mật khẩu">
						@if ($errors->any())
						<p style="color:red">{{ $errors->first('password') }}</p>
						@endif
					</div>
				
					<div class="form-group">
						<button type="submit" class="btn form-control btn-primary rounded submit px-3">Đăng nhập</button>
					</div>
	          </form>
	          <div class="w-100 text-center mt-4 text">
		          <a href="{{route('register')}}">Đăng ký</a>
	          </div>
	        </div>
				</div>
			</div>
		</div>
	</section>

	<script src="{{asset('login/js/jquery.min.js')}}"></script>
  <script src="{{asset('login/js/popper.js')}}"></script>
  <script src="{{asset('login/js/bootstrap.min.js')}}"></script>
  <script src="{{asset('login/js/main.js')}}"></script>

	</body>
</html>