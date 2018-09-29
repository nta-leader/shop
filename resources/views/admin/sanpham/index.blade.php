@extends('templates.admin.master')
@section('content')
 <div class="row">
    <div class="col-md-12">
        <h2>Quản lý sản phẩm</h2>
    </div>
</div>
<!-- /. ROW  -->
<hr />
<meta name="csrf-token" content="{{ csrf_token() }}">
<script type="text/javascript">
    function get(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        tk=document.getElementById("key").value;
        if(tk!=''){
            $.ajax({
                url: '{{route('admin.sanpham.timkiem')}}',
                type: 'post',
                cache: false,
                data: {
                    key:tk,
                },
                success: function(data){
                    $('#news').html(data);
                },
                error: function (){
                    alert('Có lỗi xảy ra');
                }
            });
        }else{
            swal("Không được để rỗng !", "", "error");
        }
    return false;
    }
    function active(active,id_html,id){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '{{route('admin.sanpham.active')}}',
            type: 'post',
            cache: false,
            data: {
                id:id,
                active:active,
                id_html:id_html,
            },
            success: function(data){
                $(id_html).html(data);
            },
            error: function (){
                alert('Có lỗi xảy ra');
            }
        });
    return false;
    }

    $(document).ready(function(){
        $("#danhmuc").change(function(){
            var id=$("#danhmuc").val();
            $.ajax({
                url:'{{route('admin.sanpham.loc')}}',
                type:'get',
                cache: false,
                data:{
                    id_cat:id,
                },
                success:function(data){
                    $('#news').html(data);
                },
                error:function(){
                    alert('Có lỗi xảy ra');
                },
            });
        })
    })
</script>
<div class="row">
    <div class="col-md-12">
        <!-- Advanced Tables -->
        <div class="panel panel-default">
            <div class="panel-body">
                <div id="_loc" class="table-responsive">
                    <div class="row">
                        <div class="col-sm-6">
                            <a href="{{route('admin.sanpham.add')}}" class="btn btn-success btn-md">Thêm</a>
                        </div>
                        <div class="col-sm-6" style="text-align: right;">
                            <form method="get" action="javascript:void(0)">
                                <button class="btn btn-warning btn-sm" onclick="get()" style="float:right">Tìm kiếm</button>
                                <input type="text" id="key" name="key" class="form-control input-sm" placeholder="Nhập từ cần tìm !" style="float:right; width: 300px;" />
                                <div style="clear:both"></div>
                            </form><br />
                        </div>
                    </div>
                    @if(Session::has('msg'))
                        <h2>{{Session::get('msg')}}</h2>
                    @endif
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Tên sản phẩm</th>
                                <th>Giá bán</th>
                                <th>Đã đặt</th>
                                <th>hệ số thuộc tính</th>
                                <th>
                                	<div>
										<select id="danhmuc" name="parent_id" class="form-control">
											<option value="0">-Danh mục-</option>
											@php menuMulti_sp($objCats) @endphp
										</select>
									</div>
								</th>
                                <th>Giới thiệu</th>
                                <th>Hình ảnh</th>
                                <th>Giảm giá(%)</th>
                                <th>Trạng Thái</th>
                                <th width="160px">Chức năng</th>
                            </tr>
                        </thead>
                        <tbody id="news">
                        @foreach($objItems as $objItem)
                        @php
                            $id=$objItem->id_sp;
                            $namesp=$objItem->namesp;
                            $namecat=$objItem->namecat;
                            $gioithieu=$objItem->preview_text;
                            $picture=$objItem->picture;
                            $giamgia=$objItem->giamgia;
                            $gia=$objItem->gia;
                            $daban=$objItem->daban;
                            $heso_tt=$objItem->heso_tt;
                            $trangthai=$objItem->active;
                            $urlBinhluan=route('admin.sanpham.comment',['id'=>$id]);
                            $urlEdit=route('admin.sanpham.edit',['id'=>$id]);
                            $urlDel=route('admin.sanpham.del',['id'=>$id]);
                            $urlAnh=route('admin.sanpham.anh',['id'=>$id]);
                        @endphp
                            <tr class="gradeX">
                                <td>{{$id}}</td>
                                <td><a href="{{$urlBinhluan}}" title="Xem bình luận">{{$namesp}}</a></td>
                                <td>{{$gia}}</td>
                                <td>{{$daban}}</td>
                                <td>{{$heso_tt}}</td>
                                <td>{{$namecat}}</td>
                                <td>{{$gioithieu}}</td>
                                <td class="center">
                                    <img src="/storage/app/files/{{$picture}}" alt="" height="80px" width="100px" />
                                    <br>
                                    <center><a href="{{$urlAnh}}">Xem các ảnh</a></center>
                                </td>
                                <td>{{$giamgia}}</td>
                                <td id="active{{$id}}">
                                    <center>
                                    @if($trangthai==1)
                                        <a href="javascript:void(0)" onclick="active('1','#active{{$id}}','{{$id}}')" class="btn btn-primary">Hiển Thị</a>
                                    @elseif($trangthai==0)
                                        <a href="javascript:void(0)" onclick="active('0','#active{{$id}}','{{$id}}')" class="btn btn-danger">Đã ẩn</a>
                                    @endif
                                    </center>
                                </td>
                                <td class="center">
                                    <a href="{{$urlEdit}}" class="btn btn-primary"><i class="fa fa-edit "></i> Sửa</a>
                                    <a href="{{$urlDel}}" onclick="return confirm('Bạn có muốn xóa không !')" class="btn btn-danger"><i class="fa fa-pencil"></i> Xóa</a>
                                </td>
                            </tr>
                        @endforeach
                            <tr>
                                <td colspan="11">
                                    <div>
                                        <div style="width: 30%;margin: 0 auto;">
                                           {{$objItems->links()}}
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
        <!--End Advanced Tables -->
    </div>
</div>
@endsection