
<script type="text/javascript">
	$( document ).ready(function() {
	    //swal("Đã thêm vào giỏ hàng !", "", "success");
	    swal({
		  	position: 'top-end',
		  	type: 'success',
		  	title: 'Đã thêm vào giỏ hàng !',
		  	showConfirmButton: false,
		  	timer: 1000
		})
	})
	document.getElementById("nut_giohang").innerHTML = '<a onclick="giohang()" href="/#" title="Giỏ hàng" data-toggle="modal" data-target="#modal-login">Giỏ hàng</a>';
	document.getElementById("_soluong").innerHTML = "{{$soluong}}";
</script>