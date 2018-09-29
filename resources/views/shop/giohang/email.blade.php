@php
    $arId_sp=explode(' ',$objItem['id_sp']);
    $tongtien=$objItem['tongtien'];
    $httt=$objItem['httt'];
    $trangthai=$objItem['trangthai'];
    $arSoluong=explode(' ',$objItem['soluong']);
    $arNamesp=explode('-',$objItem['namesp']);
    $arPicture=explode(' ',$objItem['picture']);
    $arGiasp=explode(' ',$objItem['gia_sp']);
    $arGiamgia=explode(' ',$objItem['giamgia']);
    $arHeso_tt=explode(' ',$objItem['heso_tt']);
    $arThuoctinh=explode('-',$objItem['thuoctinh']);
@endphp
<h3>Đơn hàng: {{$objItem['date']}}</h3>
<table border="1" id="cart" class="table table-hover table-condensed">
    <thead>
        <tr>
            <th>Tên sản phẩm</th>
            <th >Giá gốc</th>
            <th >thuộc tính</th>
            <th >Số lượng</th>
            <th>Giảm(%)</th>
        </tr>
    </thead>
    <tbody>
    @foreach($arId_sp as $key => $id_sp)
        <tr>
            <td data-th="Product">
                <h4 class="nomargin">{{$arNamesp[$key]}}</h4>
            </td>
            <td data-th="Price">{{$arGiasp[$key]}}$</td>
            <td data-th="Price">
                <p>Hệ số: {{$arHeso_tt[$key]}}</p>
                @foreach($arThuoctinh as $so => $giatri)
                @php
                    if($giatri=='0'){
                        $arThuoctinh[$so]='';
                    }
                @endphp
                    <p>{{$arThuoctinh[$so]}}</p>
                @endforeach
            </td>
            <td data-th="Quantity">
                <span class="btn btn-success">{{$arSoluong[$key]}}</span>
            </td>
            <td data-th="Subtotal" class="text-center" style="color: red;" >{{$arGiamgia[$key]}}%</td>
        </tr>
    @endforeach
    </tbody>
    <tfoot>
        <tr>
            <td>
                <span class="btn btn-success btn-block">
                    @if($httt==0)
                        Thanh toán khi nhận hàng
                    @elseif($httt=1)
                        Đã thanh toán qua paybay
                    @endif
                </span>
            </td>
            <td colspan="3" class="hidden-xs">
                <span class="btn btn-success btn-block">
                    @if($trangthai==0)
                        Chờ nhân viên xác nhận
                    @elseif($trangthai==1)
                        Đang đóng gói chuyên đi
                    @elseif($trangthai==2)
                        Đã nhận hàng
                    @endif
                </span>
            </td>
            <td class="hidden-xs text-center">
                <span class="btn btn-danger">
                    <strong>Tổng tiền {{$tongtien}} $</strong>
                </span>
            </td>
        </tr>
    </tfoot>
</table>
<h3>Thông tin nhận hàng !</h3>
<ul>
    <li>Họ tên: {{$objItem['hoten']}}</li>
    <li>SDT: {{$objItem['sdt']}}</li>
    <li>Email: {{$objItem['email']}}</li>
    <li>Địa chỉ: {{$objItem['diachi']}}</li>
    <li>Ghi chú: {{$objItem['ghichu']}}</li>
</ul>