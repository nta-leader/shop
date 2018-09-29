<?php

namespace App\Model\Admin;

use Illuminate\Database\Eloquent\Model;
use App\Model\Admin\Sanpham;
use App\Model\Admin\Thuoctinh;
class Cat extends Model
{
    protected $table="cat";
    protected $primaryKey="id_cat";
    public $timestamps=false;
    public function getList(){
    	return $this->all()->toArray();
    }
    public function getList_con(){
    	return $this->where('parent_id','!=',0)->get()->toArray();
    }
    public function getList_cha(){
    	return $this->where('parent_id',0)->get()->toArray();
    }
    public function add($arItem){
    	return $this->insertGetId($arItem);
    }
    public function edit($arItem,$id){
    	return $this->where('id_cat',$id)->update($arItem);
    }
    public function del($id){
    	$objItems=$this->getList();
    	$this->xoa($objItems,$id);
        $sanpham= new Sanpham();
        $sanpham->del_cat($id);
        
        $thuoctinh=new Thuoctinh();
        $thuoctinh->del($id);
    	return $this->where('id_cat',$id)->delete();
    }
    public function xoa($data,$parent_id){
    	foreach ($data as $value) {
    		$id_cat=$value['id_cat'];
    		if($value['parent_id']==$parent_id){
                $sanpham= new Sanpham();
                $sanpham->del_cat($id_cat);

                $thuoctinh=new Thuoctinh();
                $thuoctinh->del($id_cat);
    			$this->where('id_cat',$id_cat)->delete();

    			$this->xoa($data,$id_cat);
    		}
    	}
    }
    public function getDMC($parent_id,$data,$arItem){
        foreach ($data as $value) {
            $id_cat=$value['id_cat'];
            if($value['parent_id']==$parent_id){
                $arItem[]=$id_cat;
                $this->getDMC($id_cat,$data,$arItem);
            }
        }
        return $arItem;
    }
    public function check($parent_id,$namecat,$id_cat=0){
    	return $this->where('id_cat','!=',$id_cat)->where('parent_id',$parent_id)->where('namecat',$namecat)->count();
    }
    public function getItem($id){
    	return $this->findOrFail($id);
    }
}
