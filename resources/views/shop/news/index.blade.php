@extends('templates.shop.master')
@section('content')
<link rel="stylesheet" type="text/css" href="{{$urlShop}}/plugins/OwlCarousel2-2.2.1/owl.carousel.css">
<link rel="stylesheet" type="text/css" href="{{$urlShop}}/plugins/OwlCarousel2-2.2.1/owl.theme.default.css">
<link rel="stylesheet" type="text/css" href="{{$urlShop}}/plugins/OwlCarousel2-2.2.1/animate.css">
<link rel="stylesheet" type="text/css" href="{{$urlShop}}/styles/blog_styles.css">
<link rel="stylesheet" type="text/css" href="{{$urlShop}}/styles/blog_responsive.css">

<!-- Home -->

<div class="home">
	<div class="home_background parallax-window" data-parallax="scroll" data-image-src="{{$urlShop}}/imagesshop_background.jpg"></div>
	<div class="home_overlay"></div>
	<div class="home_content d-flex flex-column align-items-center justify-content-center">
		<h2 class="home_title">Bài viết</h2>
	</div>
</div>

<!-- Blog -->

<div class="blog">
	<div class="container">
		<div class="row">
			<div class="col">
				<div class="blog_posts d-flex flex-row align-items-start justify-content-between">
				@foreach($objItems as $objItem)
				@php
					$id_new=$objItem->id_new;
					$namenew=$objItem->namenew;
					$picture=$objItem->picture;
					$text=editString($namenew);
					$url=route('shop.news.detail',['namenews'=>$text,'id'=>$id_new]);
				@endphp	
					<div class="blog_post">
						<div class="blog_image" style="background-image:url(/storage/app/files/{{$picture}})"></div>
						<div class="blog_text">{{$namenew}}</div>
						<div class="blog_button"><a href="{{$url}}">Xem bài viết</a></div>
					</div>
				@endforeach
				</div>
			</div>
				
		</div>
	</div>
</div>

<script src="https://code.jquery.com/jquery-3.3.1.min.js
"></script>
<script src="{{$urlShop}}/styles/bootstrap4/popper.js"></script>
<script src="{{$urlShop}}/styles/bootstrap4/bootstrap.min.js"></script>
<script src="{{$urlShop}}/plugins/greensock/TweenMax.min.js"></script>
<script src="{{$urlShop}}/plugins/greensock/TimelineMax.min.js"></script>
<script src="{{$urlShop}}/plugins/scrollmagic/ScrollMagic.min.js"></script>
<script src="{{$urlShop}}/plugins/greensock/animation.gsap.min.js"></script>
<script src="{{$urlShop}}/plugins/greensock/ScrollToPlugin.min.js"></script>
<script src="{{$urlShop}}/plugins/OwlCarousel2-2.2.1/owl.carousel.js"></script>
<script src="{{$urlShop}}/plugins/parallax-js-master/parallax.min.js"></script>
<script src="{{$urlShop}}/plugins/easing/easing.js"></script>
<script src="{{$urlShop}}/js/blog_custom.js"></script>
@endsection