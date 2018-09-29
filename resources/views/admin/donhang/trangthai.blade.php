@php
	if($active==1){
		$trangthai="Đang đóng gói";
		$noidung="Đã nhận";
	}elseif($active==2){
		$trangthai="Đã nhận";
		$noidung="Đã nhận";
	}
@endphp
<a href="javascript:void(0)" @if($active < 2) onclick="trangthai('{{$noidung}}','{{$active}}','#active{{$id_dh}}','{{$id_dh}}')" @endif class="btn btn-primary">
	{{$trangthai}}
</a>