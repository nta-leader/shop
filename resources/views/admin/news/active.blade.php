@php
	$id=$objItem->id_new;
	$trangthai=$objItem->active;
@endphp
<center>
@if($trangthai==1)
    <a href="javascript:void(0)" onclick="active('1','#active{{$id}}','{{$id}}')" class="btn btn-primary">Hiển Thị</a>
@elseif($trangthai==0)
    <a href="javascript:void(0)" onclick="active('0','#active{{$id}}','{{$id}}')" class="btn btn-danger">Đã ẩn</a>
@endif
</center>