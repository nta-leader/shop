@extends('templates.admin.master')
@section('content')
 <div class="row">
    <div class="col-md-12">
        <h2>Quản lý sản phẩm</h2>
    </div>
</div>
<!-- /. ROW  -->
<hr />
<div class="row">
    <div class="col-md-12">
        <!-- Advanced Tables -->
        <div class="panel panel-default">
            <div class="panel-body">
                <div id="_loc" class="table-responsive">
                    <div class="row">
                        <div class="col-sm-6" style="text-align: right;">
                           <form role="form" method="post" enctype="multipart/form-data" action="{{route('admin.sanpham.add_anh',['id'=>$id])}}">
                           	{{csrf_field()}}
                                <button class="btn btn-warning btn-sm" style="float:right">Thêm ảnh</button>
                                <input type="file"  name="picture" class="form-control input-sm" style="float:right; width: 300px;" />
                                <div style="clear:both"></div>
                            </form><br />
                        </div>
                    </div>
                    @if(Session::has('msg'))
                        <h2>{{Session::get('msg')}}</h2>
                    @endif
                    <a href="{{route('admin.sanpham.delete_anh',['id'=>$id])}}" onclick="return confirm('Bạn có muốn xóa không !')" class="btn btn-danger"><i class="fa fa-pencil"></i> Xóa toàn bộ</a>
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Anh</th>
                                <th width="160px">Chức năng</th>
                            </tr>
                        </thead>
                        <tbody id="news">
                        @foreach($objItems as $objItem)
                        @php
                            $id=$objItem->id_p;
                            $picture=$objItem->namep;
                            $urlDel=route('admin.sanpham.del_anh',['id'=>$id]);
                        @endphp
                            <tr class="gradeX">
                                <td>{{$id}}</td>
                                <td class="center">
                                    <img src="/storage/app/files/{{$picture}}" alt="" height="80px" width="100px" />
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
@endsection