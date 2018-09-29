<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Admin\User;
use Auth;
use DB;
class UserController extends Controller
{
    public function index(User $user){
    	$objItems=$user->getList();
    	return view('admin.user.index',compact('objItems'));
    }
    public function edit($id,User $user){
    	$objItem=$user->getItem($id);
    	return view('admin.user.edit',compact('objItem'));
    }
    public function postEdit($id,Request $req,User $user){
    	if($req->password != '' && $req->password2 != '' && $req->fullname != ''  && $req->password==$req->password2){
	    	$arItem=[
	    		'password'=>bcrypt($req->password),
	    		'fullname'=>$req->fullname,
	    	];
	    	$user->edit($id,$arItem);
	    	$req->session()->flash('msg','Sửa thành công !');
	    	return redirect()->route('admin.user.index');
	    }
    	if($req->password == '' && $req->password2 == '' && $req->fullname != ''){
    		$arItem=[
	    		'fullname'=>$req->fullname,
	    	];
	    	$user->edit($id,$arItem);
	    	$req->session()->flash('msg','Sửa thành công !');
    		return redirect()->route('admin.user.index');
    	}
    	if($req->password != $req->password2){
    		$req->session()->flash('msg','Mật khẩu không khớp !');
	    	return redirect()->route('admin.user.edit',['id'=>$id]);
    	}
	
    }
    public function del($id,User $user,Request $req){
    	$objItem=$user->getItem($id);
    	if($objItem->username=='admin'){
    		$req->session()->flash('msg','Không Thể xóa admin !');
    		return redirect()->route('admin.user.index');
    	}else{
    		$user->del($objItem->id);
    		$req->session()->flash('msg','Xóa thành công !');
    		return redirect()->route('admin.user.index');
    	}
    }
    public function active(Request $req,User $user){
    	if($req->active==1){
            DB::table('users')->where('id',$req->id)->update(['chucvu'=>2]);
        }elseif($req->active==2){
            DB::table('users')->where('id',$req->id)->update(['chucvu'=>1]);
        }
        $objItem=$user->getItem($req->id);
        return view('admin.user.active',compact('objItem'));
    }
    public function timkiem(Request $req,User $user){
    	$objItems=$user->timkiem($req->key);
    	return view('admin.user.timkiem',compact('objItems'));
    }
}
