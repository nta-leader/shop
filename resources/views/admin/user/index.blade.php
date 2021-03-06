@extends('templates.admin.master')
@section('content')
 <div class="row">
    <div class="col-md-12">
        <h2>Quản lý liên hệ</h2>
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
                url: '{{route('admin.user.timkiem')}}',
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
            url: '{{route('admin.user.active')}}',
            type: 'post',
            cache: false,
            data: {
                id:id,
                active:active,
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
                                <th>ID</th>
                                <th>Username</th>
                                <th>Fullname</th>
                                <th>Cấp</th>
                                <th width="160px">Chức năng</th>
                            </tr>
                        </thead>
                        <tbody id="news">
                        @foreach($objItems as $objItem)
                        @php
                        	$id=$objItem->id;
                        	$username=$objItem->username;
                        	$fullname=$objItem->fullname;
                        	$chucvu=$objItem->chucvu;
                        	$urlEdit=route('admin.user.edit',['id'=>$id]);
                            $urlDel=route('admin.user.del',['id'=>$id]);
                        @endphp
                            <tr class="gradeX">
                                <td>{{$id}}</td>
                                <td>{{$username}}</td>
                                <td>{{$fullname}}</td>
                                <td id="active{{$id}}">
                                    <center>
                                    @if($chucvu==0)
                                        <a href="javascript:void(0)" class="btn btn-danger" >Admin</a>
                                    @elseif($chucvu==1)
                                        <a href="javascript:void(0)" onclick="active('1','#active{{$id}}','{{$id}}')" class="btn btn-primary" >Mod</a>
                                    @elseif($chucvu==2)
                                        <a href="javascript:void(0)" onclick="active('2','#active{{$id}}','{{$id}}')" class="btn btn-success btn-md">Thành viên</a>    
                                    @endif
                                    </center>
                                </td>
                                <td class="center">
                                    <center>
                                    <a href="{{$urlEdit}}" class="btn btn-primary"><i class="fa fa-edit "></i> Sửa</a>
                                    <a href="{{$urlDel}}" onclick="return confirm('Bạn có muốn xóa không !')" class="btn btn-danger"><i class="fa fa-pencil"></i> Xóa</a>
                                    </center>
                                    <br>
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
<div class="modal fade" id="modal-login2" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
            <div class="form-group">
                <form role="form" method="post" enctype="multipart/form-data" action="{{route('admin.contact.email')}}">
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