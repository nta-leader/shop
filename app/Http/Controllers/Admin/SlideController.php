<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Admin\Sanpham;
use DB;
class SlideController extends Controller
{
    public function index(Sanpham $sanpham){
    	$objItems=$sanpham->getSlide();
    	return view('admin.slide.index',compact('objItems'));
    }
    public function active(Request $req,Sanpham $sanpham){
    	if($req->active==0){
            DB::table('sanpham')->where('id_sp',$req->id)->update(['slide'=>1]);
        }else{
            DB::table('sanpham')->where('id_sp',$req->id)->update(['slide'=>0]);
        }
        $objItem=$sanpham->getItem($req->id);
        return view('admin.slide.active',compact('objItem'));
    }
    public function timkiem(Request $req, Sanpham $sanpham){
    	$objItems=$sanpham->timkiemSlide($req->key);
    	return view('admin.slide.timkiem',compact('objItems'));
    }
}
