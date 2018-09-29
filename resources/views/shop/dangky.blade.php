@extends('templates.shop.master')
@section('content')
<link rel="stylesheet" type="text/css" href="{{$urlShop}}/styles/cart_styles.css">
<link rel="stylesheet" type="text/css" href="{{$urlShop}}/styles/cart_responsive.css">
<div class="cart_section">
	<div class="container">
		<div class="row">
			<div class="col-lg-10 offset-lg-1">
				<div  class="cart_container">
					<div class="cart_title">Đăng nhập</div>
					<div class="cart_items">
						<ul class="cart_list">
							<li class="cart_item clearfix">
		                    @if(Session::has('msg'))
		                        <h4 style="color: red;">{{Session::get('msg')}}</h4>
		                    @endif
		                    @if ($errors->any())
		                        <div class="alert alert-danger">
		                            <ul>
		                                @foreach ($errors->all() as $error)
		                                    <li>{{ $error }}</li>
		                                @endforeach
		                            </ul>
		                        </div>
		                    @endif
                       		<form role="form" method="post" action="{{route('auth.dangky')}}">
                        	{{csrf_field()}}
                            	<div class="form-group">
	                                <label>Tài khoản</label>
	                                <input required  type="text" @if(Session::has('username')) value="{{Session::get('username')}}" @endif value="{!! old('username') !!}"  name="username" class="form-control" />
                            	</div>
                            	<div class="form-group">
	                                <label>Mật khẩu</label>
	                                <input required  type="password" name="password" value="" class="form-control" />
                            	</div>
                            	<div class="form-group">
	                                <label>Nhập lại mật khẩu</label>
	                                <input required  type="password" name="password2" value="" class="form-control" />
                            	</div>
                            	<div class="form-group">
	                                <label>Fullname</label>
	                                <input required  type="text" name="fullname" @if(Session::has('fullname')) value="{{Session::get('fullname')}}" @endif   value="{!! old('fullname') !!}" class="form-control" />
                            	</div>
	                            <div class="cart_buttons">
									<button class="button cart_button_checkout">Login</button>
								</div>
							</form>
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