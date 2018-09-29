<?php

namespace App\Http\Controllers\Shop;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Shop\Cat;
use App\Model\Shop\Sanpham;
class CatController extends Controller
{
    public function index($namecat,$id,Cat $cat,Sanpham $sanpham){
    	
    	$arText=explode('-',$id);
    	$id=end($arText);
    	$name_cat=($cat->getItem($id))->namecat;

    	$arItem=['0'=>$id];
    	$data=$cat->getList();
    	$arItem=$cat->getDMC($id,$data,$arItem);
    	
    	$objItems=$sanpham->getList_cat($arItem);
    	//dd($objItems);
    	return view('shop.cat.index',compact('objItems','name_cat'));
    }
    public function timkiem(Request $req,Sanpham $sanpham){
        $key=$req->key;
        $name_cat='Từ khóa: '.$key;
        $objItems=$sanpham->timkiem($key);
        return view('shop.cat.index',compact('objItems','name_cat'));
    }
}