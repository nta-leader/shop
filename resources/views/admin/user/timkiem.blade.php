@foreach($objItems as $objItem)
@php
	$id=$objItem->id;
	$username=$objItem->username;
	$fullname=$objItem->fullname;
	$chucvu=$objItem->chucvu;
	$urlEdit=route('admin.user.edit',['id'=>$id]);
    $urlDel=route('admin.user.del',['id'=>$id]);
@endphp
    <tr class="gradeX">
        <td>{{$id}}</td>
        <td>{{$username}}</td>
        <td>{{$fullname}}</td>
        <td id="active{{$id}}">
            <center>
            @if($chucvu==0)
                <a href="javascript:void(0)" class="btn btn-danger" >Admin</a>
            @elseif($chucvu==1)
                <a href="javascript:void(0)" onclick="active('1','#active{{$id}}','{{$id}}')" class="btn btn-primary" >Mod</a>
            @elseif($chucvu==2)
                <a href="javascript:void(0)" onclick="active('2','#active{{$id}}','{{$id}}')" class="btn btn-success btn-md">Thành viên</a>    
            @endif
            </center>
        </td>
        <td class="center">
            <center>
            <a href="{{$urlEdit}}" class="btn btn-primary"><i class="fa fa-edit "></i> Sửa</a>
            <a href="{{$urlDel}}" onclick="return confirm('Bạn có muốn xóa không !')" class="btn btn-danger"><i class="fa fa-pencil"></i> Xóa</a>
            </center>
            <br>
        </td>
    </tr>
@endforeach