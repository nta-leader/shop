@foreach($objItems as $objItem)
@php
	$id=$objItem->id_ct;
	$name=$objItem->name;
	$email=$objItem->email;
	$phone=$objItem->phone;
	$message=$objItem->message;
    $urlDel=route('admin.contact.del',['id'=>$id]);
@endphp
    <tr class="gradeX">
        <td>{{$id}}</td>
        <td>
        {{$name}}
        </td>
        <td>{{$email}}</td>
        <td>{{$phone}}</td>
        <td>{{$message}}</td>
        <td class="center">
            <center>
            <a href="{{$urlDel}}" onclick="return confirm('Bạn có muốn xóa không !')" class="btn btn-danger"><i class="fa fa-pencil"></i> Xóa</a>
            </center>
            <br>
            <center>
                <a href="javascript:void(0)" onclick="email('{{$id}}','{{$email}}')" class="btn btn-primary" data-toggle="modal" data-target="#modal-login2">Gửi mail</a>
            </center>
        </td>
    </tr>
@endforeach