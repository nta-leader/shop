@extends('templates.admin.master')
@section('content')
<div class="row">
    <div class="col-md-12">
        <h2>Quản lý thuộc tính</h2>
    </div>
</div>
<!-- /. ROW  -->
<hr />
<script type="text/javascript">
function message(url,soluong=0){
    swal({   
        title: "Bạn có muốn thuộc tính này không ?",        
        type: "warning",   
        showCancelButton: true,   
        confirmButtonColor: "#DD6B55",   
        confirmButtonText: "OK",   
        cancelButtonText: "Hủy",   
        closeOnConfirm: false,   
         }, 
        function(isConfirm){   
            if (isConfirm) {   
                window.location.href=url;   
            }else{     
                swal("Đã hủy !", "", "error");
            } 
        }
    );
}
function them(id_cat,parent_id){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '{{route('admin.thuoctinh.add')}}',
            type: 'get',
            cache: false,
            data: {
                parent_id:parent_id,
                id_cat:id_cat,
            },
            success: function(data){
                $('#_form').html(data);
            },
            error: function (){
                alert('Có lỗi xảy ra');
            }
        });
        
    return false;
    }
function sua(id_tt,parent_id,namett,gia){
        $.ajax({
            url: '{{route('admin.thuoctinh.edit')}}',
            type: 'get',
            cache: false,
            data: {
                namett:namett,
                id_tt:id_tt,
                parent_id:parent_id,
                gia:gia,
            },
            success: function(data){
                $('#_form').html(data);
            },
            error: function (){
                alert('Có lỗi xảy ra');
            }
        });
    return false;
    }
</script>
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
                        
                    </div>
                    @if(Session::has('msg'))
                        <h2>{{Session::get('msg')}}</h2>
                    @endif
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Danh mục</th>
                                <th>Thuộc tính</th>
                            </tr>
                        </thead>
                        <tbody>
              			@foreach($objItems as $objItem)
              			@php
              				$id_cat=$objItem['id_cat'];
              				$namecat=$objItem['namecat'];
              			@endphp
                            <tr class=" gradeX">
                                <td>{{$id_cat}}</td>
                                <td>{{$namecat}}</td>
                                <td>
                                    <ul>
                                        <span class="chucnang">
                                            -<a onclick="them('{{$id_cat}}','0')" href="javascrpit:void(0)" title="Đăng nhập" data-toggle="modal" data-target="#thuoctinh">Thêm</a>-
                                        </span>
                                    @foreach($objItems_tt as $Item)
                                        @if($id_cat==$Item['id_cat'] && $Item['parent_id']==0)
                                            @php $urlDel=route('admin.thuoctinh.del',['id'=>$Item['id_tt']]); @endphp
                                            <li>
                                                {{$Item['namett']}}
                                                <span class="chucnang">
                                                    -<a onclick="them('{{$id_cat}}','{{$Item['id_tt']}}')" href="javascrpit:void(0)" data-toggle="modal" data-target="#thuoctinh">Thêm</a> | 
                                                    <a onclick="sua('{{$Item['id_tt']}}','{{$Item['parent_id']}}','{{$Item['namett']}}','{{$Item['gia']}}')" href="javascrpit:void(0)" data-toggle="modal" data-target="#thuoctinh">Sửa</a> | 
                                                    <a onclick="message('{{$urlDel}}')" href="javascrpit:void(0)">Xóa</a>-
                                                </span>
                                                <ul>
                                                    @foreach($objItems_tt as $Item2)
                                                        @php $urlDel2=route('admin.thuoctinh.del',['id'=>$Item2['id_tt']]); @endphp
                                                        @if($Item2['parent_id']==$Item['id_tt'])
                                                            <li>
                                                                {{$Item2['namett']}}
                                                                <span class="chucnang">-<a onclick="sua('{{$Item2['id_tt']}}','{{$Item2['parent_id']}}','{{$Item2['namett']}}','{{$Item2['gia']}}')" href="javascrpit:void(0)" title="Đăng nhập" data-toggle="modal" data-target="#thuoctinh">Sửa</a> | <a onclick="message('{{$urlDel2}}')" href="javascrpit:void(0)">Xóa</a>-</span>
                                                                <ul>
                                                                    <li>Giá: {{$Item2['gia']}}$</li>
                                                                </ul>
                                                            </li>
                                                        @endif
                                                    @endforeach
                                                </ul>
                                            </li>
                                        @endif
                                    @endforeach
                                    </ul>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <div class="modal fade" id="thuoctinh" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
                        <div class="modal-dialog" role="document">
                            <div id="dang-nhap" class="modal-content">
                                <div class="modal-body">
                                    <div id="_form">
                                        <h2>hello</h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
 
                </div>
            </div>
        </div>
        <!--End Advanced Tables -->
    </div>
</div>
@endsection