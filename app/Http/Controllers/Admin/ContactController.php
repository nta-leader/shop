<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Admin\Contact;
use Mail;
class ContactController extends Controller
{
    public function index(Contact $contact){
    	$objItems=$contact->getList();
    	return view('admin.contact.index',compact('objItems'));
    }
    public function del($id,Contact $contact,Request $req){
    	if($contact->del($id)){
    		$req->session()->flash('msg','Xóa thành công !');
        	return redirect()->route('admin.contact.index');
        }else{
        	$req->session()->flash('msg','Có lỗi !');
        	return redirect()->route('admin.contact.index');
        }
    }
    public function email(Request $req,Contact $contact){
    	$id=$req->id;
        $email=$req->email;
        $chude=$req->chude;
        $noidung=$req->noidung;
        $objItem=$contact->getItem($id);
        $data=[
            'email'=>$email,
            'tieude'=>'Shop.vne -> '.$chude,
            'noidung'=>$noidung,
            'objItem'=>$objItem,
        ];
        Mail::send('admin.contact.email',$data,function($msg) use ($data){
            $msg->from('theanh.a1k12@gmail.com','Shop.vne');
            $msg->to($data['email']);
            $msg->subject($data['tieude']);
        });
        $req->session()->flash('msg','Gửi thành công !');
        return redirect()->route('admin.contact.index');
    }
    public function timkiem(Request $req,Contact $contact){
    	$key=$req->key;
    	$objItems=$contact->timkiem($key);
    	return view('admin.contact.timkiem',compact('objItems'));
    }
}
