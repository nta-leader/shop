@extends('templates.admin.master')
@section('content')
<div class="row">
<div class="col-md-12">
    <h2>Quản lý bài viết</h2>
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
                url: '{{route('admin.news.timkiem')}}',
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
        url: '{{route('admin.news.active_news')}}',
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
                <div class="table-responsive">
                    <div class="row">
                        <div class="col-sm-6">
                            <a href="{{route('admin.news.add')}}" class="btn btn-success btn-md">Thêm</a>
                        </div>
                        <div class="col-sm-6" style="text-align: right;">
                            <form method="get" action="javascript:void(0)">
                                <button class="btn btn-warning btn-sm" onclick="get()" style="float:right">Tìm kiếm</button>
                                <input type="text" id="key" name="key"  class="form-control input-sm" placeholder="Nhập tên bài viết !" style="float:right; width: 300px;" />
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
                                <th>Tên bài viết</th>
                                <th>Giới thiệu</th>
                                <th>Hình ảnh</th>
                                <th>Trạng Thái</th>
                                <th width="160px">Chức năng</th>
                            </tr>
                        </thead>
                        <tbody id="news">
                        @foreach($objItems as $objItem)
                        @php
                            $id=$objItem->id_new;
                            $namenew=$objItem->namenew;
                            $gioithieu=$objItem->preview_text;
                            $picture=$objItem->picture;
                            $trangthai=$objItem->active;
                            $urlBinhluan=route('admin.news.comment',['id'=>$id]);
                            $urlEdit=route('admin.news.edit',['id'=>$id]);
                            $urlDel=route('admin.news.del',['id'=>$id]);
                        @endphp
                            <tr class="gradeX">
                                <td>{{$id}}</td>
                                <td><a href="{{$urlBinhluan}}" title="Xem bình luận">{{$namenew}}</a></td>
                                <td>{!!$gioithieu!!}</td>
                                <td class="center">
                                    <img src="/storage/app/files/{{$picture}}" alt="" height="80px" width="100px" />
                                </td>
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
@endsection