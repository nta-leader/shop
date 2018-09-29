<table class="table table-striped table-bordered table-hover" id="dataTables-example">
    <thead>
        <tr>
            <th>ID</th>
            <th>Username</th>
            <th>Nội dung</th>
            <th width="160px">Chức năng</th>
        </tr>
    </thead>
    <tbody id="news">
    @foreach($objItems as $objItem)
    @php
        $id_cm=$objItem->id_cm;
        $username=$objItem->username;
        $content=$objItem->content;
        $urlDel=route('admin.sanpham.del_cm',['id'=>$id_cm]);
    @endphp
        <tr class="gradeX">
            <td>{{$id_cm}}</td>
            <td>{{$username}}</td>
            <td class="center">
                {{$content}}
            </td>
            <td class="center">
                <center><a href="{{$urlDel}}" onclick="return confirm('Bạn có muốn xóa không !')" class="btn btn-danger">Xóa</a></center>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
<div id="ajax_loader" class="ajax-load-qa"></div>