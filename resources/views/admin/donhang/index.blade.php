@extends('templates.admin.master')
@section('content')
 <div class="row">
    <div class="col-md-12">
        <h2>Quản lý đơn hàng</h2>
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
                url: '{{route('admin.donhang.timkiem')}}',
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
    function view(id){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '{{route('admin.donhang.view')}}',
            type: 'post',
            cache: false,
            data: {
                id_dh:id,
            },
            success: function(data){
                $('#view').html(data);
            },
            error: function (){
                alert('Có lỗi xảy ra');
            }
        });
    return false;
    }
    function email(id_dh,email){
        document.getElementById("email").innerHTML = '<input type="text"  class="form-control" value="'+email+'"  name="email">';
        document.getElementById("id_dh").innerHTML = '<input style="display: none;" type="text" value="'+id_dh+'"  name="id_dh">';
    }
</script>
<script type="text/javascript">
function trangthai(noidung,active,id_html,id){
    swal({   
        title: "Chuyển sang trạng thái '"+noidung+"' ?",
        text: "",         
        type: "warning",   
        showCancelButton: true,   
        confirmButtonColor: "#DD6B55",   
        confirmButtonText: "OK",   
        cancelButtonText: "Hủy",   
        closeOnConfirm: false,   
         }, 
        function(isConfirm){   
            if (isConfirm) {   
                $.ajaxSetup({
		            headers: {
		                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		            }
		        });
		        $.ajax({
		            url: '{{route('admin.donhang.trangthai')}}',
		            type: 'post',
		            cache: false,
		            data: {
		                id_dh:id,
		                active:active,
		                id_html:id_html,
		            },
		            success: function(data){
		            	swal({
						  	position: 'top-end',
						  	type: 'success',
						  	title: 'Thành công !',
						  	showConfirmButton: false,
						  	timer: 500
						});
		                $(id_html).html(data);
		            },
		            error: function (){
		                alert('Có lỗi xảy ra');
		            }
		        });   
            }else{     
                swal({
				  	position: 'top-end',
				  	type: 'error',
				  	title: 'Đã hủy !',
				  	showConfirmButton: false,
				  	timer: 1500
				});
            } 
        }
    );
}
</script>
<div class="row">
    <div class="col-md-12">
        <!-- Advanced Tables -->
        <div class="panel panel-default">
            <div class="panel-body">
                <div id="_loc" class="table-responsive">
                    <div class="row">
                        <div class="col-sm-6" style="text-align: right;">
                            <form method="get" action="javascript:void(0)">
                                <button  class="btn btn-warning btn-sm" onclick="get()" style="float:right">Tìm kiếm</button>
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
                                <th>ID_DH</th>
                                <th>Các sản phẩm</th>
                                <th>Tổng tiền</th>
                                <th>Hình thức thanh toán</th>
                                <th>Trạng thái</th>
                                <th width="160px">Chức năng</th>
                            </tr>
                        </thead>
                        <tbody id="news">
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
                            $urlDel=route('admin.donhang.del',['id'=>$id_dh]);
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
                                    <a href="{{$urlDel}}" onclick="return confirm('Bạn có muốn xóa không !')" class="btn btn-danger"><i class="fa fa-pencil"></i> Xóa</a>
                                    </center>
                                    <br>
                                    <center>
                                        <a href="javascript:void(0)" onclick="email('{{$id_dh}}','{{$objItem->email}}')" class="btn btn-primary" data-toggle="modal" data-target="#modal-login2">Gửi mail</a>
                                    </center>
                                </td>
                            </tr>
                        @endforeach
                            <tr>
                                <td colspan="10">
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
<style type="text/css">
    .ajax-load-qa {
    background: url("https://2.bp.blogspot.com/-K6t6oBc4jd0/WC1H9h6QBWI/AAAAAAAAAMU/A0C5q9w-mwkVQf_HlezvaJ0lftPP1u9jwCLcB/s1600/loading%2B%25283%2529.gif") no-repeat center center rgba(255,255,255,0.5);
    position: fixed;
    z-index: 100;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    display: none;
    z-index: 1000000000;
}
</style>
<div id="ajax_loader" class="ajax-load-qa"> </div>
<style type="text/css">
#dang-nhap{
	    width: 1445px;
    margin-left: -450px;
}
</style>

<div class="modal fade" id="modal-login" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
    <div class="modal-dialog" role="document">
        <div id="dang-nhap" class="modal-content">
            <div class="modal-body">
            <div id="view">
                <h2>Gio hang</h2>
			</div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modal-login2" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
            <div class="form-group">
                <form role="form" method="post" enctype="multipart/form-data" action="{{route('admin.donhang.email')}}">
                    {{csrf_field()}}
                    <span id="id_dh">
                        <input style="display: none;" type="text"  class="form-control"  name="id_dh">
                    </span>
                    <div class="form-group">
                        <label>Email</label>
                        <span id="email">
                            <input type="text"  class="form-control" value=""  name="email">
                        </span>
                    </div>
                    <div class="form-group">
                        <label>Chủ đề</label>
                        <input id="chude" type="text" required=""  class="form-control"  name="chude">
                    </div>
                    <div class="form-group">
                        <label>Nội dung</label>
                        <textarea id="noidung"  required="" class="form-control" rows="3" name="noidung"></textarea>
                    </div>
                   <button id="click"  type="submit" name="submit" class="btn btn-success btn-md">Gửi</button>
                </form>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $('#click').click(function(){
        chude=$('#chude').val();
        noidung=$('#noidung').val();
            if(chude!='' && noidung!=''){
            $('#ajax_loader').css( 'display', 'block' );
                setTimeout(function(){
                $('#ajax_loader').css( 'display', 'none' );
            }, 20000);
        }
    });
</script>
@endsection