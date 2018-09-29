@extends('templates.shop.master')
@section('content')
<link rel="stylesheet" type="text/css" href="{{$urlShop}}/plugins/OwlCarousel2-2.2.1/owl.carousel.css">
<link rel="stylesheet" type="text/css" href="{{$urlShop}}/plugins/OwlCarousel2-2.2.1/owl.theme.default.css">
<link rel="stylesheet" type="text/css" href="{{$urlShop}}/plugins/OwlCarousel2-2.2.1/animate.css">
<link rel="stylesheet" type="text/css" href="{{$urlShop}}/styles/product_styles.css">
<link rel="stylesheet" type="text/css" href="{{$urlShop}}/styles/product_responsive.css">
<link rel="stylesheet" type="text/css" href="{{$urlShop}}/styles.css">
<link href="https://netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
<script src="https://netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
<meta name="csrf-token" content="{{ csrf_token() }}">
@php
	$auth=Auth::user();
@endphp
<script type="text/javascript">
	function comment(id_sp,id_cm){
		@if(isset($auth->username))
			check=1;
		@else
			check=0;
		@endif
		$.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        content=document.getElementById("content"+id_cm).value;
        if(check != '0' && content!=''){
	        $.ajax({
	            url: '{{route('shop.sanpham.comment')}}',
	            type: 'post',
	            cache: false,
	            data:{
	            	id_sp:id_sp,
	            	id_cm:id_cm,
	            	content:content,
	            },
	            success: function(data){
	                $('#khung').html(data);
	            },
	            error: function (){
	                alert('Có lỗi xảy ra');
	            }
	        });
	    }else{
	    	if(check=='0'){
	    		swal("Vui lòng đăng nhập !", "", "error");
	    	}else{
	    		swal("Vui lòng không để rỗng !", "", "error");
	    	}
	    }
	}
	$('#click').click(function(){
	  	$('#ajax_loader').css( 'display', 'block' );
	  		setTimeout(function(){
	      	$('#ajax_loader').css( 'display', 'none' );
	  	}, 20000);
	});
</script>
<style type="text/css">
	.ajax-load-qa {
	background: url("https://2.bp.blogspot.com/-K6t6oBc4jd0/WC1H9h6QBWI/AAAAAAAAAMU/A0C5q9w-mwkVQf_HlezvaJ0lftPP1u9jwCLcB/s1600/loading%2B%25283%2529.gif") no-repeat center center rgba(255,255,255,0.5);
	position: fixed;
	z-index: 100;
	left: 0;
	top: 0;
	width: 100%;
	height: 100%;
	display: none;
}
</style>
<div id="ajax_loader" class="ajax-load-qa"> </div>

