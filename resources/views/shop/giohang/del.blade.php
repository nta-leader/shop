<script type="text/javascript">
    document.getElementById("_soluong").innerHTML = "{{$soluong}}";
</script>
<form action="{{route('shop.giohang.index')}}">
<h3>Cách tính</h3>
<h4>(( GiaGoc + ( ThuocTinh*HeSo ))*SoLuong )*(100-GiamGia)= Thành tiền</h4>
<table id="cart" class="table table-hover table-condensed">
    <thead>
        <tr>
            <th>Tên sản phẩm</th>
            <th >Giá gốc</th>
            <th >thuộc tính</th>
            <th >Số lượng</th>
            <th>Giảm(%)</th>
            <th class="text-center">Thành tiền</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
    @php $tongtien=0; @endphp
    @foreach($giohang as $objItem)
    @php
       $id_sp=$objItem['id_sp'];
       $thuoctinh=$objItem['thuoctinh'];
       $thongtin=$objItem[$id_sp];
       $soluong=$objItem['soluong'];

       $id_cat=$thongtin['id_cat'];
       $picture=$thongtin['picture'];
       $namesp=$thongtin['namesp'];
       $gia=$thongtin['gia'];
       $giagoc=$gia;

       $gia_tt="";
       $heso_tt=$thongtin['heso_tt'];
       foreach($thuoctinh as $Item){  
            $gia+=$Item['gia']*$heso_tt;
            $gia_tt=$gia_tt."{$Item['gia']}+";
       }
       $gia_tt=rtrim($gia_tt,'+');
        
       $giamgia=$thongtin['giamgia'];
       $giaban=ceil($gia*(100-$giamgia)/100);
       $tongtien+=$giaban*$soluong;
       Session::put('tongtien',$tongtien);
       //dd($giohang);
    @endphp
        <tr>
            <td data-th="Product">
                <div class="row">
                    <div class="col-sm-2 hidden-xs">
                        <img src="/storage/app/files/{{$picture}}" alt="Sản phẩm 1" width="100" class="img-responsive"/>
                    </div>
                        <div class="col-sm-10">
                            <h4 class="nomargin">{{$namesp}}</h4>
                            <p></p>
                        </div>
                </div>
            </td>
            <td data-th="Price">{{$giagoc}} $</td>
            <td data-th="Price">
            <p>Hệ số: {{$heso_tt}}</p>
            @foreach($thuoctinh as $Item)
            @php
                $id_tt_cha=$Item['id'];
                $namett=$Item['namett'];
                $val=$Item['val'];
            @endphp
            <script type="text/javascript">
                $(document).ready(function(){
                    $("._thuoctinh{{$id_sp}}{{$id_tt_cha}}").change(function(){
                        var id=$("._thuoctinh{{$id_sp}}{{$id_tt_cha}}").val();
                        if(id!=""){
                            $.ajax({
                                url: '{{route('shop.giohang.thuoctinh')}}',
                                type: 'get',
                                cache: false,
                                data: {
                                    id:id,
                                },
                                success: function(data){
                                    $('#giohang').html(data);
                                },
                                error: function (){
                                    alert('Có lỗi xảy ra');
                                }
                            });
                        }else{
                            swal("Vui lòng chọn thuộc tính !", "", "error");
                        }
                    })
                })
            </script>
                <select required name="name{{$id_sp}}{{$id_tt_cha}}" class="_thuoctinh{{$id_sp}}{{$id_tt_cha}}">
                    <option value="">-Chọn {{$namett}}-</option>
                    @foreach($objItems_tt as $value)
                    @if($value['parent_id']==$id_tt_cha)
                    <option @if($val==$value['id_tt']) selected @endif value="{{$id_sp}}-{{$value['id_tt']}}-{{$id_tt_cha}}">{{$value['namett']}}( + {{$value['gia']}}$ )</option>
                    @endif
                    @endforeach
                </select>
                <br>
            @endforeach
            </td>
            <td data-th="Quantity">
                <a href="javascript:void(0)" @if($soluong != 1) onclick="giam('{{$id_sp}}')" @endif class="btn btn-primary">-</a>
                <span class="btn btn-success">{{$soluong}}</span>
                <a href="javascript:void(0)" onclick="tang('{{$id_sp}}')" class="btn btn-danger">+</a>
            </td>
            <td data-th="Subtotal" class="text-center" style="color: red;" >{{$giamgia}}%</td>
            <td data-th="Subtotal" class="text-center">
            @if($thuoctinh != [])
            ( ( ( {{$giagoc}} + ( {{$gia_tt}} ) * {{$heso_tt}} ) * {{$soluong}} ) * {{100-$giamgia}} ) / 100 = {{$giaban*$soluong}}$
            @else
            ( ( {{$giagoc}} * {{$soluong}} ) * {{100-$giamgia}} ) / 100={{$giaban*$soluong}}$ 
            @endif
            </td>
            <td class="actions" data-th="">
                <a href="javascript:void(0)" onclick="del('{{$id_sp}}')" class="btn btn-danger">xóa</a>
            </td>
        </tr>
     @endforeach
    </tbody>
    @php Session::put('tongtien',$tongtien); @endphp
    <tfoot>
        <tr>
            <td>
                <a href="{{route('shop.giohang.delete')}}" class="btn btn-success btn-block">
                    <i class="fa fa-angle-left"></i>
                    Hủy giỏ hàng
                </a>
            </td>
            <td colspan="3" class="hidden-xs"></td>
            <td class="hidden-xs text-center">
                <strong>Tổng tiền {{$tongtien}} $</strong>
            </td>
            <td>
                <button class="btn btn-success btn-block">
                    Thanh toán
                    <i class="fa fa-angle-right"></i>
                </button>
            </td>
        </tr>
    </tfoot>
</table>
</form>
