<?php

namespace App\Model\Shop;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    protected $table="news";
    protected $primaryKey="id_new";
    public $timestamps= false;
    public function getList(){
    	return $this->where('active',1)->orderBy('id_new','DESC')->paginate(9);
    }
    public function getItem($id){
    	return $this->findOrFail($id);
    }
    public function getDexuat($id){
    	return $this->where('id_new','!=',$id)->inRandomOrder()->take(3)->get();
    }
}
