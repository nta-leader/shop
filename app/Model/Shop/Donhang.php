<?php

namespace App\Model\Shop;

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
    public function tracuu($sdt,$email){
        return $this->where('sdt',$sdt)->where('email',$email)->orderBy('id_dh','DESC')->get();
    }
    public function tracuu2($username){
        return $this->where('username',$username)->orderBy('id_dh','DESC')->get();
    }
}
