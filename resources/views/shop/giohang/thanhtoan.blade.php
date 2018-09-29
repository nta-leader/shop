<meta name="csrf-token" content="{{ csrf_token() }}">
<script type="text/javascript">
	function thanhtoan(){
		$.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '{{route('shop.giohang.dathang')}}',
            type: 'post',
            cache: false,
            data:{
            	httt:0,
            },
            success: function(data){
            	swal("Đặt hàng thành công !", "", "success");
                $('#thanhtoan').html(data);
            },
            error: function (){
                alert('Có lỗi xảy ra');
            }
        });
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
<div class="container">
	<div class="row">
		<div class="col-lg-10 offset-lg-1">
			<div  class="cart_container">
				<div class="cart_title"><span style="color: red;">Chọn hình thức thanh toán</span></div>
				<div class="cart_items">
					<ul class="cart_list">
						<li class="cart_item clearfix">
							<button id="click" onclick="thanhtoan()" style="width: 100%;" class="button cart_button_checkout">
							Thanh toán khi nhận hàng
							</button>
						</li>
						<li class="cart_item clearfix">
						@php $gia=Session::get('tongtien'); @endphp
							<h2 style="width: 100%; position: relative; text-align: center;" class="button cart_button_checkout">
								
								<div id="paypal-button-container" style="width: 300px;position: relative;top: 12px;left: 0;margin: 0 auto;"></div>
							</h2>
							
							<script>
							    paypal.Button.render({

							        env: 'sandbox', // sandbox | production

							        // PayPal Client IDs - replace with your own
							        // Create a PayPal app: https://developer.paypal.com/developer/applications/create
							        client: {
							            sandbox:    'AafzKZvoCz5L3nMBj7AxvLKCL3wPj9bce0MuKY2JNK8JzuhiGMJdBdMDT323Dff0Pf80njQVBzYY3gXN',
							            production: '<insert production client id>'
							        },

							        // Show the buyer a 'Pay Now' button in the checkout flow
							        commit: true,

							        // payment() is called when the button is clicked
							        payment: function(data, actions) {

							            // Make a call to the REST api to create the payment
							            return actions.payment.create({
							                payment: {
							                    transactions: [
							                        {
							                            amount: { total: '{{$gia}}', currency: 'USD' }
							                        }
							                    ]
							                }
							            });
							        },

							        // onAuthorize() is called when the buyer approves the payment
							        onAuthorize: function(data, actions) {

							            // Make a call to the REST api to execute the payment
							            return actions.payment.execute().then(function() {
							            	swal("Thanh toan thanh cong !", "", "success");
											$.ajaxSetup({
									            headers: {
									                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
									            }
									        });
								            $.ajax({
								                url: '{{route('shop.giohang.dathang')}}',
								                type: 'post',
								                cache: false,
								                data:{
								                	httt:1,
								                },
								                success: function(data){
								                    $('#thanhtoan').html(data);
								                },
								                error: function (){
								                    alert('Có lỗi xảy ra');
								                }
								            });
							            });
							        }

							    }, '#paypal-button-container');

							</script>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>