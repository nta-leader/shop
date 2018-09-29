<?php

namespace App\Model\Admin;

use Illuminate\Database\Eloquent\Model;
use Storage;
use App\Model\Admin\Comment;
class News extends Model
{
    protected $table="news";
    protected $primaryKey="id_new";
    public $timestamps= false;
    public function getList(){
    	return $this->orderBy('id_new','DESC')->paginate(5);
    }
    public function getItem($id){
    	return $this->findOrfail($id);
    }
    public function addItem($arItem){
    	return $this->insertGetId($arItem);
    }
    public function check($id, $namemoi){
        return $this->where('id_new','!=',$id)->where('namenew',$namemoi)->count();
    }
    public function editItem($id,$arItem){
        return $this->where('id_new',$id)->update($arItem);
    }
    public function delItem($id){
        $picture=$this->getItem($id)->picture;
        if(Storage::exists('files/'.$picture)==true){
            Storage::delete('files/'.$picture);
        }
        $coment=new Comment();
        $coment->del_news($id);
        return $this->where('id_new',$id)->delete();
    }
    public function timkiem($key){
        return $this->where('namenew','like','%'.$key.'%')->orWhere('preview_text','like','%'.$key.'%')->take(20)->get();
    }
}
