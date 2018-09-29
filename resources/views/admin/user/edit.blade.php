@extends('templates.admin.master')
@section('content')
<div class="row">
    <div class="col-md-12">
        <h2>Sửa user</h2>
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
                    @php
                    	$id=$objItem->id;
                    	$username=$objItem->username;
                    	$fullname=$objItem->fullname;
                    	$chucvu=$objItem->chucvu;
                    @endphp
                        <form role="form" method="post" enctype="multipart/form-data" action="{{route('admin.user.edit',['id'=>$id])}}">
                        	{{csrf_field()}}
                            <div class="form-group">
                                <label>Username</label>
                                <input readonly="" type="text" name="username" value="{{$username}}" class="form-control" />
                            </div>
                            <div class="form-group">
                                <label>Mật khẩu</label>
                                <input type="password" name="password" value="" class="form-control" />
                            </div>
                            <div class="form-group">
                                <label>Nhập lại mật khẩu</label>
                                <input type="password" name="password2" value="" class="form-control" />
                            </div>
                            <div class="form-group">
                                <label>fullname</label>
                                <input type="text" name="fullname" value="{{$fullname}}" class="form-control" />
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