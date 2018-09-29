<!DOCTYPE html>
<html lang="en">
<head>
<title>OneTech</title>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="description" content="OneTech shop project">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="{{$urlShop}}/styles/bootstrap4/bootstrap.min.css">
<link href="{{$urlShop}}/plugins/fontawesome-free-5.0.1/css/fontawesome-all.css" rel="stylesheet" type="text/css">
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<script src="https://www.paypalobjects.com/api/checkout.js"></script>
<script src="{{$urlShop}}/sweetalert-dev.js"></script>
<link rel="stylesheet" href="{{$urlShop}}/sweetalert.css">
</head>
<body>
@php
   	$auth=Auth::user();
   	if(isset($auth->fullname)){
   		$username=$auth->username;
   		$fullname=$auth->fullname;
   	}else{
   		$username=null;
   	}
@endphp	
<div class="super_container">	
	<!-- Header -->
	<header class="header">
		<!-- Top Bar -->
		<div class="top_bar">
			<div class="container">
				<div class="row">
					<div class="col d-flex flex-row">
						<div class="top_bar_contact_item"><div class="top_bar_icon"><img src="{{$urlShop}}/images/phone.png" alt=""></div>09.194.194.96</div>
						<div class="top_bar_contact_item"><div class="top_bar_icon"><img src="{{$urlShop}}/images/mail.png" alt=""></div><a href="mailto:fastsales@gmail.com">Theanh.a1k12@gmail.com</a></div>
						<div class="top_bar_content ml-auto">
							<div class="top_bar_user">
								<div class="user_icon"><img src="{{$urlShop}}/images/user.svg" alt=""></div>
								@if($username==null)
									<div><a href="{{route('auth.dangky')}}">Đăng ký</a></div>
									<div><a href="{{route('auth.login')}}">Đăng nhập</a></div>
								@else
									<div><a href="{{route('shop.user.index')}}">{{$username}}</a></div>
									<div><a href="{{route('auth.logout')}}">Đăng xuất</a></div>
								@endif
							</div>
						</div>
					</div>
				</div>
			</div>		
		</div>

		<!-- Header Main -->

		<div class="header_main">
			<div class="container">
				<div class="row">

					<!-- Logo -->
					<div class="col-lg-2 col-sm-3 col-3 order-1">
						<div class="logo_container">
							<div class="logo"><a href="{{route('shop.index.index')}}">Shop.vne</a></div>
						</div>
					</div>

					<!-- Search -->
					<div class="col-lg-6 col-12 order-lg-2 order-3 text-lg-left text-right">
						<div class="header_search">
							<div class="header_search_content">
								<div class="header_search_form_container">
									<form action="{{route('shop.timkiem')}}" method="get" class="header_search_form clearfix">
										<input type="search" name="key" style="width: 100%;"  required="required" class="header_search_input" placeholder="Tìm kiếm sản phẩm...">
										<div style="display: none;" class="custom_dropdown">
											<div class="custom_dropdown_list">
												<span class="custom_dropdown_placeholder clc">All Categories</span>
												<i class="fas fa-chevron-down"></i>
												<ul class="custom_list clc">
													<li><a class="clc" href="#">All Categories</a></li>
													<li><a class="clc" href="#">Computers</a></li>
													<li><a class="clc" href="#">Laptops</a></li>
													<li><a class="clc" href="#">Cameras</a></li>
													<li><a class="clc" href="#">Hardware</a></li>
													<li><a class="clc" href="#">Smartphones</a></li>
												</ul>
											</div>
										</div>
										<button type="submit" class="header_search_button trans_300" value="Submit"><img src="{{$urlShop}}/images/search.png" alt=""></button>
									</form>
								</div>
							</div>
						</div>
					</div>

					<!-- Wishlist -->
					<div class="col-lg-4 col-9 order-lg-3 order-2 text-lg-left text-right">
						<div class="wishlist_cart d-flex flex-row align-items-center justify-content-end">
							<div class="wishlist d-flex flex-row align-items-center justify-content-end">
								<div class="wishlist_icon">
									<a href="{{route('shop.giohang.tinhtrang')}}">
										<img src="{{$urlShop}}/images/heart.png" alt="">
									</a>
								</div>
								<div class="wishlist_content">
									<div class="wishlist_text"><a href="{{route('shop.giohang.tinhtrang')}}">TT Đơn Hàng</a></div>
								</div>
							</div>

							<!-- Cart -->
							@if(Session::has('giohang'))
								@php
									$soluong=count(Session::get('giohang'));
								@endphp
							@else
								@php
									$soluong=0;
								@endphp
							@endif
							<div class="cart">
								<div class="cart_container d-flex flex-row align-items-center justify-content-end">
									<div class="cart_icon">
										<a onclick="giohang()" href="javascript:void(0)" title="Giỏ hàng" @if(Session::has('giohang')) data-toggle="modal" data-target="#modal-login" @endif>
											<img src="{{$urlShop}}/images/cart.png" alt="">
										</a>
										<div id="_soluong" class="cart_count"><span>{{$soluong}}</span></div>
									</div>
									<div class="cart_content">
										<div id="nut_giohang" class="cart_text">
											<a onclick="giohang()" href="javascript:void(0)" title="Giỏ hàng" @if(Session::has('giohang')) data-toggle="modal" data-target="#modal-login" @endif>Giỏ hàng</a>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- Main Navigation -->

		<nav class="main_nav">
			<div class="container">
				<div class="row">
					<div class="col">
						
						<div class="main_nav_content d-flex flex-row">

							<!-- Categories Menu -->

							<div class="cat_menu_container" id="menu">
								<div class="cat_menu_title d-flex flex-row align-items-center justify-content-start">
									<div class="cat_burger"><span></span><span></span><span></span></div>
									<div class="cat_menu_text" id="demo">Danh mục</div>
								</div>
								<!-- IN DANH MUC -->
								@php menuMulti2($objCats) @endphp
								
							</div>

							<!-- Main Nav Menu -->

							<div class="main_nav_menu ml-auto">
								<ul class="standard_dropdown main_nav_dropdown">
									<li><a href="{{route('shop.index.index')}}">Trang chủ<i class="fas fa-chevron-down"></i></a></li>
									<li class="hassubs">
										<a href="{{route('shop.gioithieu.index')}}">Giới thiệu</i></a>
									</li>
									<li class="hassubs">
										<a href="{{route('shop.chinhsach.index')}}">Chính sách</i></a>
									</li>
									<li class="hassubs">
										<a href="{{route('shop.huongdan.index')}}">HD mua hàng</a>
									</li>
									<li><a href="{{route('shop.news.index')}}">Bài viết</a></li>
									<li><a href="{{route('shop.contact.index')}}">Liên hệ</a></li>
								</ul>
							</div>

							<!-- Menu Trigger -->

							<div class="menu_trigger_container ml-auto">
								<div class="menu_trigger d-flex flex-row align-items-center justify-content-end">
									<div class="menu_burger">
										<div class="menu_trigger_text">menu</div>
										<div class="cat_burger menu_burger_inner"><span></span><span></span><span></span></div>
									</div>
								</div>
							</div>

						</div>
					</div>
				</div>
			</div>
		</nav>
	</header>
