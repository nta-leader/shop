<?php

namespace App\Model\Shop;

use Illuminate\Database\Eloquent\Model;

class Cat extends Model
{
    protected $table="cat";
    protected $primaryKey="id_cat";
    public $timestamps=false;
    public function getList(){
    	return $this->all()->toArray();
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
    public function getItem($id){
    	return $this->findOrFail($id);
    }
}
