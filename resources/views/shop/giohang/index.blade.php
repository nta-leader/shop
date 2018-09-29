@extends('templates.shop.master')
@section('content')
<link rel="stylesheet" type="text/css" href="{{$urlShop}}/styles/cart_styles.css">
<link rel="stylesheet" type="text/css" href="{{$urlShop}}/styles/cart_responsive.css">
<script src="{{$urlShop}}/js/jquery-3.3.1.min.js"></script>
@php
    $auth=Auth::user();
@endphp
@if(!isset($auth->fullname))
<script type="text/javascript">
    swal({   
        title: "Bạn chưa đăng nhập !",
        text: "Chọn 'OK' để đăng nhập.  Chọn 'Hủy' để mua hàng không cần đăng nhập. Chúng tối khuyến khích bạn đăng nhập để quá trình kiểm tra đơn hàng được thuận lợi hơn !",         
        type: "warning",   
        showCancelButton: true,   
        confirmButtonColor: "#DD6B55",   
        confirmButtonText: "OK",   
        cancelButtonText: "Hủy",   
        closeOnConfirm: false,   
         }, 
        function(isConfirm){   
            if (isConfirm) {   
                window.location.href='{{route('auth.login')}}';   
            }else{     
                swal("Đã hủy !", "", "error");
            } 
        }
    );
</script>
@endif
<div id="thanhtoan" class="cart_section">
	<div class="container">
		<div class="row">
			<div class="col-lg-10 offset-lg-1">
				<div  class="cart_container">
					<div class="cart_title">Nhập thông tin mua hàng</div>
					<div class="cart_items">
						<ul class="cart_list">
							<li class="cart_item clearfix">
								<div class="form-group">
	                                <label>Họ tên</label>
	                                <input id="hoten" type="text" name="hoten" value="" class="form-control" />
                            	</div>
                            	<div class="form-group">
	                                <label>Số điện thoại</label>
	                                <input id="sdt" type="text" name="phone" value="" class="form-control" />
                            	</div>
                            	<div class="form-group">
	                                <label>Email</label>
	                                <input id="email" type="email" name="email" value="" class="form-control" />
                            	</div>
                            	<div class="form-group">
	                                <label>Địa chỉ giao hàng</label>
	                                <input id="diachi" type="text" name="diachi" value="" class="form-control" />
                            	</div>
                            	<div class="form-group">
	                                <label>Ghi chú</label>
	                                <textarea id="ghichu" class="form-control ckeditor" rows="3" name="ghichu"></textarea>
	                            </div>
	                            <div class="cart_buttons">
									<button onclick="dathang()" class="button cart_button_checkout">Đặt hàng</button>
								</div>
							</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script src="https://www.paypalobjects.com/api/checkout.js"></script>
<script>
    paypal.Button.render({

        env: 'sandbox', // sandbox | production

        client: {
            sandbox:    'AZDxjDScFpQtjWTOUtWKbyN_bDt4OgqaF4eYXlewfBP4-8aqX3PiV8e1GWU6liB2CUXlkA59kJXE7M6R',
            production: '<insert production client id>'
        },

        payment: function(data, actions) {
            return actions.payment.create({
                payment: {
                    transactions: [
                        {
                            amount: { total: '0.01', currency: 'USD' }
                        }
                    ]
                }
            });
        },

        // Wait for the payment to be authorized by the customer

        onAuthorize: function(data, actions) {

            // Get the payment details

            return actions.payment.get().then(function(data) {

                // Display the payment details and a confirmation button

                var shipping = data.payer.payer_info.shipping_address;

                document.querySelector('#recipient').innerText = shipping.recipient_name;
                document.querySelector('#line1').innerText     = shipping.line1;
                document.querySelector('#city').innerText      = shipping.city;
                document.querySelector('#state').innerText     = shipping.state;
                document.querySelector('#zip').innerText       = shipping.postal_code;
                document.querySelector('#country').innerText   = shipping.country_code;

                document.querySelector('#paypal-button-container').style.display = 'none';
                document.querySelector('#confirm').style.display = 'block';

                // Listen for click on confirm button

                document.querySelector('#confirmButton').addEventListener('click', function() {

                    // Disable the button and show a loading message

                    document.querySelector('#confirm').innerText = 'Loading...';
                    document.querySelector('#confirm').disabled = true;

                    // Execute the payment

                    return actions.payment.execute().then(function() {

                        // Show a thank-you note

                        document.querySelector('#thanksname').innerText = shipping.recipient_name;

                        document.querySelector('#confirm').style.display = 'none';
                        document.querySelector('#thanks').style.display = 'block';
                    });
                });
            });
        }

    }, '#paypal-button-container');

</script>
<script src="{{$urlShop}}/styles/bootstrap4/popper.js"></script>
<script src="{{$urlShop}}/styles/bootstrap4/bootstrap.min.js"></script>
@endsection