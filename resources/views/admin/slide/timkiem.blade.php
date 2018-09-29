@foreach($objItems as $objItem)
@php
    $id=$objItem->id_sp;
    $namesp=$objItem->namesp;
    $gioithieu=$objItem->preview_text;
    $picture=$objItem->picture;
    $giamgia=$objItem->giamgia;
    $gia=$objItem->gia;
    $trangthai=$objItem->slide;
@endphp
    <tr class="gradeX">
        <td>{{$id}}</td>
        <td>{{$namesp}}</td>
        <td>{{$gia}}</td>
        <td>{{$gioithieu}}</td>
        <td class="center">
            <img src="/storage/app/files/{{$picture}}" alt="" height="80px" width="100px" />
        </td>
        <td>{{$giamgia}}</td>
        <td id="active{{$id}}">
            <center>
            @if($trangthai==1)
                <a href="javascript:void(0)" onclick="active('1','#active{{$id}}','{{$id}}')" class="btn btn-primary">Hiển Thị</a>
            @elseif($trangthai==0)
                <a href="javascript:void(0)" onclick="active('0','#active{{$id}}','{{$id}}')" class="btn btn-danger">Đã ẩn</a>
            @endif
            </center>
        </td>
    </tr>
@endforeach