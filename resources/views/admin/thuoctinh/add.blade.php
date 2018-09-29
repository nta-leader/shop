@php 
	$cha="name=namett_cha";
	$con="name=namett_con";
@endphp
<form role="form" method="post" action="{{route('admin.thuoctinh.add')}}">
	{{csrf_field()}}
	<div class="form-group">
		<label>Thêm thuộc tính</label>
	</div>
	<input style="display: none;" type="text" name="parent_id" value="{{$req->parent_id}}" class="form-control" />
	<input style="display: none;" type="text" name="id_cat" value="{{$req->id_cat}}" class="form-control" />
    <div class="form-group">
        <label>@if($req->parent_id==0) Thuộc tính cha @else Thuộc tính con @endif</label>
        <input type="text" @if($req->parent_id==0) {{$cha}} @else {{$con}} @endif value="" required class="form-control" />
    </div>
    @if($req->parent_id==0)
    	<div class="form-group">
        <label>Tên thuộc tính con</label>
        <input type="text" name="namett_con" value="" required class="form-control" />
    </div>
 	@endif
    <div class="form-group">
        <label>giá($)</label>
        <input type="text" name="gia" value="" required class="form-control" />
    </div>
    <button type="submit" name="submit" class="btn btn-success btn-md">Thêm</button>
</form>