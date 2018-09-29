<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
class AboutController extends Controller
{
    public function gioithieu(){
    	$objItem=DB::table('about')->where('id',1)->first();
    	$noidung=$objItem->noidung;
    	return view('admin.about.gioithieu',compact('noidung'));
    }
    public function post_gioithieu(Request $req){
    	$noidung=$req->noidung;
   		if($noidung==''){
   			return redirect()->back()->with(['msg'=>'Không được để rỗng !']);
   		}
   		DB::table('about')->where('id','=','1')->update(['noidung'=>$noidung]);
    	return redirect()->route('admin.about.gioithieu')->with(['msg'=>'Sửa thành công !']);
    }

    public function chinhsach(){
    	$objItem=DB::table('about')->where('id',2)->first();
    	$noidung=$objItem->noidung;
    	return view('admin.about.chinhsach',compact('noidung'));
    }
    public function post_chinhsach(Request $req){
		$noidung=$req->noidung;
   		if($noidung==''){
   			return redirect()->back()->with(['msg'=>'Không được để rỗng !']);
   		}
   		DB::table('about')->where('id','=','2')->update(['noidung'=>$noidung]);
    	return redirect()->route('admin.about.chinhsach')->with(['msg'=>'Sửa thành công !']);
    }

    public function huongdan(){
    	$objItem=DB::table('about')->where('id',3)->first();
    	$noidung=$objItem->noidung;
    	return view('admin.about.huongdan',compact('noidung'));
    }
    public function post_huongdan(Request $req){
    	$noidung=$req->noidung;
   		if($noidung==''){
   			return redirect()->back()->with(['msg'=>'Không được để rỗng !']);
   		}
   		DB::table('about')->where('id','=','3')->update(['noidung'=>$noidung]);
    	return redirect()->route('admin.about.huongdan')->with(['msg'=>'Sửa thành công !']);
    }
}
