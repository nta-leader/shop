@extends('templates.shop.master')
@section('content')
<link rel="stylesheet" type="text/css" href="{{$urlShop}}/styles/cart_styles.css">
<link rel="stylesheet" type="text/css" href="{{$urlShop}}/styles/cart_responsive.css">
<script src="{{$urlShop}}/js/jquery-3.3.1.min.js"></script>
<meta name="csrf-token" content="{{ csrf_token() }}">
<script type="text/javascript">
	function tracuu(){
		$.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        sdt=document.getElementById("sdt").value;
        email=document.getElementById("email").value;
        if(sdt!='' && email!=''){
            $.ajax({
                url: '{{route('shop.giohang.tinh_trang')}}',
                type: 'post',
                cache: false,
                data:{
                    sdt:sdt,
                    email:email,
                },
                success: function(data){
                    $('#tracuu').html(data);
                },
                error: function (){
                    alert('Có lỗi xảy ra');
                }
            });
        }else{
            swal('Có trường bị rỗng !','','error');
        }
	}
</script>
<div class="cart_section">
	<div class="container">
		<div class="row">
			<div class="col-lg-10 offset-lg-1">
				<div  class="cart_container">
					<div class="cart_title">Tra cứu đơn hàng !</div>
					<div class="cart_items">
						<ul class="cart_list">
							<li class="cart_item clearfix">
                            	<div class="form-group">
	                                <label>Số điện thoại</label>
	                                <input required id="sdt" type="text" value="" class="form-control" />
                            	</div>
                            	<div class="form-group">
	                                <label>Email</label>
	                                <input required id="email" type="email" name="email" value="" class="form-control" />
                            	</div>
	                            <div class="cart_buttons">
									<button onclick="tracuu()" class="button cart_button_checkout">Tra cứu</button>
								</div>
							</li>
						</ul>
					</div>
                    <div id="tracuu" class="cart_items">
                    </div>
				</div>
			</div>
		</div>
	</div>
</div>
<script src="{{$urlShop}}/styles/bootstrap4/popper.js"></script>
<script src="{{$urlShop}}/styles/bootstrap4/bootstrap.min.js"></script>
@endsection