<?php 
function menuMulti($data,$parent_id=0,$str=""){
	foreach ($data as $value) {
		$id=$value['id_cat'];
		$name=$value['namecat'];
		if(Session::has('selected') && Session::get('selected')==$id){
			$selected='selected';
		}else{
			$selected='';
		}
		if($value['parent_id']==$parent_id){
			echo '<option '.$selected.' value="' .$id. '">'.$str.$name.'</option>';
			menuMulti($data,$id,$str.'--| ');
		}
	}
}
// admin quan lý sản phẩm
function menuMulti_sp($data,$parent_id=0,$str=""){
	foreach ($data as $value) {
		$id=$value['id_cat'];
		$name=$value['namecat'];
		if(Session::has('active_cat') && Session::get('active_cat')==$id){
			$selected='selected';
		}else{
			$selected='';
		}
		if($value['parent_id']==$parent_id){
			echo '<option '.$selected.' value="' .$id. '">'.$str.$name.'</option>';
			menuMulti_sp($data,$id,$str.'--| ');
		}
	}
}
//admin quan li danh muc
function menuMulti1($data,$parent_id){
	echo '<ul>';
	foreach ($data as $value) {
		$id=$value['id_cat'];
		$name=$value['namecat'];
		$urlEdit=route('admin.cat.edit',['id'=>$id]);
		$urlDel=route('admin.cat.del',['id'=>$id]);
		if($value['parent_id']==$parent_id){
?>
			<li><?php echo $name;?><span class="chucnang">-<a href="<?php echo $urlEdit;?>">Sửa</a> | <a onclick="message('<?php echo $id;?>')" href="javascrpit:void(0)">Xóa</a>-</span>
<?php
			menuMulti1($data,$id);
			echo'</li>';
		}
	}
	echo '</ul>';
}
//public header thanh menu
function menuMulti2($data,$parent_id=0,$ul="cat_menu"){
	echo '<ul class="'.$ul.'">';
	foreach ($data as $value) {
		$id=$value['id_cat'];
		$name=$value['namecat'];
		$text=editString($name);
		$url=route('shop.cat.index',['namecat'=>$text,'id'=>$id]);
		if($value['parent_id']==$parent_id){
			echo '<li><a href="'.$url.'">'.$name.'</a>';
			menuMulti2($data,$id,'');
			echo'</li>';
		}
	}
	echo '</ul>';
}
//public letf_bar
function menuMulti3($data,$parent_id=0){
echo '<ul class="left_bar">';
	foreach ($data as $value) {
		$id=$value['id_cat'];
		$name=$value['namecat'];
		$text=editString($name);

		$class='class="_active"';
		$class=Request::is('danh-muc/'.$text.'-'.$id) ? $class : '';
		$url=route('shop.cat.index',['namecat'=>$text,'id'=>$id]);
		if($value['parent_id']==$parent_id){
			echo '<li><a '.$class.' href="'.$url.'">'.$name.'</a>';
			menuMulti3($data,$id);
			echo'</li>';
		}
	}
	echo '</ul>';
}
function editString($text) {
	$text = str_replace(
	array(' ','&quot;','%',"/"," - ",":",'<','>','?',"#","^","`","'","=","!",":",".","..","*","&","__","- "," -","  ",',','`','“','”','"'),
	array(' ','','' ,''," "," "," ","","","",""," ",""," "," "," ","","","","",""," "," "," ",'','','','',''),
	$text);
   
	$chars = array("a","A","e","E","o","O","u","U","i","I","d", "D","y","Y");
   
	$uni[0] = array("á","à","ạ","ả","ã","â","ấ","ầ","ậ","ẩ","ẫ","ă","ắ","ằ","ặ","ẳ","ẵ");
	$uni[1] = array("Á","À","Ạ","Ả","Ã","Â","Ấ","Ầ","Ậ","Ẩ","Ẫ","Ă","Ắ","Ằ","Ặ","Ẳ","Ẵ");
	$uni[2] = array("é","è","ẹ","ẻ","ẽ","ê","ế","ề","ệ","ể","ễ");
	$uni[3] = array("É","È","Ẹ","Ẻ","Ẽ","Ê","Ế","Ề","Ệ","Ể","Ễ");
	$uni[4] = array("ó","ò","ọ","ỏ","õ","ô","ố","ồ","ộ","ổ","ỗ","ơ","ớ","ờ","ợ","ở","ỡ");
	$uni[5] = array("Ó","Ò","Ọ","Ỏ","Õ","Ô","Ố","Ồ","Ộ","Ổ","Ỗ","Ơ","Ớ","Ờ","Ợ","Ở","Ỡ");
	$uni[6] = array("ú","ù","ụ","ủ","ũ","ư","ứ","ừ","ự","ử","ữ");
	$uni[7] = array("Ú","Ù","Ụ","Ủ","Ũ","Ư","Ứ","Ừ","Ự","Ử","Ữ");
	$uni[8] = array("í","ì","ị","ỉ","ĩ");
	$uni[9] = array("Í","Ì","Ị","Ỉ","Ĩ");
	$uni[10] = array("đ");
	$uni[11] = array("Đ");
	$uni[12] = array("ý","ỳ","ỵ","ỷ","ỹ");
	$uni[13] = array("Ý","Ỳ","Ỵ","Ỷ","Ỹ");
   
	for($i=0; $i<=13; $i++) {
		$text = str_replace($uni[$i],$chars[$i],$text);
	}
	
	$text = str_replace(' ', '-', $text);
	$text = strtolower($text);
	
	return $text;
}