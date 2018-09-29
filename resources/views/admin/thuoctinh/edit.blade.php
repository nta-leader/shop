<form role="form" method="post" action="{{route('admin.thuoctinh.edit')}}">
	{{csrf_field()}}
	<div class="form-group">
		<label>Sửa thuộc tính</label>
	</div>
	<input style="display: none;" type="text" name="id_tt" value="{{$req->id_tt}}" class="form-control" />
	<input style="display: none;" type="text" name="parent_id" value="{{$req->parent_id}}" class="form-control" />
    <div class="form-group">
        <label>Tên thuộc tính</label>
        <input type="text" name="namett" value="{{$req->namett}}" required class="form-control" />
    </div>
    @if($req->parent_id != 0)
    <div class="form-group">
        <label>giá($)</label>
        <input type="text" name="gia" value="{{$req->gia}}" required class="form-control" />
    </div>
    @endif
    <button type="submit" name="submit" class="btn btn-success btn-md">Sửa</button>
</form>