<?php

namespace App\Model\Admin;

use Illuminate\Database\Eloquent\Model;
use DB;
class Thuoctinh extends Model
{
    protected $table="thuoctinh";
    protected $primaryKey="id_tt";
    public $timestamps=false;
    public function getList(){
    	return $this->all()->toArray();
    }
    public function getItem($id){
    	return $this->findOrFail($id);
    }
    public function getCat($id){
        return $this->where('id_cat',$id)->select('id_tt')->get();
    }
    public function getList_con(){
    	return DB::table('thuoctinh as tt')->join('cat as c','tt.id_cat','=','c.id_cat')->select('tt.id_tt','c.namecat','tt.namett','tt.parent_id')->where('tt.parent_id','!=',0)->get()->toArray();
    }
    public function del($id){
        return $this->where('id_cat',$id)->delete();
    }
}
