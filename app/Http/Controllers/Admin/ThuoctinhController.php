<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Admin\Thuoctinh;
use App\Model\Admin\Cat;
use DB;
class ThuoctinhController extends Controller
{
	public function __construct(Thuoctinh $thuoctinh,Cat $cat){
		$this->thuoctinh=$thuoctinh;
        $this->cat=$cat;
	}
    public function index(){
        $objItems_tt=$this->thuoctinh->getList();
        $objItems=$this->cat->getList();
    	return view('admin.thuoctinh.index',compact('objItems_tt','objItems'));
    }
    public function add(Request $req){
    	return view('admin.thuoctinh.add',compact('req'));
    }
    public function postAdd(Request $req){
    	$parent_id=$req->parent_id;
        $id_cat=$req->id_cat;
        
        if($parent_id==0){
            $namett_cha=$req->namett_cha;
            $gia_cha=0;
            $arItem=[
                'id_cat'=>$id_cat,
                'namett'=>$namett_cha,
                'parent_id'=>$parent_id,
                'gia'=>$gia_cha
            ];
            DB::table('thuoctinh')->insertGetId($arItem);

            $Item=DB::table('thuoctinh')->where('namett',$namett_cha)->where('id_cat',$id_cat)->where('gia',0)->orderBy('id_tt','DESC')->first();
            $parent_id=$Item->id_tt;
            $namett_con=$req->namett_con;
            $gia_con=$req->gia;
            $arItem=[
                'id_cat'=>$id_cat,
                'namett'=>$namett_con,
                'parent_id'=>$parent_id,
                'gia'=>$gia_con
            ];
            
            DB::table('thuoctinh')->insertGetId($arItem);
            $req->session()->flash('msg','Thêm thành công !');
            return redirect()->route('admin.thuoctinh.index');
        }else{
            $namett_con=$req->namett_con;
            $gia=$req->gia;
                $arItem=[
                'id_cat'=>$id_cat,
                'namett'=>$namett_con,
                'parent_id'=>$parent_id,
                'gia'=>$gia
            ];
            DB::table('thuoctinh')->insertGetId($arItem);
            $req->session()->flash('msg','Thêm thành công !');
            return redirect()->route('admin.thuoctinh.index');
        }
    }

    public function edit(Request $req){
    	return view('admin.thuoctinh.edit',compact('req'));
    }
    public function postEdit(Request $req){
    	$id_tt=$req->id_tt;
        $namett=$req->namett;
        $parent_id=$req->parent_id;
        if($parent_id==0){
            $gia=0;
        }else{
            $gia=$req->gia;
        }
        $arItem=[
            'namett'=>$namett,
            'parent_id'=>$parent_id,
            'gia'=>$gia
        ];
        DB::table('thuoctinh')->where('id_tt',$id_tt)->update($arItem);
        $req->session()->flash('msg','Sửa thành công !');
        return redirect()->route('admin.thuoctinh.index');
    }
    public function del($id,Request $req,Thuoctinh $thuoctinh){
    	DB::table('thuoctinh')->where('id_tt',$id)->orWhere('parent_id',$id)->delete();
        $req->session()->flash('msg','Xóa thành công !');
        return redirect()->route('admin.thuoctinh.index');
    }
}
