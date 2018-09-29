@extends('templates.shop.master')
@section('content')
<link rel="stylesheet" type="text/css" href="{{$urlShop}}/plugins/OwlCarousel2-2.2.1/owl.carousel.css">
<link rel="stylesheet" type="text/css" href="{{$urlShop}}/plugins/OwlCarousel2-2.2.1/owl.theme.default.css">
<link rel="stylesheet" type="text/css" href="{{$urlShop}}/plugins/OwlCarousel2-2.2.1/animate.css">
<link rel="stylesheet" type="text/css" href="{{$urlShop}}/plugins/slick-1.8.0/slick.css">
<link rel="stylesheet" type="text/css" href="{{$urlShop}}/styles/main_styles.css">
<link rel="stylesheet" type="text/css" href="{{$urlShop}}/styles/responsive.css">

@php
	$id_sp=$slide->id_sp;
	$name=$slide->namesp;
	$gia=$slide->gia;
	$giamgia=$slide->giamgia;
	if($giamgia==0){
		$giaban=$gia;
	}else{
		$giaban=ceil($gia*(100-$giamgia)/100);
	}
	$picture=$slide->picture;
	$text=editString($name);
	$url=route('shop.sanpham.index',['namesp'=>$text,'id'=>$id_sp]);
@endphp
<div class="banner">
	<div class="banner_background" style="background-image:url({{$urlShop}}/images/banner_background.jpg)"></div>
	<div class="container fill_height">
		<div class="row fill_height">
			<div class="banner_product_image"><img src="/storage/app/files/{{$picture}}" alt=""></div>
			<div class="col-lg-5 offset-lg-4 fill_height">
				<div class="banner_content">
					<h1 class="banner_text">Sản phẩm Hot</h1>
					<div class="banner_price"><span>${{$gia}}</span>${{$giaban}}</div>
					<div class="banner_product_name">{{$name}}</div>
					<div class="button banner_button"><a href="{{$url}}">Xem sản phẩm</a></div>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- Deals of the week -->

