<?php

namespace App\Model\Admin;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table="comment";
    protected $primaryKey="id_cm";
    public $timestamps=false;
    public function getList_sp_cha($id){
    	return $this->where('id_sp',$id)->where('parent_id',0)->orderBy('id_cm','DESC')->paginate(10);
    }
    public function getList_sp_con($id_sp,$parent_id){
    	return $this->where('id_sp',$id_sp)->where('parent_id',$parent_id)->orderBy('id_cm','ASC')->get();
    }
    public function del_sp($id){
    	return $this->where('id_sp',$id)->delete();
    }

    //dung chung
    public function del($id){
        return $this->where('id_cm',$id)->orWhere('parent_id',$id)->delete();
    }
    public function getItem($id){
        return $this->findOrFail($id);
    }
    //news
    
    public function getList_news_cha($id){
        return $this->where('id_new',$id)->where('parent_id',0)->orderBy('id_cm','DESC')->paginate(10);
    }
    public function getList_news_con($id_sp,$parent_id){
        return $this->where('id_new',$id_sp)->where('parent_id',$parent_id)->orderBy('id_cm','ASC')->get();
    }
    public function del_news($id){
        return $this->where('id_new',$id)->delete();
    }
}
