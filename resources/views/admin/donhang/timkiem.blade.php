@foreach($objItems as $objItem)
@php
	$id_dh=$objItem->id_dh;
	$arId_sp=explode(' ',$objItem->id_sp);
	$namesp=explode('-',$objItem->namesp);
	$thuoctinh=explode('-',$objItem->thuoctinh);
	$soluong=explode(' ',$objItem->soluong);
	$tongtien=$objItem->tongtien;
	$httt=$objItem->httt;
	if($httt==0){
		$httt="Thanh toán khi nhận hàng";
	}elseif($httt==1){
		$httt="paybay";
	}
	$trangthai=$objItem->trangthai;
	$trang_thai=$objItem->trangthai;
	if($trangthai==0){
		$trangthai="Chưa xác nhận";
		$noidung="Đóng Gói";
	}elseif($trangthai==1){
		$trangthai="Đang đóng gói";
		$noidung="Đã nhận";
	}elseif($trangthai==2){
		$trangthai="Đã nhận";
		$noidung="Đã nhận";
	}
@endphp
    <tr class="gradeX">
        <td>{{$id_dh}}</td>
        <td>
        <ul>
        	@foreach($arId_sp as $key => $id_sp)
        	<li>{{$namesp[$key]}} 
        		@if($thuoctinh[$key]!="" && $thuoctinh[$key]!='0') - {{$thuoctinh[$key]}} @endif
        		- số lượng: {{$soluong[$key]}}
        	</li>
        	@endforeach
        </ul>
        </td>
        <td>{{$tongtien}}</td>
        <td>{{$httt}}</td>
        <td id="active{{$id_dh}}">
        	<a href="javascript:void(0)" @if($trang_thai < 2) onclick="trangthai('{{$noidung}}','{{$trang_thai}}','#active{{$id_dh}}','{{$id_dh}}')" @endif class="btn btn-primary">
        		{{$trangthai}}
        	</a>
        </td>
        <td class="center">
            <center>
            <a href="javascript:void(0)" onclick="view('{{$id_dh}}')" class="btn btn-primary" data-toggle="modal" data-target="#modal-login">Xem</a>
            <a href="" onclick="return confirm('Bạn có muốn xóa không !')" class="btn btn-danger"><i class="fa fa-pencil"></i> Xóa</a>
            </center>
            <br>
            <center>
                <a href="javascript:void(0)" onclick="email('{{$id_dh}}','{{$objItem->email}}')" class="btn btn-primary" data-toggle="modal" data-target="#modal-login2">Gửi mail</a>
            </center>
        </td>
    </tr>
@endforeach