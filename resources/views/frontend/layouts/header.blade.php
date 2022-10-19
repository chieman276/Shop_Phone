<div class="header-middle">
	<!--header-middle-->
	<div class="container">
		<div class="row">
			<div class="col-lg-2">
				<div class="logo pull-left">
					<a href="{{ route('websiteProduct') }}"><img src="{{ asset('images/home/logo.png')}}" alt="" /></a>
				</div>
			</div>
			<div class="col-lg-2">
				{{-- <div class="btn-group">
					<a href="{{ route('websiteProduct') }}">
						<h3><span class="fas fa-address-book"></span> Sản Phẩm
					</a></h3>
				</div> --}}
			</div>
			<div class="col-lg-3">
				<div class="btn-group">
					{{-- <a href="{{ route('website.product')}}">
						<h3><span class="far fa-address-book"></span> Loại Sản Phẩm
					</a></h3> --}}
					<div class="dropdown" style="z-index: 10000;">
						<button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Thông tin
							cá nhân
							<span class="caret"></span></button>
						<ul class="dropdown-menu">
							<li><a href="">Họ tên: {{$userAll->userName}}</a></li>
							<li><a href="">Email: {{$userAll->email}}</a></li>
							<li><a href="">SĐT: {{$userAll->phone}}</a></li>
							<li><a href="{{route('login')}}">Đăng xuất</a></li>
						</ul>
					</div>
				</div>
			</div>
			<div class="col-lg-3">
				<div class="shop-menu pull-right">
					<ul class="nav navbar-nav">
						<li>
							<div class="dropdown">
								<button type="button" class="btn btn-info" data-toggle="dropdown">
									<i class="fa fa-shopping-cart" aria-hidden="true"></i> Giỏ hàng <span
										class="badge badge-pill badge-danger">{{ count((array) session('cart'))
										}}</span>
								</button>
								<div class="dropdown-menu"  style="min-width:350px; z-index: 10000">
									<div class="row ">
										<div class="col-lg-4">
											<a href="{{ route('cart') }}">
											<i class="fa fa-shopping-cart" aria-hidden="true"></i> <span
												class="badge badge-pill badge-danger">{{ count((array) session('cart'))
												}}</span>
											</a>
										</div>
										@php $total = 0 @endphp
										@foreach((array) session('cart') as $id => $details)
										@php $total += $details['price'] * $details['quantity'] @endphp
										@endforeach
										<div class="col-lg-8 total-section text-right">
											<p>Tổng Tiền: <span class="text-info" style="color: red"> {{
													number_format($total) }} đ</span></p>
										</div>
									</div>
									@if(session('cart'))
									@foreach(session('cart') as $id => $details)
									<div class="row cart-detail">
										<div class="col-lg-4 col-sm-4 col-4 cart-detail-img">
											<img src="{{asset( $details['image'] )}}" style="width:120px" />
										</div>
										<div class="col-lg-8 col-sm-8 col-8 cart-detail-product">
											<p>{{ $details['productName'] }}</p>
											<span class="count"> Số Lượng:{{ $details['quantity'] }}</span><br>
											<span class="price text-danger"> Giá:{{number_format( $details['price']) }}
												đ</span>
										</div>
									</div>
									@endforeach
									@endif
									<div class="row">
										<div class="col-lg-12 col-sm-12 col-12 text-center checkout">
											<a href="{{ route('cart') }}" class="btn btn-primary btn-block show_all_in_cart">Xem tất cả</a>
										</div>
									</div>
								</div>
							</div>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>
<!--/header-middle-->
<div>
	<div class="hide_content">
		@yield('content')
	</div>
</div>
@yield('scripts')