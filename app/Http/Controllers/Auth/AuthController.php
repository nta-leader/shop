<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use DB;
use App\Http\Requests\Dangky;
class AuthController extends Controller
{
    public function login(){
    	return view('shop.login');
    }
    public function postlogin(Request $req){
        $data = $req->only(['username','password']);
        $username=trim($req->username);
        $password=trim($req->password);
    	if (Auth::attempt($data)) {
    		$auth=Auth::user();
    		if($auth->chucvu <= 1){
    			return redirect()->route('admin.index');
    		}else{
    			return redirect()->back()->with(['msg'=>'Đăng nhập thành công !']);
    		}
		}else{
			return redirect()->route('auth.login')->with(['msg'=>'Sai username hoặc password !']);
		}
    }
    public function dangky(){
    	return view('shop.dangky');
    }
    public function postDangky(Dangky $req){
    	$username=$req->username;
    	$password=$req->password;
    	$password2=$req->password2;
    	$fullname=$req->fullname;
    	if($password==$password2){
    		$arItem=[
    			'username'=>$username,
    			'password'=>bcrypt($password),
    			'fullname'=>$fullname,
    			'chucvu'=>2,
    		];
    		DB::table('users')->insertGetId($arItem);
    		$req->session()->flash('msg','Đăng ký thành công !');
    		return redirect()->route('auth.login');
    	}else{
    		$req->session()->flash('msg','Mật khẩu không khớp !');
    		$req->session()->flash('username',$username);
    		$req->session()->flash('fullname',$fullname);
    		return redirect()->route('auth.dangky');
    	}
    }
    public function logout(){
    	Auth::logout();
    	return redirect('/');
    }
}
