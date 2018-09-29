<?php

namespace App\Http\Controllers\Shop;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Shop\Sanpham;
use App\Model\Admin\Cat;
class IndexController extends Controller
{
    public  function index(Sanpham $sanpham,Cat $cat){
    	$objItems_giamgia=$sanpham->get_giamgia();
    	$random_giamgia=$sanpham->get_giamgia_random(5);
    	$objItems_muanhieu=$sanpham->get_muanhieu();
    	$objCats=$cat->getList_cha();
    	$objItems=[];
    	foreach ($objCats as $key => $value) {
    		$objItems[$value['id_cat']]['namecat']=$value['namecat'];

    		$arItem=['0'=>$value['id_cat']];
	    	$data=$cat->getList();
	    	$arItem=$cat->getDMC($value['id_cat'],$data,$arItem);
	    	$objSanpham=$sanpham->getList($arItem);

    		$objItems[$value['id_cat']]['sanpham']=$objSanpham;
    	}
    	$slide=$sanpham->getSlide();
    	return view('shop.index.index',compact('objItems_giamgia','random_giamgia','objItems_muanhieu','objItems','slide'));
    }
}
