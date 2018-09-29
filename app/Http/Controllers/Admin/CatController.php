<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Admin\Cat;
use App\Http\Requests\addCat;
use App\Model\Admin\Sanpham;
class CatController extends Controller
{
	public function __construct(Cat $cat){
		$this->cat=$cat;
	}
    public function index(){
    	$objItems_cha=$this->cat->getList_cha();
    	$objItems_con=$this->cat->getList_con();
    	return view('admin.cat.index',compact('objItems_cha','objItems_con'));
    }
    public function add(){
    	$objItems=$this->cat->getList();
    	return view('admin.cat.add',compact('objItems'));
    }
    public function postAdd(addCat $req){
    	$parent_id=trim($req->parent_id);
    	$namecat=trim($req->namecat);
    	$count=$this->cat->check($parent_id,$namecat);
    	if($count > 0){
    		$req->session()->flash('msg','Tên danh mục bị trùng !');
    		$req->session()->flash('namecat',$namecat);
    		$req->session()->flash('selected',$parent_id);
    		return redirect()->route('admin.cat.add');
    	}
    	$arItem=[
    		'namecat'=>$namecat,
    		'parent_id'=>$parent_id
    	];
    	if($this->cat->add($arItem)){
    		$req->session()->flash('msg','Thêm danh mục thành công !');
    		return redirect()->route('admin.cat.index');
    	}else{
    		return redirect()->route('admin.cat.index');
    	}
    }
    public function edit(Request $req,$id){
    	$objItem=$this->cat->getItem($id);
    	$req->session()->flash('selected',$objItem['parent_id']);
    	return view('admin.cat.edit',compact('objItem'));
    }
    public function postEdit(addCat $req){
    	$id_cat=$req->id_cat;
    	$parent_id=trim($req->parent_id);
    	$namecat=trim($req->namecat);
    	$count=$this->cat->check($parent_id,$namecat,$id_cat);
    	if($count > 0){
    		$req->session()->flash('msg','Tên danh mục bị trùng !');
    		$req->session()->flash('namecat',$namecat);
    		$req->session()->flash('selected',$parent_id);
    		return redirect()->route('admin.cat.edit',['id'=>$id_cat]);
    	}
    	$arItem=[
    		'namecat'=>$namecat,
    		'parent_id'=>$parent_id
    	];
    	if($this->cat->edit($arItem,$id_cat)){
    		$req->session()->flash('msg','Sửa danh mục thành công !');
    		return redirect()->route('admin.cat.index');
    	}else{
    		return redirect()->route('admin.cat.index');
    	}
    }
    public function del(Request $req,$id){
    	if($this->cat->del($id)){
    		$req->session()->flash('msg','Xóa danh mục thành công !');
    		return redirect()->route('admin.cat.index');
    	}else{
    		return redirect()->route('admin.cat.index');
    	}
    }
    public function check(Request $req,Cat $cat,Sanpham $sanpham){
        $id=$req->id_cat;
        $arItem=['0'=>$id];
        $data=$cat->getList();
        $arItem=$cat->getDMC($id,$data,$arItem);
        $count=$sanpham->getList_cat($arItem);
        return view('admin.cat.check',compact('id','count'));
    }
}
