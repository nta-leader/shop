<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Model\Admin\Sanpham;
use App\Model\Admin\Cat;
use App\Http\Requests\addSanpham;
use App\Http\Requests\editSanpham;
use DB;
class SanphamController extends Controller
{
    public function __construct(Sanpham $sanpham,Cat $cat){
    	$this->sanpham=$sanpham;
    	$this->cat=$cat;
    }
    public function index(Request $req){
    	if($req->session()->has('active_cat') && $req->session()->get('active_cat')!=0){
    		$parent_id=$req->session()->get('active_cat');
    		$arItem=['0'=>$parent_id];
	    	$data=$this->cat->getList();
	    	$arItem=$this->cat->getDMC($parent_id,$data,$arItem);
	    	$objItems=$this->sanpham->getList2($parent_id,$arItem);
    	}else{
    		$objItems=$this->sanpham->getList();
    	}
    	return view('admin.sanpham.index',compact('objItems'));
    }
    public function add(Request $req){
        $id_cat=$req->old('id_cat');
        $req->session()->flash('selected',$id_cat);
    	return view('admin.sanpham.add');
    }
    public function postAdd(addSanpham $req){
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $hinhanh=$req->file('picture')->store('files');
        $tmp =  explode("/", $hinhanh);
        $picture = end($tmp);
        $date=date('Y-m-d H:i:s');
    	$arItem=[
            'namesp'=>$req->name,
            'id_cat'=>$req->id_cat,
            'gia'=>$req->gia,
            'heso_tt'=>$req->heso_tt,
            'giamgia'=>$req->giamgia,
            'picture'=>$picture,
            'date'=>$date,
            'preview_text'=>$req->preview_text,
            'detail_text'=>$req->detail_text,
            'count_number'=>0,
            'active'=>0,
            'daban'=>0,
            'slide'=>0,
        ];
        if($this->sanpham->add($arItem)){
            $req->session()->flash('msg','Thêm sản phẩm thành công !');
            return redirect()->route('admin.sanpham.index');
        }else{
            $req->session()->flash('msg','Có lỗi xảy ra !');
            return redirect()->route('admin.sanpham.index');
        }
    }
    public function edit(Request $req,$id){
        $objItem=$this->sanpham->getItem($id);
        $req->session()->flash('selected',$objItem->id_cat);
    	return view('admin.sanpham.edit',compact('objItem'));
    }
    public function postEdit(editSanpham $req,$id){
        if($req->check==1){
        	$hinhanh=$req->file('picture')->store('files');
            $tmp =  explode("/", $hinhanh);
            $picture = end($tmp);
            if(Storage::exists('files/'.$req->picture_c)==true){
                Storage::delete('files/'.$req->picture_c);
            }
        }else{
            $picture=$req->picture_c;
        }
        if($this->sanpham->check($id,$req->name) > 0){
            $req->session()->flash('msg','Tên sản phẩm trùng !');
            return redirect()->route('admin.sanpham.edit',['id'=>$id]);
        }
        $arItem=[
            'namesp'=>$req->name,
            'id_cat'=>$req->id_cat,
            'gia'=>$req->gia,
            'heso_tt'=>$req->heso_tt,
            'giamgia'=>$req->giamgia,
            'picture'=>$picture,
            'preview_text'=>$req->preview_text,
            'detail_text'=>$req->detail_text,
            'count_number'=>0,
        ];
        if($this->sanpham->edit($id,$arItem)){
            $req->session()->flash('msg','Sửa sản phẩm thành công !');
            return redirect()->route('admin.sanpham.index');
        }else{
            return redirect()->route('admin.sanpham.index');
        }
    }
    public function del(Request $req,$id){
    	if($this->sanpham->del($id)){
            $req->session()->flash('msg','Xóa sản phẩm thành công !');
            return redirect()->route('admin.sanpham.index');
        }else{
            $req->session()->flash('msg','Có lỗi xảy ra !');
            return redirect()->route('admin.sanpham.index');
        }
    }
    public function active(Request $req){
        if($req->active==0){
            DB::table('sanpham')->where('id_sp',$req->id)->update(['active'=>1]);
        }else{
            DB::table('sanpham')->where('id_sp',$req->id)->update(['active'=>0]);
        }
        $objItem=$this->sanpham->getItem($req->id);
        return view('admin.sanpham.active',compact('objItem'));
    }
    public function loc(Request $req){
        if(isset($req->id_cat)){
            $req->session()->put('active_cat',$req->id_cat);
        }
        if($req->session()->has('active_cat') && $req->session()->get('active_cat')!=0){
            $parent_id=$req->session()->get('active_cat');
            $arItem=['0'=>$parent_id];
            $data=$this->cat->getList();
            $arItem=$this->cat->getDMC($parent_id,$data,$arItem);
            $objItems=$this->sanpham->getList2($parent_id,$arItem);
        }else{
            $objItems=$this->sanpham->getList();
        }
        if(isset($req->page)){
            return view('admin.sanpham.index',compact('objItems'));
        }else{
            return view('admin.sanpham.loc',compact('objItems'));
        }
    }
    public function timkiem(Request $req){
        $key=$req->key;
        if($req->session()->has('active_cat') && $req->session()->get('active_cat')!=0){
            $parent_id=$req->session()->get('active_cat');
            $arItem=['0'=>$parent_id];
            $data=$this->cat->getList();
            $arItem=$this->cat->getDMC($parent_id,$data,$arItem);
            $objItems=$this->sanpham->timkiem2($arItem,$key);
        }else{
            $objItems=$this->sanpham->timkiem($key);
        }
        return view('admin.sanpham.timkiem',compact('objItems'));
    }
}
