<?php

namespace App\Model\Shop;

use Illuminate\Database\Eloquent\Model;
use DB;
class Sanpham extends Model
{
    protected $table="sanpham";
    protected $primaryKey="id_sp";
    public $timestamps=false;
    public function get_giamgia(){
    	return $this->where('active',1)->where('giamgia','>',0)->orderBy('id_sp','DESC')->orderBy('id_sp','DESC')->take(20)->get()->toArray();
    }
    public function get_giamgia_random($id){
    	return $this->where('active',1)->where('giamgia','>',0)->orderBy('id_sp','DESC')->inRandomOrder()->take($id)->get()->toArray();
    }
    public function getSlide(){
        return $this->where('slide',1)->inRandomOrder()->first();
    }
    public function get_muanhieu(){
    	return $this->where('active',1)->orderBy('daban','DESC')->take(20)->get()->toArray();
    }
    public function getList($arItem){
    	return DB::table('sanpham as sp')->join('cat as c','sp.id_cat','=','c.id_cat')->where('active',1)->whereIn('sp.id_cat',$arItem)->orderBy('id_sp','DESC')->get()->toArray();
    }
    public function getList_cat($arItem){
        return DB::table('sanpham as sp')->join('cat as c','sp.id_cat','=','c.id_cat')->where('active',1)->whereIn('sp.id_cat',$arItem)->orderBy('id_sp','DESC')->paginate(20);
    }
    public function getItem($id){
        return $this->findOrFail($id);
    }
    public function getDexuat($id){
        $id_cat=($this->getItem($id))->id_cat;
        return $this->where('active',1)->where('id_cat',$id_cat)->inRandomOrder()->take(20)->get();
    }
    public function timkiem($key){
        return $this->where('active',1)->where('namesp','like','%'.$key.'%')->orWhere('preview_text','like','%'.$key.'%')->orderBy('id_sp','DESC')->paginate(20);
    }
}
