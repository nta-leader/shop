<?php

namespace App\Model\Admin;

use Illuminate\Database\Eloquent\Model;

class Donhang extends Model
{
    protected $table="donhang";
    protected $primaryKey="id_dh";
    public $timestamps=false;
    public function getList(){
        return $this->orderBy('id_dh','DESC')->paginate(5);
    }
    public function getItem($id){
        return $this->findOrFail($id);
    }
    public function add($arItem){
        return $this->insertGetId($arItem);
    }
    public function timkiem($key){
        return $this->where('namesp','like','%'.$key.'%')->orWhere('email','like','%'.$key.'%')->orWhere('sdt','like','%'.$key.'%')->orderBy('id_dh','DESC')->take(15)->get();
    }
    public function del($id){
        return $this->where('id_dh',$id)->delete();
    }
}
