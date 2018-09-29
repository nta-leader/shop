@foreach($objItems as $Item)
@php
    $arId_sp=explode(' ',$Item->id_sp);
    $tongtien=$Item->tongtien;
    $httt=$Item->httt;
    $trangthai=$Item->trangthai;
    $arSoluong=explode(' ',$Item->soluong);
    $arNamesp=explode('-',$Item->namesp);
    $arPicture=explode(' ',$Item->picture);
    $arGiasp=explode(' ',$Item->gia_sp);
    $arGiamgia=explode(' ',$Item->giamgia);
    $arHeso_tt=explode(' ',$Item->heso_tt);
    $arThuoctinh=explode('-',$Item->thuoctinh);
@endphp
<div  class="cart_items">
<ul class="cart_list">
<li  class="cart_item clearfix">
<h3>Đơn hàng: {{$Item->date}}</h3>
<table id="cart" class="table table-hover table-condensed">
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
                <div class="row">
                    <div class="col-sm-2 hidden-xs">
                        <img src="/storage/app/files/{{$arPicture[$key]}}" alt="Sản phẩm 1" width="100" class="img-responsive"/>
                    </div>
                        <div class="col-sm-10">
                            <h4 class="nomargin">{{$arNamesp[$key]}}</h4>
                            <p></p>
                        </div>
                </div>
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
</li>
</ul>
</div>  
@endforeach