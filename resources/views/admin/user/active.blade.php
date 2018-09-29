@php
	$id=$objItem->id;
	$chucvu=$objItem->chucvu;
@endphp
<center>
@if($chucvu==1)
    <a href="javascript:void(0)" onclick="active('1','#active{{$id}}','{{$id}}')" class="btn btn-primary">Mod</a>
@elseif($chucvu==2)
    <a href="javascript:void(0)" onclick="active('2','#active{{$id}}','{{$id}}')" class="btn btn-success btn-md">Thành viên</a>
@endif
</center>