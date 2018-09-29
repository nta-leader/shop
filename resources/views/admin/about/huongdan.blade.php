@extends('templates.admin.master')
@section('content')
<div class="row">
    <div class="col-md-12">
        <h2>Quản lý hướng dẫn</h2>
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
                        <form role="form" method="post" enctype="multipart/form-data" action="{{route('admin.about.huongdan')}}">
                        	{{csrf_field()}}
                            <div class="form-group">
                                <textarea class="form-control ckeditor"  name="noidung">{{$noidung}}</textarea>
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