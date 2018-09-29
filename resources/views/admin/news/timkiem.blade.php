@foreach($objItems as $objItem)
@php
    $id=$objItem->id_new;
    $namenew=$objItem->namenew;
    $gioithieu=$objItem->preview_text;
    $picture=$objItem->picture;
    $trangthai=$objItem->active;
    $urlBinhluan=route('admin.news.comment',['id'=>$id]);
    $urlEdit=route('admin.news.edit',['id'=>$id]);
    $urlDel=route('admin.news.del',['id'=>$id]);
@endphp
    <tr class="gradeX">
        <td>{{$id}}</td>
        <td><a href="{{$urlBinhluan}}" title="Xem bình luận">{{$namenew}}</a></td>
        <td>{!!$gioithieu!!}</td>
        <td class="center">
            <img src="/storage/app/files/{{$picture}}" alt="" height="80px" width="100px" />
        </td>
        <td id="active{{$id}}">
            <center>
            @if($trangthai==1)
                <a href="javascript:void(0)" onclick="active('1','#active{{$id}}','{{$id}}')" class="btn btn-primary">Hiển Thị</a>
            @elseif($trangthai==0)
                <a href="javascript:void(0)" onclick="active('0','#active{{$id}}','{{$id}}')" class="btn btn-danger">Đã ẩn</a>
            @endif
            </center>
        </td>
        <td class="center">
            <a href="{{$urlEdit}}" class="btn btn-primary"><i class="fa fa-edit "></i> Sửa</a>
            <a href="{{$urlDel}}" onclick="return confirm('Bạn có muốn xóa không !')" class="btn btn-danger"><i class="fa fa-pencil"></i> Xóa</a>
        </td>
    </tr>
@endforeach