<div class="deals_featured">
	<div class="container">
		<div class="row">
			<div class="col d-flex flex-lg-row flex-column align-items-center justify-content-start">
				
				<!-- Deals -->

				<div class="deals">
					<div class="deals_title">Đang giảm giá</div>
					<div class="deals_slider_container">
						
						<!-- Deals Slider -->
						<div class="owl-carousel owl-theme deals_slider">
						@foreach($random_giamgia as $key =>$val)	
							<!-- Deals Item -->
							@php
								$id_sp=$val['id_sp'];
								$namesp=$val['namesp'];
								$giaban=$val['gia'];
								$giamgia=$giaban*(100-$val['giamgia'])/100;
								$picture=$val['picture'];
							@endphp
							<div class="owl-item deals_item">
								<div class="deals_image"><img width="310px" height="310px" src="/storage/app/files/{{$picture}}" alt=""></div>
								<div class="deals_content">
									<div class="deals_info_line d-flex flex-row justify-content-start">
										<div class="deals_item_category"><a href="#">{{$namesp}}</a></div>
										<div class="deals_item_price_a ml-auto"><strike>${{$giaban}}</strike></div>
									</div>
									<div class="deals_info_line d-flex flex-row justify-content-start">
										<div class="deals_item_name">Giá hấp dẫn</div>
										<div class="deals_item_price ml-auto">${{$giamgia}}</div>
									</div>
								</div>
							</div>
						@endforeach
						</div>
					</div>

					<div class="deals_slider_nav_container">
						<div class="deals_slider_prev deals_slider_nav"><i class="fas fa-chevron-left ml-auto"></i></div>
						<div class="deals_slider_next deals_slider_nav"><i class="fas fa-chevron-right ml-auto"></i></div>
					</div>
				</div>
				
				<!-- Featured -->
				<div class="featured">
					<div class="tabbed_container">
						<div class="tabs">
							<ul class="clearfix">
								<li class="active">Sản phẩm đang giảm giá</li>
								<li>Sản phẩm mua nhiều</li>
							</ul>
							<div class="tabs_line"><span></span></div>
						</div>

						<!-- Product Panel -->
						<div class="product_panel panel active">
							<div class="featured_slider slider">
							@foreach($objItems_giamgia as $key =>$val)	
							<!-- Deals Item -->
							@php
								$id_sp=$val['id_sp'];
								$namesp=$val['namesp'];
								$giaban=$val['gia'];
								$giam=$val['giamgia'];
								$giamgia=$giaban*(100-$giam)/100;
								$picture=$val['picture'];
								$text=editString($namesp);
								$url=route('shop.sanpham.index',['namesanpham'=>$text,'id'=>$id_sp]);
							@endphp
								<div class="featured_slider_item">
									<div class="border_active"></div>
									<div class="product_item discount d-flex flex-column align-items-center justify-content-center text-center">
										<div class="product_image d-flex flex-column align-items-center justify-content-center"><a href="{{$url}}" title="Xem chi tiết"><img width="115px" height="115px" src="/storage/app/files/{{$picture}}" alt=""></a></div>
										<div class="product_content">
											<div class="product_price discount">
												@if($giamgia != $giaban)
													${{$giamgia}}
												@endif
												<span><strike>${{$giaban}}</strike></span>
											</div>
											<div class="product_name"><div><a href="{{$url}}">{{$namesp}}</a></div></div>
										</div>
										<div class="product_extras">
											<button onclick="mua('{{$id_sp}}')" class="product_cart_button">Mua</button>
										</div>
										<div class="product_fav"><i class="fas fa-heart"></i></div>
										<ul class="product_marks">
											@if($giam > 0)<li class="product_mark product_discount">-{{$giam}}%</li>@endif
											<li class="product_mark product_new">new</li>
										</ul>
									</div>
								</div>
							@endforeach
							</div>
							<div class="featured_slider_dots_cover"></div>
						</div>

						<!-- Product Panel -->

						<div class="product_panel panel">
							<div class="featured_slider slider">
							@foreach($objItems_muanhieu as $key =>$val)	
							<!-- Deals Item -->
							@php
								$id_sp=$val['id_sp'];
								$namesp=$val['namesp'];
								$giaban=$val['gia'];
								$giam=$val['giamgia'];
								$giamgia=$giaban*(100-$giam)/100;
								$picture=$val['picture'];
								$text=editString($namesp);
								$url=route('shop.sanpham.index',['namesanpham'=>$text,'id'=>$id_sp]);
							@endphp
								<div class="featured_slider_item">
									<div class="border_active"></div>
									<div class="product_item discount d-flex flex-column align-items-center justify-content-center text-center">
										<div class="product_image d-flex flex-column align-items-center justify-content-center"><a href="{{$url}}" title="Xem chi tiết"><img width="115px" height="115px" src="/storage/app/files/{{$picture}}" width="115px" height="115px" alt=""></a></div>
										<div class="product_content">
											<div class="product_price discount">
												${{$giamgia}}
												<span><strike>
												@if($giamgia != $giaban)
													${{$giaban}}
												@endif
												</strike></span>
											</div>
											<div class="product_name"><div><a href="{{$url}}">{{$namesp}}</a></div></div>
											<div class="product_extras">
												<button onclick="mua('{{$id_sp}}')" class="product_cart_button">Mua</button>
											</div>
										</div>
										<div class="product_fav"><i class="fas fa-heart"></i></div>
										<ul class="product_marks">
											@if($giam > 0)<li class="product_mark product_discount">-{{$giam}}%</li>@endif
											<li class="product_mark product_new">new</li>
										</ul>
									</div>
								</div>
							@endforeach
							</div>
							<div class="featured_slider_dots_cover"></div>
						</div>

						<!-- Product Panel -->

					</div>
				</div>

			</div>
		</div>
	</div>
</div>

@foreach($objItems as $key => $objItem)
@php
	$id_cat=$key;
	$namecat=$objItem['namecat'];
	$objSanpham=$objItem['sanpham'];
