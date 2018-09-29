@extends('templates.shop.master')
@section('content')
<link rel="stylesheet" type="text/css" href="{{$urlShop}}/styles/regular_styles.css">
<link rel="stylesheet" type="text/css" href="{{$urlShop}}/styles/regular_responsive.css">
	<div class="single_post">
		<div class="container">
			<div class="row">
				<div class="col-lg-8 offset-lg-2">
					{!!$noidung!!}
				</div>
			</div>
		</div>
	</div>
<script src="{{$urlShop}}/js/jquery-3.3.1.min.js"></script>
@endsection