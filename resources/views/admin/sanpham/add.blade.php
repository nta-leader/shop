@extends('templates.admin.master')
@section('content')
<div class="row">
    <div class="col-md-12">
        <h2>Thêm sản phẩm</h2>
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
                        <form role="form" method="post" enctype="multipart/form-data" action="{{route('admin.sanpham.add')}}">
                        	{{csrf_field()}}
                            <div class="form-group">
                                <label>Tên sản phẩm</label>
                                <input type="text" name="name" value="{!! old('name') !!}" class="form-control" />
                            </div>
                            <div class="form-group">
                                <label>Giá bán</label>
                                <input type="text" name="gia" value="{!! old('gia') !!}" class="form-control" />
                            </div>
                            <div class="form-group">
                                <label>Hệ số thuộc tính</label>
                                <input type="number" name="heso_tt" value="{!! old('heso_tt') !!}" class="form-control" />
                            </div>
                            <div class="form-group">
								<label>Chọn danh mục</label>
								<select name="id_cat" class="form-control">
									@php menuMulti($objCats) @endphp
								</select>
							</div>
							<div class="form-group">
								<label>Giảm giá(%)</label>
								<select name="giamgia" class="form-control">
									<option value="0" >Không giảm giá</option>
									@for($i=1;$i<=99;$i++)
									<option value="{{$i}}" {{ old('giamgia') == $i ? 'selected' : '' }}>{{$i}}</option>
									@endfor
								</select>
							</div>
                            <div class="form-group">
                                <label>Hình ảnh</label>
                                <input type="file" name="picture" value='file_location' />
                            </div>
                            <div class="form-group">
                                <label>Giới thiệu</label>
                                <textarea class="form-control" rows="3" name="preview_text">{!! old('preview_text') !!}</textarea>
                            </div>
                            <div class="form-group">
                                <label>Chi tiết</label>
                                <textarea class="form-control ckeditor" rows="3" name="detail_text">{!! old('detail_text') !!}</textarea>
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