<?php

namespace App\Http\Controllers\Shop;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
class AboutController extends Controller
{
   	public function gioithieu(){
    	$objItem=DB::table('about')->where('id',1)->first();
    	$noidung=$objItem->noidung;
    	return view('shop.about.index',compact('noidung'));
    }
    public function chinhsach(){
    	$objItem=DB::table('about')->where('id',2)->first();
    	$noidung=$objItem->noidung;
    	return view('shop.about.index',compact('noidung'));
    }
    public function huongdan(){
    	$objItem=DB::table('about')->where('id',3)->first();
    	$noidung=$objItem->noidung;
    	return view('shop.about.index',compact('noidung'));
    }
}
