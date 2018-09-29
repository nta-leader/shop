@extends('templates.admin.master')
@section('content')
 <div class="row">
    <div class="col-md-12">
        <h2>Quản lý Slide</h2>
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
                url: '{{route('admin.slide.timkiem')}}',
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
            url: '{{route('admin.slide.active')}}',
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
                                <th>Giá</th>
                                <th>Giới thiệu</th>
                                <th>Hình ảnh</th>
                                <th>Giảm giá(%)</th>
                                <th>Trạng Thái</th>
                            </tr>
                        </thead>
                        <tbody id="news">
                        @foreach($objItems as $objItem)
                        @php
                            $id=$objItem->id_sp;
                            $namesp=$objItem->namesp;
                            $gioithieu=$objItem->preview_text;
                            $picture=$objItem->picture;
                            $giamgia=$objItem->giamgia;
                            $gia=$objItem->gia;
                            $trangthai=$objItem->slide;
                        @endphp
                            <tr class="gradeX">
                                <td>{{$id}}</td>
                                <td>{{$namesp}}</td>
                                <td>{{$gia}}</td>
                                <td>{{$gioithieu}}</td>
                                <td class="center">
                                    <img src="/storage/app/files/{{$picture}}" alt="" height="80px" width="100px" />
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