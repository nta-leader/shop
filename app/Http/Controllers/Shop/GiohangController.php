<?php

namespace App\Http\Controllers\Shop;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Admin\Sanpham;
use App\Model\Admin\Thuoctinh;
use App\Model\Shop\Donhang;
use DB;
use Auth;
use Mail;
class GiohangController extends Controller
{
    public function index(Request $req){
        if($req->session()->has('giohang')==true && count($req->session()->get('giohang')) > 0){
            return view('shop.giohang.index');
        }
        $req->session()->forget('giohang');
    	return redirect()->route('shop.index.index');
    }
    public function view(Request $req,Sanpham $sanpham,Thuoctinh $thuoctinh){
        $objItems_tt=$thuoctinh->getList();
        if($req->session()->has('giohang')==true){
            $giohang=$req->session()->get('giohang');
            foreach ($giohang as $key => $value) {
                $id_sp=$value['id_sp'];
                $objItems=$sanpham->getItem_gh($id_sp);
                $giohang[$key][$value['id_sp']]=$objItems[0];
            }
        }else{
            return view('shop.giohang.null');
        }
        $req->session()->put('giohang',$giohang);
        //dd($giohang);
        return view('shop.giohang.view',compact('giohang','objItems_tt'));
    }
    public function add(Request $req){
        //dd($req->session()->get('giohang'));
        $id_sp=$req->id_sp;

        $objItem=DB::table('sanpham')->select('id_cat')->where('id_sp',$id_sp)->get()->toArray();
        $id_cat=$objItem[0]->id_cat;
        $objItem=DB::table('thuoctinh')->select('id_tt','namett')->where('id_cat',$id_cat)->where('parent_id',0)->get()->toArray();
        $thuoctinh=[];
        $thuoctinh['thuoctinh']=[];
        foreach ($objItem as $key => $value) {
            $thuoctinh['thuoctinh'][$key]['id']=$value->id_tt;
            $thuoctinh['thuoctinh'][$key]['namett']=$value->namett;
            $thuoctinh['thuoctinh'][$key]['val']=0;
            $thuoctinh['thuoctinh'][$key]['gia']=0;
        }

    	if($req->session()->has('giohang')==true){
            $giohang=$req->session()->get('giohang');
            $i=0;
            foreach ($giohang as $key => $value) {
                if($value['id_sp']!=$id_sp){
                    $i++;
                }else{
                    return view('shop.giohang.error');
                }
            }
            $giohang[]=[
                'id_sp'=>$id_sp,
                'soluong'=>1,
                'thuoctinh'=>$thuoctinh['thuoctinh']
            ];
            $req->session()->put('giohang',$giohang);
            $soluong=count($giohang);
            return view('shop.giohang.success',compact('soluong'));
    	}else{
            $giohang=[
                '0'=>[
                    'id_sp'=>$id_sp,
                    'soluong'=>1,
                    'thuoctinh'=>$thuoctinh['thuoctinh']
                ],
            ];
            $req->session()->put('giohang',$giohang);
            $soluong=1;
            return view('shop.giohang.success',compact('soluong'));
    	}
    }
    public function delete(Request $req){
        $req->session()->forget('giohang');
        return redirect()->route('shop.index.index');
    }
    public function del(Request $req,Thuoctinh $thuoctinh){
        $objItems_tt=$thuoctinh->getList();
        $id_sp=$req->id_sp;
        $giohang=$req->session()->get('giohang');

        foreach ($giohang as $key => $value) {
            if($value['id_sp']==$id_sp){
                $req->session()->forget('giohang.'.$key);
            }
        }
        $giohang=$req->session()->get('giohang');
        $soluong=count($giohang);
        return view('shop.giohang.del',compact('giohang','objItems_tt','soluong'));
    }
    public function tang(Request $req,Thuoctinh $thuoctinh){
        $objItems_tt=$thuoctinh->getList();
        $id_sp=$req->id_sp;
        $giohang=$req->session()->get('giohang');
        foreach ($giohang as $key => $value) {
            if($id_sp==$value['id_sp']){
                $giohang[$key]['soluong']=$value['soluong']+1;
            }
        }
        $req->session()->put('giohang',$giohang);
        $giohang=$req->session()->get('giohang');
        //dd($giohang);
        return view('shop.giohang.view',compact('giohang','objItems_tt'));
    }
    public function giam(Request $req,Thuoctinh $thuoctinh){
        $objItems_tt=$thuoctinh->getList();
        $id_sp=$req->id_sp;
        $giohang=$req->session()->get('giohang');
        foreach ($giohang as $key => $value) {
            if($id_sp==$value['id_sp']){
                if($value['soluong'] != 1){
                    $giohang[$key]['soluong']=$value['soluong']-1;
                }else{
                    $giohang[$key]['soluong']=1;
                }
            }
        }
        $req->session()->put('giohang',$giohang);
        $giohang=$req->session()->get('giohang');
        //dd($giohang);
        return view('shop.giohang.view',compact('giohang','objItems_tt'));
    }
    public function thuoctinh(Request $req,Thuoctinh $thuoctinh){
        $id=$req->id;
        $arId=explode('-',$id);
        $id_sp=$arId[0];
        $id_tt=$arId[1];
        $id_tt_cha=$arId[2];

        $objItems_tt=$thuoctinh->getList();
        $giohang=$req->session()->get('giohang');
        //dd($giohang);
        foreach ($giohang as $key => $value) {
            if($id_sp==$value['id_sp']){
                foreach ($value['thuoctinh'] as $so => $val) {
                    if($val['id']==$id_tt_cha){
                        $giohang[$key]['thuoctinh'][$so]['val']=$id_tt;
                        $objItems=$thuoctinh->getItem($id_tt);
                        $giohang[$key]['thuoctinh'][$so]['name']=$objItems->namett;
                        $giohang[$key]['thuoctinh'][$so]['gia']=$objItems->gia;
                    }
                }
            }
        }
        $req->session()->put('giohang',$giohang);
        $giohang=$req->session()->get('giohang');
        //dd($giohang);
        return view('shop.giohang.thuoctinh',compact('giohang','objItems_tt'));
    }
    public function thanhtoan(Request $req){
        $auth=Auth::user();
        if(isset($auth->id)){
            $username=$auth->username;
        }else{
            $username=null;
        }
        if(isset($req->hoten)==true){
            $arItem=[
                'username'=>$username,
                'hoten'=>$req->hoten,
                'sdt'=>$req->sdt,
                'email'=>$req->email,
                'diachi'=>$req->diachi,
                'ghichu'=>$req->ghichu,
            ];
        }else{
            return redirect()->route('shop.index.index');
        }
        $req->session()->put('thongtin',$arItem);
        return view('shop.giohang.thanhtoan');
    }
    public function dathang(Request $req,Donhang $donhang,Thuoctinh $data_thuoctinh,Sanpham $sanpham){
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $auth=Auth::user();
        if(isset($auth->id)){
            $username=$auth->username;
        }else{
            $username=null;
        }
        $httt=$req->httt;
        $date=date('Y-m-d H:i:s');
        $giohang=$req->session()->get('giohang');
        $thongtin=$req->session()->get('thongtin');
        $tongtien=$req->session()->get('tongtien');
        $id_sp="";$soluong="";$thuoctinh="";$gia_sp="";$namesp="";$picture="";$giamgia="";$heso_tt="";
        foreach ($giohang as $key => $value) {
            $san_pham=$sanpham->getItem($value['id_sp']);
            $daban=$san_pham->daban;
            $daban+=$value['soluong'];
            DB::table('sanpham')->where('id_sp',$san_pham->id_sp)->update(['daban'=>$daban]);

            $id_sp=trim($id_sp." {$value['id_sp']}");
            $soluong=trim($soluong." {$value['soluong']}");
            $namesp=trim($namesp."{$value[$value['id_sp']]['namesp']}-");
            $picture=trim($picture." {$value[$value['id_sp']]['picture']}");
            $gia_sp=trim($gia_sp." {$value[$value['id_sp']]['gia']}");
            $giamgia=trim($giamgia." {$value[$value['id_sp']]['giamgia']}");
            $heso_tt=trim($heso_tt." {$value[$value['id_sp']]['heso_tt']}");
            foreach ($value['thuoctinh'] as $so => $val) {
                $thuoctinh=trim($thuoctinh."{$val['namett']}:{$val['name']}( +{$val['gia']}$ )-");
            }
            if($value['thuoctinh']==[]){
                $thuoctinh= $thuoctinh.'0-';
            }

        }
        $namesp=rtrim($namesp,'-');
        $thuoctinh=rtrim($thuoctinh,'-');
        $arItem=[
            'id_sp'=>$id_sp,
            'soluong'=>$soluong,
            'username'=>$username,
            'namesp'=>$namesp,
            'picture'=>$picture,
            'gia_sp'=>$gia_sp,
            'giamgia'=>$giamgia,
            'heso_tt'=>$heso_tt,
            'thuoctinh'=>$thuoctinh,
            'tongtien'=>$tongtien,
            'hoten'=>$thongtin['hoten'],
            'sdt'=>$thongtin['sdt'],
            'email'=>$thongtin['email'],
            'diachi'=>$thongtin['diachi'],
            'ghichu'=>$thongtin['ghichu'],
            'date'=>$date,
            'httt'=>$httt,
            'trangthai'=>0,
        ];
        $objItems_tt=$data_thuoctinh->getList();
        $data=[
            'email'=>$thongtin['email'],
            'tieude'=>'Shop.vne -> Đặt hàng thành công',
            'objItem'=>$arItem,
        ];
        //dd($data);
        Mail::send('shop.giohang.email',$data,function($msg) use ($data){
            $msg->from('theanh.a1k12@gmail.com','Shop.vne');
            $msg->to($data['email']);
            $msg->subject($data['tieude']);
        });

        $donhang->add($arItem);
        $req->session()->forget('giohang');
        $req->session()->forget('thongtin');
        $req->session()->forget('tongtien');
        return view('shop.giohang.ok');
    }
    public function tinhtrang(){
        return view('shop.giohang.tinhtrang');
    }
    public function tinh_trang(Request $req,Donhang $donhang){
        $sdt=$req->sdt;
        $email=$req->email;
        $objItems=$donhang->tracuu($sdt,$email); 
        //dd($objItems);
        return view('shop.giohang.tinh_trang',compact('objItems'));
    }
}
