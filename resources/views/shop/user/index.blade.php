@extends('templates.shop.master')
@section('content')
<link rel="stylesheet" type="text/css" href="{{$urlShop}}/plugins/OwlCarousel2-2.2.1/owl.carousel.css">
<link rel="stylesheet" type="text/css" href="{{$urlShop}}/plugins/OwlCarousel2-2.2.1/owl.theme.default.css">
<link rel="stylesheet" type="text/css" href="{{$urlShop}}/plugins/OwlCarousel2-2.2.1/animate.css">
<link rel="stylesheet" type="text/css" href="{{$urlShop}}/plugins/jquery-ui-1.12.1.custom/jquery-ui.css">
<link rel="stylesheet" type="text/css" href="{{$urlShop}}/styles/shop_styles.css">
<link rel="stylesheet" type="text/css" href="{{$urlShop}}/styles/shop_responsive.css">
<!-- Home -->
<div class="home">
	<div class="home_background parallax-window" data-parallax="scroll" data-image-<img src="{{$urlShop}}/images/shop_background.jpg"></div>
	<div class="home_overlay"></div>
	<div class="home_content d-flex flex-column align-items-center justify-content-center">
		<h2 class="home_title">Trang quản lý user</h2>
	</div>
</div>

<!-- Shop -->

<div class="shop">
	<div class="container">
		<div class="row">
			<div class="col-lg-3">
				<!-- Shop Sidebar -->
				<style type="text/css">
					.left_bar{
						padding-left: 20px;
					}
					._active{
						color: red;
					}
				</style>
				<div class="shop_sidebar">
					<div class="sidebar_section">
						<div class="sidebar_title">Danh mục</div>
						<ul class="left_bar">
							<li>
								<a href="{{route('shop.user.index')}}">
									Thông tin
								</a>
							</li>
							<li>
								<a href="{{route('shop.user.donhang')}}">
									Các đơn hàng đã đặt
								</a>
							</li>
							<li>
								<a href="{{route('shop.user.doimk')}}">
									đổi mật khẩu
								</a>
							</li>
						</ul>	
					</div>
				</div>				
			</div>

			<div class="col-lg-9">
				
				<!-- Shop Content -->

				<div class="shop_content">
					<div class="shop_bar clearfix">
						<h2>Chào bạn: "{{Auth::user()->fullname}}" </h2>
					</div>
					<div>
						<h3>Chúc bạn một ngày online vui vẻ....</h3>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- Recently Viewed -->

<script src="{{$urlShop}}/js/jquery-3.3.1.min.js"></script>
<script src="{{$urlShop}}/styles/bootstrap4/popper.js"></script>
<script src="{{$urlShop}}/styles/bootstrap4/bootstrap.min.js"></script>
<script src="{{$urlShop}}/plugins/greensock/TweenMax.min.js"></script>
<script src="{{$urlShop}}/plugins/greensock/TimelineMax.min.js"></script>
<script src="{{$urlShop}}/plugins/scrollmagic/ScrollMagic.min.js"></script>
<script src="{{$urlShop}}/plugins/greensock/animation.gsap.min.js"></script>
<script src="{{$urlShop}}/plugins/greensock/ScrollToPlugin.min.js"></script>
<script src="{{$urlShop}}/plugins/OwlCarousel2-2.2.1/owl.carousel.js"></script>
<script src="{{$urlShop}}/plugins/easing/easing.js"></script>
<script src="{{$urlShop}}/plugins/Isotope/isotope.pkgd.min.js"></script>
<script src="{{$urlShop}}/plugins/jquery-ui-1.12.1.custom/jquery-ui.js"></script>
<script src="{{$urlShop}}/plugins/parallax-js-master/parallax.min.js"></script>
<script src="{{$urlShop}}/js/shop_custom.js"></script>
@endsection