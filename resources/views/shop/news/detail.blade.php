@extends('templates.shop.master')
@section('content')
<link rel="stylesheet" type="text/css" href="{{$urlShop}}/plugins/OwlCarousel2-2.2.1/owl.carousel.css">
<link rel="stylesheet" type="text/css" href="{{$urlShop}}/plugins/OwlCarousel2-2.2.1/owl.theme.default.css">
<link rel="stylesheet" type="text/css" href="{{$urlShop}}/plugins/OwlCarousel2-2.2.1/animate.css">
<link rel="stylesheet" type="text/css" href="{{$urlShop}}/styles/blog_single_styles.css">
<link rel="stylesheet" type="text/css" href="{{$urlShop}}/styles/blog_single_responsive.css">
<meta name="csrf-token" content="{{ csrf_token() }}">
@php
    $auth=Auth::user();
@endphp
<script type="text/javascript">
	function comment(id,id_cm){
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
	            url: '{{route('shop.news.binhluan')}}',
	            type: 'post',
	            cache: false,
	            data:{
	            	id:id,
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
</script>
<style type="text/css">
	.khung{
		margin-bottom: 10px;
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
@php
	$name=$objItem->namenew;
	$picture=$objItem->picture;
	$detail=$objItem->detail_text;
@endphp
<div class="home">
	<div class="home_background parallax-window" data-parallax="scroll" data-image-src="/storage/app/files/{{$picture}}" data-speed="0.8"></div>
</div>

<!-- Single Blog Post -->

<div class="single_post">
	<div class="container">
		<div class="row">
			<div class="col-lg-8 offset-lg-2">
				<div class="single_post_title">{{$name}}</div>
				<div class="single_post_text">
					{!!$detail!!}
				</div>
			</div>
		</div>
		<hr>
		<div id="khung" class="khung">
			<div id="form_traloi0" class="traloi">
				<input id="id0" style="display: none;" type="text" value="{{$id}}">
				<input id="id_cm0" style="display: none;" type="text" value="0">
				<input id="content0" class="input" type="" name="">
				<a onclick="comment({{$id}},0)" title="OK" style="margin-left: -177px;padding: 5px 0px;" href="javascript:void(0)" class="ok">Bình luận</a> 
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
						<input id="id{{$id_cm}}" style="display: none;" type="text" value="{{$id}}">
						<input id="id_cm{{$id_cm}}" style="display: none;" type="text" value="{{$id_cm}}">
						<input id="content{{$id_cm}}" class="input" type="" name="">
						<a onclick="comment({{$id}},{{$id_cm}})" href="javascript:void(0)" class="ok">ok</a> 
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

<div class="blog">
	<div class="container">
		<div class="row">
			<div class="col">
				<div class="blog_posts d-flex flex-row align-items-start justify-content-between">
				@foreach($objItems as $objItem)
				@php
					$id_new=$objItem->id_new;
					$name=$objItem->namenew;
					$picture=$objItem->picture;
					$text=editString($name);
					$url=route('shop.news.detail',['namenews'=>$text,'id'=>$id_new]);
				@endphp
					<!-- Blog post -->
					<div class="blog_post">
						<div class="blog_image" style="background-image:url(/storage/app/files/{{$picture}})"></div>
						<div class="blog_text">{{$name}}</div>
						<div class="blog_button"><a href="{{$url}}">Xem bài viết</a></div>
					</div>
				@endforeach
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
<script src="{{$urlShop}}/plugins/parallax-js-master/parallax.min.js"></script>
<script src="{{$urlShop}}/plugins/easing/easing.js"></script>
<script src="{{$urlShop}}/js/blog_single_custom.js"></script>
@endsection