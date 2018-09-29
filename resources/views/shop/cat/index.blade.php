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
		<h2 class="home_title">{{$name_cat}}</h2>
	</div>
</div>

<!-- Shop -->

<div class="shop">
	<div class="container">
		<div class="row">
			<div class="col-lg-3">
				<!-- Shop Sidebar -->
				@include('templates.shop.left_bar')
			</div>

			<div class="col-lg-9">
				
				<!-- Shop Content -->

				<div class="shop_content">
					<div class="shop_bar clearfix">
						<div class="shop_product_count"><span></span>Các sản phẩm mới</div>

					</div>

					<div class="product_grid">
						<div class="product_grid_border"></div>
						@foreach($objItems as $objItem)
						@php
							$id_sp=$objItem->id_sp;
							$namesp=$objItem->namesp;
							$giaban=ceil($objItem->gia*(100-$objItem->giamgia)/100);
							$giamgia=$objItem->giamgia;
							$picture=$objItem->picture;
							$text=editString($namesp);
							$url=route('shop.sanpham.index',['namesanpham'=>$text,'id'=>$id_sp]);
						@endphp
						<!-- Product Item  is_new discount -->
						<div class="product_item @if($giamgia==0)  @else discount @endif">
							<div class="product_border"></div>
							<div class="product_image d-flex flex-column align-items-center justify-content-center"><a href="{{$url}}" tabindex="0"><img src="/storage/app/files/{{$picture}}" alt=""></a></div>
							<div class="product_content">
								<div class="product_price">{{$giaban}}$</div>
								<div class="product_name"><div><a href="{{$url}}" tabindex="0">{{$namesp}}</a></div></div>
							</div>
							<div class="product_fav">
								<i class="fas fa-heart"></i>
								<button onclick="mua('{{$id_sp}}')" class="btn btn-danger" style="position:  absolute;left: -118px;top: 99px; width: 165px;">mua</button>
							</div>
							<ul class="product_marks">
								<li class="product_mark product_discount">{{$giamgia}}%</li>
								<li class="product_mark product_new">new</li>
							</ul>
						</div>
						@endforeach
					</div>

					<!-- Shop Page Navigation -->

					<div class="shop_page_nav d-flex flex-row">
						{{$objItems->links()}}
					</div>

				</div>

			</div>
		</div>
	</div>
</div>

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