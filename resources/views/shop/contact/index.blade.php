@extends('templates.shop.master')
@section('content')
<!-- Contact Info -->
<link rel="stylesheet" type="text/css" href="{{$urlShop}}/styles/contact_styles.css">
<link rel="stylesheet" type="text/css" href="{{$urlShop}}/styles/contact_responsive.css">

<!-- Contact Form -->

<div class="contact_form">
	<div class="container">
		<div class="row">
			<div class="col-lg-10 offset-lg-1">
				<div class="contact_form_container">
					<div class="contact_form_title">Liên hệ với chúng tôi</div>
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
               		<form action="{{route('shop.contact.post')}}" method="post" id="contact_form">
                	{{csrf_field()}}				
						<div class="contact_form_inputs d-flex flex-md-row flex-column justify-content-between align-items-between">
							<input name="name" type="text" id="contact_form_name" class="contact_form_name input_field" placeholder="Họ tên" value="{!! old('name') !!}"  data-error="Name is required.">
							<input name="email" type="text" id="contact_form_email" class="contact_form_email input_field" placeholder="Email" value="{!! old('email') !!}" data-error="Email is required.">
							<input name="phone" type="text" id="contact_form_phone" class="contact_form_phone input_field"  placeholder="Số điện thoại" value="{!! old('phone') !!}">
						</div>
						<div class="contact_form_text">
							<textarea id="contact_form_message" class="text_field contact_form_message" name="message" rows="4" placeholder="Nội dung"  data-error="Please, write us a message.">{!! old('message') !!}</textarea>
						</div>
						<div class="contact_form_button">
							<button type="submit" class="button contact_submit_button">Gửi</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
	<div class="panel"></div>
</div>
@endsection