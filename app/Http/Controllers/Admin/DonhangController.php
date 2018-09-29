<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Admin\Donhang;
use DB;
use Mail;
class DonhangController extends Controller
{
    public function index(Donhang $donhang){
    	$objItems=$donhang->getList();
    	return view('admin.donhang.index',compact('objItems'));
    }
    public function trangthai(Request $req){
    	$id_dh=$req->id_dh;
    	$active=$req->active;
    	if($active < 3){
    		$active+=1;
    	}
    	DB::table('donhang')->where('id_dh',$id_dh)->update(['trangthai'=>$active]);
    	return view('admin.donhang.trangthai',compact('id_dh','active'));
    }
    public function view(Request $req,Donhang $donhang){
    	$id_dh=$req->id_dh;
    	$objItem=$donhang->getItem($id_dh);
    	return view('admin.donhang.view',compact('objItem'));
    }
    public function email(Request $req,Donhang $donhang){
        $id_dh=$req->id_dh;
        $email=$req->email;
        $chude=$req->chude;
        $noidung=$req->noidung;
        $objItem=$donhang->getItem($id_dh);
        $data=[
            'email'=>$email,
            'tieude'=>'Shop.vne -> '.$chude,
            'noidung'=>$noidung,
            'objItem'=>$objItem,
        ];
        //dd($data);
        Mail::send('admin.donhang.email',$data,function($msg) use ($data){
            $msg->from('theanh.a1k12@gmail.com','Shop.vne');
            $msg->to($data['email']);
            $msg->subject($data['tieude']);
        });
        $req->session()->flash('msg','Gửi thành công !');
        return redirect()->route('admin.donhang.index');
    }
    public function timkiem(Request $req,Donhang $donhang){
        $key=$req->key;
        $objItems=$donhang->timkiem($key);
        return view('admin.donhang.timkiem',compact('objItems'));    
    }
    public function del($id,Request $req,Donhang $donhang){
        if($donhang->del($id)){
            $req->session()->flash('msg','Xoá thành công !');
            return redirect()->route('admin.donhang.index');
        }else{
            $req->session()->flash('msg','Có lỗi !');
            return redirect()->route('admin.donhang.index');
        }
    }
}
