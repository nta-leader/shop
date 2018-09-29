<script type="text/javascript">
swal({   
    title: "Bạn có muốn xóa danh mục này không ?",
    text: "Danh mục này có {{$count}} sản phẩm",         
    type: "warning",   
    showCancelButton: true,   
    confirmButtonColor: "#DD6B55",   
    confirmButtonText: "OK",   
    cancelButtonText: "Hủy",   
    closeOnConfirm: false,   
     }, 
    function(isConfirm){   
        if (isConfirm) {   
            window.location.href="{{route('admin.cat.del',['id'=>$id])}}";   
        }else{     
            swal("Đã hủy !", "", "error");
        } 
    }
);
</script>
<div id="ajax_loader" class="ajax-load-qa"></div>