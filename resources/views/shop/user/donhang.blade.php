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
					@php $check=0; @endphp
					<div>
						@foreach($objItems as $Item)
						@php
							$check=1;
						    $arId_sp=explode(' ',$Item->id_sp);
						    $tongtien=$Item->tongtien;
						    $httt=$Item->httt;
						    $trangthai=$Item->trangthai;
						    $arSoluong=explode(' ',$Item->soluong);
						    $arNamesp=explode('-',$Item->namesp);
						    $arPicture=explode(' ',$Item->picture);
						    $arGiasp=explode(' ',$Item->gia_sp);
						    $arGiamgia=explode(' ',$Item->giamgia);
						    $arHeso_tt=explode(' ',$Item->heso_tt);
						    $arThuoctinh=explode('-',$Item->thuoctinh);
						    
						@endphp
						<div  class="cart_items">
						<ul class="cart_list">
						<li  class="cart_item clearfix">
						<h3>Đơn hàng: {{$Item->date}}</h3>
						<table id="cart" class="table table-hover table-condensed">
						    <thead>
						        <tr>
						            <th>Tên sản phẩm</th>
						            <th >Giá gốc</th>
						            <th >thuộc tính</th>
						            <th >Số lượng</th>
						            <th>Giảm(%)</th>
						        </tr>
						    </thead>
						    <tbody>
						    @foreach($arId_sp as $key => $id_sp)
						        <tr>
						            <td data-th="Product">
						                <div class="row">
						                    <div class="col-sm-2 hidden-xs">
						                        <img src="/storage/app/files/{{$arPicture[$key]}}" alt="Sản phẩm 1" width="100" class="img-responsive"/>
						                    </div>
						                        <div class="col-sm-10">
						                            <h4 class="nomargin">{{$arNamesp[$key]}}</h4>
						                            <p></p>
						                        </div>
						                </div>
						            </td>
						            <td data-th="Price">{{$arGiasp[$key]}}$</td>
						            <td data-th="Price">
						                <p>Hệ số: {{$arHeso_tt[$key]}}</p>
						                @foreach($arThuoctinh as $so => $giatri)
						                @php
						                	if($giatri=='0'){
						                		$arThuoctinh[$so]='';
						                	}
						                @endphp
						                	<p>{{$arThuoctinh[$so]}}</p>
						                @endforeach
						            </td>
						            <td data-th="Quantity">
						                <span class="btn btn-success">{{$arSoluong[$key]}}</span>
						            </td>
						            <td data-th="Subtotal" class="text-center" style="color: red;" >{{$arGiamgia[$key]}}%</td>
						        </tr>
						    @endforeach
						    </tbody>
						    <tfoot>
						        <tr>
						            <td>
						                <span class="btn btn-success btn-block">
						                    @if($httt==0)
						                        Thanh toán khi nhận hàng
						                    @elseif($httt=1)
						                        Đã thanh toán qua paybay
						                    @endif
						                </span>
						            </td>
						            <td colspan="3" class="hidden-xs">
						                <span class="btn btn-success btn-block">
						                    @if($trangthai==0)
						                        Chờ nhân viên xác nhận
						                    @elseif($trangthai==1)
						                        Đang đóng gói chuyên đi
						                    @elseif($trangthai==2)
						                        Đã nhận hàng
						                    @endif
						                </span>
						            </td>
						            <td class="hidden-xs text-center">
						                <span class="btn btn-danger">
						                    <strong>Tổng tiền {{$tongtien}} $</strong>
						                </span>
						            </td>
						        </tr>
						    </tfoot>
						</table>
						</li>
						</ul>
						</div>  
						@endforeach
						@if($check==0)
							<h2 style="color: red;">Bạn chưa đặt sản phẩm nào !</h2>
						@endif
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