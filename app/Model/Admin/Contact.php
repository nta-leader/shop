<?php

namespace App\Model\Admin;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $table="contact";
    protected $primaryKey="id_ct";
    public $timestamps=false;
    public function getList(){
    	return $this->orderBy('id_ct','DESC')->paginate(5);
    }
    public function getItem($id){
    	return $this->findOrFail($id);
    }
    public function del($id){
    	return $this->where('id_ct',$id)->delete();
    }
    public function timkiem($key){
    	return $this->where('name','like','%'.$key.'%')->orWhere('email','like','%'.$key.'%')->orWhere('phone','like','%'.$key.'%')->orWhere('message','like','%'.$key.'%')->take(20)->get();
    }
}
