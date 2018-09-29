<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Admin\Comment;
class CommentController extends Controller
{
    public function index($id,Comment $comment){
    	$objItems=$comment->getList_sp_cha($id);
    	return view('admin.sanpham.comment.index',compact('objItems','id'));
    }
    public function cm_con(Request $req,Comment $comment){
    	$parent_id=$req->id_cm;
    	$id_sp=$req->id_sp;
    	$objItems=$comment->getList_sp_con($id_sp,$parent_id);
    	return view('admin.sanpham.comment.cm',compact('objItems'));
    }
    public function del($id,Request $req,Comment $comment){
    	$id_sp=($comment->getItem($id))->id_sp;
    	if($comment->del($id)){
    		$req->session()->flash('msg','Xóa thành công !');
    		return redirect()->route('admin.sanpham.comment',['id'=>$id_sp]);
    	}
    }
    public function del_sp($id,Request $req,Comment $comment){
    	$id_sp=$id;
    	if($comment->del_sp($id_sp)){
    		$req->session()->flash('msg','Xóa thành công !');
    		return redirect()->route('admin.sanpham.comment',['id'=>$id_sp]);
    	}
    }

    //news
    public function index_news($id,Comment $comment){
        $objItems=$comment->getList_news_cha($id);
        return view('admin.news.binhluan',compact('objItems','id'));
    }
    public function cm_con_news(Request $req,Comment $comment){
        $parent_id=$req->id_cm;
        $id_new=$req->id_new;
        $objItems=$comment->getList_news_con($id_new,$parent_id);
        return view('admin.news.cm',compact('objItems'));
    }
    public function del_news($id,Request $req,Comment $comment){
        $id_new=($comment->getItem($id))->id_new;
        if($comment->del($id)){
            $req->session()->flash('msg','Xóa thành công !');
            return redirect()->route('admin.news.comment',['id'=>$id_new]);
        }
    }
    public function del_news_all($id,Request $req,Comment $comment){
        $id_new=$id;
        if($comment->del_news_all($id_new)){
            $req->session()->flash('msg','Xóa thành công !');
            return redirect()->route('admin.news.comment',['id'=>$id_new]);
        }
    }
}