@endphp
<div class="new_arrivals">
	<div class="container">
		<div class="row">
			<div class="col">
				<div class="tabbed_container">
					<div class="tabs clearfix tabs-right">
						<div class="new_arrivals_title">{{$namecat}}</div>
						<ul class="clearfix">
							<li class="active">Các sản phẩm mới</li>
						</ul>
						<div class="tabs_line"><span></span></div>
					</div>
					<div class="row">
						<div class="col-lg-9" style="z-index:1;">

							<!-- Product Panel -->
							<div class="product_panel panel active">
								<div class="arrivals_slider slider">
									@foreach($objSanpham as $key =>$val)	
									<!-- Deals Item -->
									@php
										$id_sp=$val->id_sp;
										$namesp=$val->namesp;
										$giaban=$val->gia;
										$giam=$val->giamgia;
										$giamgia=$giaban*(100-$giam)/100;
										$picture=$val->picture;
										$text=editString($namesp);
										$url=route('shop.sanpham.index',['namesanpham'=>$text,'id'=>$id_sp]);
									@endphp
										<div class="featured_slider_item">
											<div class="border_active"></div>
											<div class="product_item discount d-flex flex-column align-items-center justify-content-center text-center">
												<div class="product_image d-flex flex-column align-items-center justify-content-center"><a href="{{$url}}" title="Xem chi tiết"><img width="115px" height="115px" src="/storage/app/files/{{$picture}}" alt=""></a></div>
												<div class="product_content">
													<div class="product_price discount">
														${{$giamgia}}
														<span><strike>
														@if($giamgia != $giaban)
															${{$giaban}}
														@endif
														</strike></span>
													</div>
													<div class="product_name"><div><a href="{{$url}}">{{$namesp}}</a></div></div>
													<div class="product_extras">
														<button onclick="mua('{{$id_sp}}')" class="product_cart_button">Mua</button>
													</div>
												</div>
												<div class="product_fav"><i class="fas fa-heart"></i></div>
												<ul class="product_marks">
													@if($giam > 0)<li class="product_mark product_discount">-{{$giam}}%</li>@endif
													<li class="product_mark product_new">new</li>
												</ul>
											</div>
										</div>
									@endforeach
								</div>
								<div class="arrivals_slider_dots_cover"></div>
							</div>
						</div>

						<div style="margin-top: 70px;" class="col-lg-3">
							<div class="arrivals_single clearfix">
								<div class="d-flex flex-column align-items-center justify-content-center">
									<div class="arrivals_single_image"><img src="/storage/app/files/{{$picture}}" alt=""></div>
									<div class="arrivals_single_content">
										<div class="arrivals_single_name_container clearfix">
											<div class="arrivals_single_name"><a href="#">{{$namesp}}</a></div>
											<div class="arrivals_single_price text-right">${{$giamgia}}</div>
										</div>
										<form action="javascript:void(0)"><button onclick="mua('{{$id_sp}}')" class="arrivals_single_button">Mua</button></form>
									</div>
									<div class="arrivals_single_fav product_fav active"><i class="fas fa-heart"></i></div>
									<ul class="arrivals_single_marks product_marks">
										<li class="arrivals_single_mark product_mark product_new">new</li>
									</ul>
								</div>
							</div>
						</div>
					</div>					
				</div>
			</div>
		</div>
	</div>		
</div>
@endforeach
<script src="{{$urlShop}}/js/jquery-3.3.1.min.js"></script>
<script src="{{$urlShop}}/styles/bootstrap4/popper.js"></script>
<script src="{{$urlShop}}/styles/bootstrap4/bootstrap.min.js"></script>
<script src="{{$urlShop}}/plugins/greensock/TweenMax.min.js"></script>
<script src="{{$urlShop}}/plugins/greensock/TimelineMax.min.js"></script>
<script src="{{$urlShop}}/plugins/scrollmagic/ScrollMagic.min.js"></script>
<script src="{{$urlShop}}/plugins/greensock/animation.gsap.min.js"></script>
<script src="{{$urlShop}}/plugins/greensock/ScrollToPlugin.min.js"></script>
<script src="{{$urlShop}}/plugins/OwlCarousel2-2.2.1/owl.carousel.js"></script>
<script src="{{$urlShop}}/plugins/slick-1.8.0/slick.js"></script>
<script src="{{$urlShop}}/plugins/easing/easing.js"></script>
<script src="{{$urlShop}}/js/custom.js"></script>
@endsection