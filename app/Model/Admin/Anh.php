<?php

namespace App\Model\Admin;

use Illuminate\Database\Eloquent\Model;
use Storage;
class Anh extends Model
{
    protected $table="picture";
    protected $primaryKey="id_p";
    public $timestamps=false;
    public function getItem($id){
    	return $this->where('id_sp',$id)->orderBy('id_p','DESC')->paginate(5);
    }
    public function add($arItem){
    	return $this->insertGetId($arItem);
    }
    public function get($id){
    	return $this->findOrFail($id);
    }
    public function del($id){
    	$picture=($this->get($id))->namep;
    	if(Storage::exists('files/'.$picture)==true){
    		Storage::delete('files/'.$picture);
    	}
    	return $this->where('id_p',$id)->delete();
    }
    public function del2($id){
    	$objItems=$this->getItem($id);
    	foreach ($objItems as $key => $value) {
    		$picture=$value->namep;
    		if(Storage::exists('files/'.$picture)==true){
    			Storage::delete('files/'.$picture);
    		}
    	}
    	return $this->where('id_sp',$id)->delete();
    }
}
