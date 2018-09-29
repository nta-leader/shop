<?php

namespace App\Http\Controllers\Shop;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Shop\Donhang;
use App\Http\Requests\doimk;
use Auth;
use DB;
class UserController extends Controller
{
    public function index(){
    	return view('shop.user.index');
    }
    public function donhang(Donhang $donhang){
    	$username=Auth::user()->username;
        $objItems=$donhang->tracuu2($username); 
    	return view('shop.user.donhang',compact('objItems'));
    }
    public function doimk(){
    	return view('shop.user.matkhau');
    }
    public function post_doimk(doimk $req){
    	$username=Auth::user()->username;
    	$data = $req->only(['password']);
    	$data['username']=$username;
    	if (Auth::attempt($data)) {
    		if($req->password2==$req->password3){
    			$password=bcrypt($req->password2);
    			DB::table('users')->update(['password'=>$password]);
    			return redirect()->back()->with(['msg'=>'Đổi mật khẩu thành công !']);
    		}
    		return redirect()->back()->with(['msg'=>'Mật khẩu Không khớp !']);
    	}else{
    		return redirect()->back()->with(['msg'=>'Mật khẩu không đúng !']);
    	}
    }
}
