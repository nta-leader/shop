<script type="text/javascript">
    document.getElementById("_soluong").innerHTML = "0";
    document.getElementById("nut_giohang").innerHTML = '<a onclick="giohang()" href="javascript:void(0)" title="Giỏ hàng">Giỏ hàng</a>';
</script>
<div class="container">
    <div class="row">
        <div class="col-lg-10 offset-lg-1">
            <div  class="cart_container">
                <div class="cart_title">Đặt hàng thành công !</div>
                <div class="cart_items">
                    <ul class="cart_list">
                        <li class="cart_item clearfix">
                            <div style="margin-top:0px;" class="cart_buttons">
                                <a href="{{route('shop.giohang.tinhtrang')}}" style="width:100%;text-align:center;" class="button cart_button_checkout">
                                Xem tình trạng đơn hàng
                                </a>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>