<script type="text/javascript">
	function mua(id_sp){
        $.ajax({
            url: '{{route('shop.giohang.add')}}',
            type: 'get',
            cache: false,
            data: {
                id_sp:id_sp,
            },
            success: function(data){
                $('#thongbao').html(data);
            },
            error: function (){
                alert('Có lỗi xảy ra');
            }
        });
    return false;
	}
	function giohang(){
        $.ajax({
            url: '{{route('shop.giohang.view')}}',
            type: 'get',
            cache: false,
            success: function(data){
                $('#giohang').html(data);
            },
            error: function (){
                alert('Có lỗi xảy ra');
            }
        });
    return false;
	}
</script>
<div id="thongbao">
	
</div>

<script type="text/javascript">
    function del(id){
        $.ajax({
            url: '{{route('shop.giohang.del')}}',
            type: 'get',
            cache: false,
            data: {
                id_sp:id,
            },
            success: function(data){
                $('#giohang').html(data);
            },
            error: function (){
                alert('Có lỗi xảy ra');
            }
        });
    return false;
    }
    function giam(id){
        $.ajax({
            url: '{{route('shop.giohang.giam')}}',
            type: 'get',
            cache: false,
            data: {
                id_sp:id,
            },
            success: function(data){
                $('#giohang').html(data);
            },
            error: function (){
                alert('Có lỗi xảy ra');
            }
        });
    return false;
    }
    function tang(id){
        $.ajax({
            url: '{{route('shop.giohang.tang')}}',
            type: 'get',
            cache: false,
            data: {
                id_sp:id,
            },
            success: function(data){
                $('#giohang').html(data);
            },
            error: function (){
                alert('Có lỗi xảy ra');
            }
        });
    return false;
    }
</script>
<script type="text/javascript">
	 function dathang(){
        hoten=document.getElementById("hoten").value;
        sdt=document.getElementById("sdt").value;
        email=document.getElementById("email").value;
        diachi=document.getElementById("diachi").value;
        ghichu=document.getElementById("ghichu").value;
        if(hoten!='' && sdt!='' && email!='' && diachi!=''){
            $.ajax({
                url: '{{route('shop.giohang.thanhtoan')}}',
                type: 'get',
                cache: false,
                data: {
                    hoten:hoten,
                    sdt:sdt,
                    email:email,
                    diachi:diachi,
                    ghichu:ghichu,
                },
                success: function(data){
                    $('#thanhtoan').html(data);
                },
                error: function (){
                    alert('Có lỗi xảy ra');
                }
            });
        }else{
            swal("Vui lòng nhập đầy đủ thông tin !", "", "error");
        }
    return false;
    }
</script>