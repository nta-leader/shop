<?php

namespace App\Http\Controllers\Shop;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Shop\Sanpham;
use App\Model\Shop\Anh;
use App\Model\Shop\Comment;
use Auth;
class SanphamController extends Controller
{
    public function index($namesanpham, $id,Sanpham $sanpham,Anh $anh,Comment $comment){
    	$arId=explode('-',$id);
    	$id=end($arId);
    	$objItem_sp=$sanpham->getItem($id);
    	$objItems=$sanpham->getDexuat($id);
    	$objItem_anh=$anh->getList($id);
    	$objCm_cha=$comment->getList_sp_cha($id);
    	$objCm_con=$comment->getList_sp_con($id);
    	return view('shop.sanpham.index',compact('objItem_sp','objItem_anh','objCm_cha','objCm_con','objItems','id'));
    }
    public function comment(Request $req,Comment $comment){
        $auth=Auth::user();
        if(isset($auth->username)){
            $arItem=[
                'id_sp'=>$req->id_sp,
                'username'=>$auth->username,
                'parent_id'=>$req->id_cm,
                'content'=>$req->content,
            ];
            $comment->add($arItem);
            $req->session()->flash('msg','Bình luận thành công !');
        }else{
            $req->session()->flash('msg','Vui lòng đăng nhập !');
        }    
        $objCm_cha=$comment->getList_sp_cha($req->id_sp);
        $objCm_con=$comment->getList_sp_con($req->id_sp);
        $id_sp=$req->id_sp;
        return view('shop.sanpham.comment',compact('objCm_cha','objCm_con','id_sp'));
    }
}
