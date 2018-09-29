@extends('templates.admin.master')
@section('content')
 <div class="row">
    <div class="col-md-12">
        <h2>Quản lý Bình luận</h2>
    </div>
</div>
<!-- /. ROW  -->
<hr />
<meta name="csrf-token" content="{{ csrf_token() }}">
<script type="text/javascript">
    function view(id_sp,id_cm){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '{{route('admin.sanpham.cm_con')}}',
            type: 'post',
            cache: false,
            data: {
                id_cm:id_cm,
                id_sp:id_sp,
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
</script>
<div class="row">
    <div class="col-md-12">
        <!-- Advanced Tables -->
        <div class="panel panel-default">
            <div class="panel-body">
                <div id="_loc" class="table-responsive">
                    @if(Session::has('msg'))
                        <h2>{{Session::get('msg')}}</h2>
                    @endif
                    <a href="{{route('admin.sanpham.delete_anh',['id'=>$id])}}" onclick="return confirm('Bạn có muốn xóa không !')" class="btn btn-danger"><i class="fa fa-pencil"></i> Xóa toàn bộ</a>
                    <table id="click" class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Username</th>
                                <th>Nội dung</th>
                                <th width="160px">Chức năng</th>
                            </tr>
                        </thead>
                        <tbody id="news">
                        @foreach($objItems as $objItem)
                        @php
                            $id_cm=$objItem->id_cm;
                            $username=$objItem->username;
                            $content=$objItem->content;
                            $urlDel=route('admin.sanpham.del_cm',['id'=>$id_cm]);
                        @endphp
                            <tr class="gradeX">
                                <td>{{$id_cm}}</td>
                                <td>{{$username}}</td>
                                <td class="center">
                                    <a  title="xem bình luận con" href="javascript:void(0)" onclick="view('{{$id}}','{{$id_cm}}')" class="btn btn-primary" data-toggle="modal" data-target="#modal-login">{{$content}}</a>
                                </td>
                                <td class="center">
                                    <a href="{{$urlDel}}" onclick="return confirm('Bạn có muốn xóa không !')" class="btn btn-danger"><i class="fa fa-pencil"></i> Xóa</a>
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
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-body">
                <div id="view" class="table-responsive">
                    <div id="ajax_loader" class="ajax-load-qa"></div>
                </div>
            </div>
        </div>
        <!--End Advanced Tables -->
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