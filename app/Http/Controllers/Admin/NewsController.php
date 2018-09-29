<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\addNews;
use App\Http\Requests\editNews;
use App\Model\Admin\News;
use Storage;
use DB;
class NewsController extends Controller
{
    public function __construct(News $News){
        $this->News=$News;
    }
    public function index(){
    	$objItems=$this->News->getList();
    	return view('admin.news.index',compact('objItems'));
    }
    public function add(){
    	return view('admin.news.add');
    }
    public function postAdd(addNews $req){
    	$hinhanh=$req->file('hinhanh')->store('files');
        $tmp =  explode("/", $hinhanh);
        $picture = end($tmp);
        $namenew=$req->name;
        $gioithieu=$req->gioithieu;
        $chitiet=$req->chitiet;
        $arItem=array(
            'namenew'=>$namenew,
            'picture'=>$picture,
            'preview_text'=>$gioithieu,
            'detail_text'=>$chitiet,
            'active'=>'0',
            'count_number'=>'0',
        );
        if($this->News->addItem($arItem)){
            $req->session()->flash('msg','Thêm thành công !');
            return redirect()->route('admin.news.index');
        }else{
            $req->session()->flash('msg','Có lỗi xảy ra !');
            return redirect()->route('admin.news.index');
        }
    }
    public function edit($id){
        $objItem=$this->News->getItem($id);
    	return view('admin.news.edit',compact('objItem'));
    }
    public function postEdit(editNews $req){
        $id=$req->id;
        $objItem=$this->News->getItem($id);
        $namecu=$objItem->name;
    	$namemoi=trim($req->name);
        $count=$this->News->check($id,$namemoi);
        if($count > 0){
            $req->session()->flash('msg','Tên bài viết đã tồn tại !');
            return redirect()->route('admin.news.edit',['id'=>$id]);
        }
        $id_cat=$req->danhmuc;
        $gioithieu=trim($req->gioithieu);
        $chitiet=trim($req->chitiet);
        if($req->check==0){
            $picture=$objItem->picture;
        }else{
            $picture=$req->file('hinhanh')->store('files');
            $tmp=explode('/',$picture);
            $picture=end($tmp);
            if(Storage::exists('files/'.$objItem->picture)==true){
                Storage::delete('files/'.$objItem->picture);
            }
        }
        $arItem=array(
            'namenew'=>$namemoi,
            'preview_text'=>$gioithieu,
            'detail_text'=>$chitiet,
            'picture'=>$picture,
        );
        if($this->News->editItem($id,$arItem)){
            $req->session()->flash('msg','Sửa thành công !');
            return redirect()->route('admin.news.index');
        }else{
            return redirect()->route('admin.news.index');
        }
    }
    public function del($id,Request $req){
        if($this->News->delItem($id)){
            $req->session()->flash('msg','Xóa thành công !');
            return redirect()->route('admin.news.index');
        }else{
            $req->session()->flash('msg','Có lỗi xảy ra !');
            return redirect()->route('admin.news.index');
        }
    }
    public function active(Request $req){
        if($req->active==0){
            DB::table('news')->where('id_new',$req->id)->update(['active'=>1]);
        }else{
            DB::table('news')->where('id_new',$req->id)->update(['active'=>0]);
        }
        $objItem=$this->News->getItem($req->id);
        return view('admin.news.active',compact('objItem'));
    }
    public function timkiem(Request $req){
        $objItems=$this->News->timkiem($req->key);
        return view('admin.news.timkiem',compact('objItems'));
    }
}
