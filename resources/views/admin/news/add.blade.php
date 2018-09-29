@extends('templates.admin.master')
@section('content')
        <div class="row">
            <div class="col-md-12">
                <h2>Thêm bài viết</h2>
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
                                <form role="form" method="post" enctype="multipart/form-data" action="{{route('admin.news.add')}}">
                                	{{csrf_field()}}
                                    <div class="form-group">
                                        <label>Tên bài viết</label>
                                        <input type="text" name="name" value="{!! old('name') !!}"  class="form-control" />
                                    </div>
                                    <div class="form-group">
                                        <label>Hình ảnh</label>
                                        <input type="file" name="hinhanh" />
                                    </div>
                                    <div class="form-group">
                                        <label>Giới thiệu</label>
                                        <textarea class="form-control" rows="3" name="gioithieu">{!! old('gioithieu') !!}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>Chi tiết</label>
                                        <textarea class="form-control ckeditor" rows="3" name="chitiet">{!! old('chitiet') !!}</textarea>
                                    </div>
                                   <button type="submit" name="submit" class="btn btn-success btn-md">Thêm</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Form Elements -->
            </div>
        </div>
@endsection