<div class="single_product">
	<div class="container">
		<div class="row">
			<!-- Images -->
			<div class="col-lg-2 order-lg-1 order-2">
				<ul class="image_list">
				@foreach($objItem_anh as $objItem)
				@php
					$picture=$objItem->namep;
				@endphp
					<li data-image="/storage/app/files/{{$picture}}"><img src="/storage/app/files/{{$picture}}" alt=""></li>
				@endforeach
				</ul>
			</div>

			<!-- Selected Image -->
			<div class="col-lg-5 order-lg-2 order-1">
				<div class="image_selected"><img  src="/storage/app/files/{{$objItem_sp->picture}}" alt=""></div>
			</div>

			<!-- Description -->
			@php
				$id_sp=$objItem_sp->id_sp;
				$namesp=$objItem_sp->namesp;
				$gioithieu=$objItem_sp->preview_text;
				$gia=$objItem_sp->gia;
				$detail=$objItem_sp->detail_text;
			@endphp
			<div class="col-lg-5 order-3">
				<div class="product_description">
					<div class="product_name">{{$namesp}}</div>
					<div class="product_text">
						<p>{{$gioithieu}}</p>
					</div>
					<div class="order_info d-flex flex-row">
						<form action="#">
							
							<div class="product_price">{{$gia}}$</div>
							<div class="button_container">
								<button onclick="mua('{{$id_sp}}')" type="button" class="button cart_button">Mua</button>
								<div class="product_fav"><i class="fas fa-heart"></i></div>
							</div>
							
						</form>
					</div>
				</div>
			</div>
		</div>
		<div>
			{!!$detail!!}
		</div>
		<hr>
		<style type="text/css">
			.khung{

			}
			.cm_cha{
				/* width: 100%; */
				/* background: white; */
				/* border-radius: 40px 10px 10px 40px; */
			}
			.avata{
				width: 85px;
			    position: relative;
			    float: left;
			}
			.avata img{
				width: 80px;
				height: 80px;
				border-radius: 50%;
			}
			.noidung{
				height: 80px;
			}
			.item{
				padding-left: 102px;
				padding-top: 12px;
			}
			.item p{
				background: #eff6fa;
				padding: 10px 10px 10px 24px;
				border-radius: 24px;
			}
			.username{
				color: #0797e9;
			    font-style: italic;
			    margin-right: 10px;
			}
			.nut{
				margin-left: 34px;
			}
			.nut a{
				margin-left: 10px;
			}

			.cm_con{
				width: 100%;
			    background: white;
			    border-radius: 40px 10px 10px 40px;
			    margin-left: 15px;
			    margin-bottom: 15px;
			}
			._avata{
				width: 85px;
			    position: relative;
			    float: left;
			}
			._avata img{
				width: 80px;
				height: 80px;
				border-radius: 50%;
			}
			._noidung{
				height: 80px;
    			padding-top: 12px;
			}

			.clr{
				clear: both;
			}
			.ul_con{margin-top: 16px;margin-left: 12px;}
			.ul_con li{
				margin-top: -10px;
			}
			.traloi{
				width: 100%;
			}
			.input{
				width: 89%;
			    height: 35px;
			    margin-left: 103px;
			    border-radius: 25px;
			    padding-left: 18px;
			    outline: none;
			    margin-top: 10px;
			    background: #eff6fa;
			}
			.ok{
				position: absolute;
			    top: -16px;
			    left: 173px;
			    background: #0e8ce4;
			    padding: 2px 17px 2px 17px;
			    border-radius: 24px;
			    color: white;
			    width: 110px;
			    text-align: center;
			}
		</style>
		<script type="text/javascript">
			function view(active,id){
				if(active==1){
					active=0;
					document.getElementById("ul_con"+id).style.display = "none";
					document.getElementById("xem"+id).innerHTML = '<a onclick="view('+0+','+id+')" href="javascript:void(0)">Bình luận con</a>';
				}else{
					active=1;
					document.getElementById("ul_con"+id).style.display = "block";
					document.getElementById("xem"+id).innerHTML = '<a onclick="view('+1+','+id+')" href="javascript:void(0)">Bình luận con</a>';
				}
				
			}
			function traloi(active,id){
				if(active==1){
					active=0;
					document.getElementById("form_traloi"+id).style.display = "none";
					document.getElementById("traloi"+id).innerHTML = '<a onclick="traloi('+0+','+id+')" href="javascript:void(0)">Trả lời</a>';
				}else{
					active=1;
					document.getElementById("form_traloi"+id).style.display = "block";
					document.getElementById("traloi"+id).innerHTML = '<a onclick="traloi('+1+','+id+')" href="javascript:void(0)">Trả lời</a>';
				}
				
			}
		</script>
		<div id="khung" class="khung">
			<div id="form_traloi0" class="traloi">
				<input id="id_sp0" style="display: none;" type="text" value="{{$id_sp}}">
				<input id="id_cm0" style="display: none;" type="text" value="0">
				<input id="content0" class="input" type="" name="">
				<a onclick="comment({{$id_sp}},0)" title="OK" style="margin-left: -177px;padding: 5px 0px;" href="javascript:void(0)" class="ok">Bình luận</a> 
			</div>
			<ul>
			@foreach($objCm_cha as $objItem)
			@php
				$id_cm=$objItem->id_cm;
				$username=$objItem->username;
				$content=$objItem->content;
			@endphp	
				<li style="margin-bottom: 5px; ">
					<div class="cm_cha">
						<div class="avata">
							<img src="https://dangchuc.pro.vn/wp-content/uploads/2017/03/anh-dep-hot-girl-Na-Na-chiec-vay-trang-4.jpg" >
						</div>
						<div class="noidung">
							<div class="item">
								<p><span class="username">{{$username}}</span> {{$content}}</p>
							</div>
							<span class="nut">
								<span id="traloi{{$id_cm}}">
									<a onclick="traloi(0,{{$id_cm}})" href="javascript:void(0)">Trả lời</a>
								</span>
								<span id="xem{{$id_cm}}">
									<a onclick="view(0,{{$id_cm}})" href="javascript:void(0)">Binh luận con</a>
								</span>
							</span>
						</div>
						<div class="clr"></div>
					</div>
					<div id="form_traloi{{$id_cm}}" class="traloi" style="display: none;">
						<input id="id_sp{{$id_cm}}" style="display: none;" type="text" value="{{$id_sp}}">
						<input id="id_cm{{$id_cm}}" style="display: none;" type="text" value="{{$id_cm}}">
						<input id="content{{$id_cm}}" class="input" type="" name="">
						<a onclick="comment({{$id_sp}},{{$id_cm}})" href="javascript:void(0)" class="ok">ok</a> 
					</div>
					<ul class="ul_con" id="ul_con{{$id_cm}}" style="display: none;">
					@foreach($objCm_con as $Item)
					@if($Item->parent_id==$id_cm)
					@php
						$username=$Item->username;
						$content=$Item->content;
					@endphp
						<li>
							<div class="cm_con">
								<div class="_avata">
									<img src="https://dangchuc.pro.vn/wp-content/uploads/2017/03/anh-dep-hot-girl-Na-Na-chiec-vay-trang-4.jpg" >
								</div >
								<div class="_noidung">
									<div class="item">
										<p><span class="username">{{$username}}</span> {{$content}}</p>
									</div>
								</div>
							</div>
						</li>
					@endif
					@endforeach
					</ul>
				</li>
			@endforeach
			</ul>
		</div>
	</div>
