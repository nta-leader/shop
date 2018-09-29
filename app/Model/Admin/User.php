<?php

namespace App\Model\Admin;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table="users";
    protected $primaryKey="id";
    public $timestamps=false;
    public function getList(){
    	return $this->orderBy('chucvu','ASC')->paginate(5);
    }
    public function getItem($id){
    	return $this->findOrFail($id);
    }
    public function edit($id,$arItem){
    	return $this->where('id',$id)->update($arItem);
    }
    public function del($id){
        return $this->where('id',$id)->delete();
    }
    public function timkiem($key){
        return $this->where('username','like','%'.$key.'%')->orWhere('fullname','like','%'.$key.'%')->take(20)->get();
    }
}
