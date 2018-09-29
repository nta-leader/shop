<?php

namespace App\Model\Shop;

use Illuminate\Database\Eloquent\Model;

class Anh extends Model
{
    protected $table="picture";
    protected $primaryKey="id_p";
    public $timestamps=false;
    public function getList($id){
    	return $this->where('id_sp',$id)->get();
    }
}
