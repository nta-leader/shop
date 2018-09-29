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
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    @if(Session::has('msg'))
                        <h2>{{Session::get('msg')}}</h2>
                    @endif
                    @php
                    	$id=$objItem->id_cat;
                    	$namecat=$objItem->namecat;
                    @endphp
                        <form role="form" method="post" action="{{route('admin.cat.edit',['id'=>$id])}}">
                        	{{csrf_field()}}
                        	<input style="display: none;" type="text" name="id_cat" value="{{$id}}"/>
                        	<div class="form-group">
								<label>Danh mục cha</label>
								<select name="parent_id" class="form-control">
									<option value="0">-ROOT-</option>
									@php menuMulti($objCats) @endphp
								</select>
							</div>
                            <div class="form-group">
                                <label>Tên danh mục</label>
                                <input type="text" name="namecat" value="@if(Session::has('namecat')) {{Session::get('namecat')}} @else {{$namecat}} @endif" class="form-control" />
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