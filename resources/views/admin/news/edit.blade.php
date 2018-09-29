@extends('templates.admin.master')
@section('content')
        <div class="row">
            <div class="col-md-12">
                <h2>Sửa danh mục</h2>
            </div>
        </div>
        <!-- /. ROW  -->
        <hr />
        <div class="row">
            <div class="col-md-12">
                <!-- Form Elements -->
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-12">
                            @if(Session::has('msg'))
                                <h2>{{Session::get('msg')}}</h2>
                            @endif
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                                <form role="form" method="post" enctype="multipart/form-data" action="{{route('admin.news.postedit')}}">
                                	{{csrf_field()}}
                                @php
                                    $id=$objItem->id_new;
                                    $namenew=$objItem->namenew;
                                    $idcat=$objItem->id_cat;
                                    $gioithieu=$objItem->preview_text;
                                    $chitiet=$objItem->detail_text;
                                    $picture=$objItem->picture;
                                @endphp
                                    <div class="form-group">
                                        <label>ID</label>
                                        <input readonly type="text" value="{{$id}}" name="id" class="form-control" />
                                    </div>
                                    <div class="form-group">
                                        <label>Tên bài viết</label>
                                        <input type="text" name="name" value="{{$namenew}}" class="form-control" />
                                    </div>
                                    <div class="form-group">
                                        <img src="/storage/app/files/{{$picture}}" width="400px" />
                                    </div>
                                    <div class="form-group">
                                        <select name="check" class="form-control">
                                            <option value="0">Giữ lại hình này</option>
                                            <option value="1">Xóa hình này, upload hình mới</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Hình ảnh</label>
                                        <input type="file" name="hinhanh" />
                                    </div>
                                    <div class="form-group">
                                        <label>Mô tả</label>
                                        <textarea class="form-control" rows="3" name="gioithieu">{{$gioithieu}}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>Chi tiết</label>
                                        <textarea class="form-control ckeditor" rows="3" name="chitiet">{{$chitiet}}</textarea>
                                    </div>
                                    <button type="submit" name="submit" class="btn btn-success btn-md">Sửa</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Form Elements -->
            </div>
        </div>
@endsection