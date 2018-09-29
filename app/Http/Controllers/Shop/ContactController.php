<?php

namespace App\Http\Controllers\Shop;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Contact;
use DB;
class ContactController extends Controller
{
    public function index(){
    	return view('shop.contact.index');
    }
    public function post(Contact $req){
    	$arItem=[
    		'name'=>$req->name,
    		'email'=>$req->email,
    		'phone'=>$req->phone,
    		'message'=>$req->message,
    	];
    	DB::table('contact')->insertGetId($arItem);
    	return redirect()->back()->with(['msg'=>'Gửi thành công !']);
    }
}
