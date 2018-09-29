<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Admin\Anh;
class AnhController extends Controller
{
    public function index($id,Anh $anh){
    	$objItems=$anh->getItem($id);
    	return view('admin.sanpham.anh.index',compact('objItems','id'));
    }
    public function add($id,Request $req,Anh $anh){
    	$hinhanh=$req->file('picture')->store('files');
        $tmp =  explode("/", $hinhanh);
        $picture = end($tmp);
        $arItem=[
        	'id_sp'=>$id,
        	'namep'=>$picture
        ];
        if($anh->add($arItem)){
        	$req->session()->flash('msg','Thêm ảnh thành công !');
        	return redirect()->route('admin.sanpham.anh',['id'=>$id]);
        }else{
        	$req->session()->flash('msg','Có lỗi xảy ra !');
        	return redirect()->route('admin.sanpham.anh',['id'=>$id]);
        }
    }
    public function del($id,Request $req,Anh $anh){
    	$id_sp=($anh->get($id))->id_sp;
    	if($anh->del($id)){
        	$req->session()->flash('msg','xóa ảnh thành công !');
        	return redirect()->route('admin.sanpham.anh',['id'=>$id_sp]);
        }else{
        	$req->session()->flash('msg','Có lỗi xảy ra !');
        	return redirect()->route('admin.sanpham.anh',['id'=>$id_sp]);
        }
    }
    public function delete($id,Request $req,Anh $anh){
    	if($anh->del2($id)){
        	$req->session()->flash('msg','xóa ảnh thành công !');
        	return redirect()->route('admin.sanpham.anh',['id'=>$id]);
        }else{
        	$req->session()->flash('msg','Có lỗi xảy ra !');
        	return redirect()->route('admin.sanpham.anh',['id'=>$id]);
        }
    }
}
