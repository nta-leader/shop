@extends('templates.admin.master')
@section('content')
<div class="row">
    <div class="col-md-12">
        <h2>Quản lý danh mục</h2>
    </div>
</div>
<!-- /. ROW  -->
<hr />
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
<meta name="csrf-token" content="{{ csrf_token() }}">
<script type="text/javascript">
    function message(id){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '{{route('admin.cat.check')}}',
            type: 'post',
            cache: false,
            data: {
                id_cat:id,
            },
            success: function(data){
                $('#tb').html(data);
            },
            error: function (){
                alert('Có lỗi xảy ra');
            }
        });
    }
</script>
<div id="tb">
    <div id="ajax_loader" class="ajax-load-qa"></div>  
</div>
<style type="text/css">
	.chucnang{
		margin-left: 10px;
	    background: #fc8010;
	    border-radius: 5px;
	    color: white;
	}
	.chucnang a{
		color: white;
	}
</style>
<div class="row">
    <div class="col-md-12">
        <!-- Advanced Tables -->
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="table-responsive">
                    <div class="row">
                        <div class="col-sm-6">
                            <a href="{{route('admin.cat.add')}}" class="btn btn-success btn-md">Thêm</a>
                        </div>
                        
                    </div>
                    @if(Session::has('msg'))
                        <h2>{{Session::get('msg')}}</h2>
                    @endif
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Tên</th>
                                <th width="160px">Chức năng</th>
                            </tr>
                        </thead>
                        <tbody>
              			@foreach($objItems_cha as $objItem)
              			@php
              				$id=$objItem['id_cat'];
              				$name=$objItem['namecat'];
              				$editUrl=route('admin.cat.edit',['id'=>$id]);
              				$delUrl=route('admin.cat.del',['id'=>$id]);
              			@endphp
                            <tr class=" gradeX">
                                <td>{{$id}}</td>
                                <td>
                                	{{$name}}
                                	@php menuMulti1($objItems_con,$id) @endphp
                                </td>
                                <td class="center">
                                    <a href="{{$editUrl}}" title="" class="btn btn-primary"><i class="fa fa-edit "></i> Sửa</a>
                                    <a href="javascript:void(0)" id="click" onclick="return message('{{$id}}')" class="btn btn-danger"><i class="fa fa-pencil"></i> Xóa</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table> 
                </div>
            </div>
        </div>
        <!--End Advanced Tables -->
    </div>
</div>
<script type="text/javascript">
    $('#click').click(function(){   
        $('#ajax_loader').css( 'display', 'block' );
            setTimeout(function(){
            $('#ajax_loader').css( 'display', 'none' );
        }, 20000);        
    });
</script>
@endsection