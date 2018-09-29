<?php

namespace App\Http\Controllers\Shop;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Shop\News;
use App\Model\Shop\Comment;
use Auth;
class NewsController extends Controller
{
    public function index(News $news){
    	$objItems=$news->getList();
    	return view('shop.news.index',compact('objItems'));
    }
    public function detail($namenew,$id,News $news,Comment $comment){
    	$arId=explode('-',$id);
    	$id=end($arId);
    	$objItem=$news->getItem($id);
    	$objItems=$news->getDexuat($id);
    	$objCm_cha=$comment->getList_news_cha($id);
    	$objCm_con=$comment->getList_news_con($id);
    	return view('shop.news.detail',compact('objItem','objItems','objCm_cha','objCm_con','id'));
    }
    public function comment(Request $req,Comment $comment){
        $auth=Auth::user();
        if(isset($auth->username)){
            $arItem=[
                'id_new'=>$req->id,
                'username'=>$auth->username,
                'parent_id'=>$req->id_cm,
                'content'=>$req->content,
            ];
            $comment->add($arItem);
            $req->session()->flash('msg','Bình luận thành công !');
        }else{
            $req->session()->flash('msg','Vui lòng đăng nhập !');
        }
        $id=$req->id;    
        $objCm_cha=$comment->getList_news_cha($id);
    	$objCm_con=$comment->getList_news_con($id);
       	return view('shop.news.comment',compact('objCm_cha','objCm_con','id'));
    }
}
