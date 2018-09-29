<?php

namespace App\Model\Shop;

use Illuminate\Database\Eloquent\Model;
use DB;
class Comment extends Model
{
    protected $table="comment";
    protected $primaryKey="id_cm";
    public $timestamps=false;
    public function getList_sp_cha($id){
    	return $this->where('id_sp',$id)->where('parent_id',0)->orderBy('id_cm','DESC')->get();
    }
    public function getList_sp_con($id_sp){
    	return $this->where('id_sp',$id_sp)->where('parent_id','!=',0)->orderBy('id_cm','ASC')->get();
    }
    public function add($arItem){
        return $this->insertGetId($arItem);
    }
    public function getList_news_cha($id){
        return $this->where('id_new',$id)->where('parent_id',0)->orderBy('id_cm','DESC')->get();
    }
    public function getList_news_con($id_new){
        return $this->where('id_new',$id_new)->where('parent_id','!=',0)->orderBy('id_cm','ASC')->get();
    }
}