</div>

<!-- Recently Viewed -->
<div class="viewed">
	<div class="container">
		<div class="row">
			<div class="col">
				<div class="viewed_title_container">
					<h3 class="viewed_title">Các Sản phẩm đề xuất</h3>
					<div class="viewed_nav_container">
						<div class="viewed_nav viewed_prev"><i class="fas fa-chevron-left"></i></div>
						<div class="viewed_nav viewed_next"><i class="fas fa-chevron-right"></i></div>
					</div>
				</div>

				<div class="viewed_slider_container">
					
					<!-- Recently Viewed Slider -->

					<div class="owl-carousel owl-theme viewed_slider">
					@foreach($objItems as $objItem)
					@php
						$id_sp=$objItem->id_sp;
						$namesp=#objItem->namesp;
						$gia=$objItem->gia;
						$giamgia=$objItem->giamgia;
						$picture=$objItem->picture;
						$text=editString($namesp);
						$url=route('shop.sanpham.index',['namesp'=>$text,'id'=>$id_sp]);
					@endphp
						<div class="owl-item">
							<div class="viewed_item discount d-flex flex-column align-items-center justify-content-center text-center">
								<div class="viewed_image"><img src="/storage/app/files/{{$picture}}" alt=""></div>
								<div class="viewed_content text-center">
									<div class="viewed_price">${{$gia-($gia*$giamgia)/100}}<span>${{$gia}}</span></div>
									<div class="viewed_name"><a href="#">{{$namesp}}</a></div>
								</div>
								<ul class="item_marks">
									@if($giamgia != 0)<li class="item_mark item_discount">-{{$giamgia}}%</li> @endif
									<li class="item_mark item_new">new</li>
								</ul>
							</div>
						</div>
					@endforeach
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
<script src="{{$urlShop}}/js/product_custom.js"></script>
@endsection