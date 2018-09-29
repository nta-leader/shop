@if(Session::has('msg'))
	<h4 style="color: red; margin-bottom: 30px;">{{Session::get('msg')}}</h4>
@endif
<div id="form_traloi0" class="traloi">
	<input id="id0" style="display: none;" type="text" value="{{$id}}">
	<input id="id_cm0" style="display: none;" type="text" value="0">
	<input id="content0" class="input" type="" name="">
	<a onclick="comment({{$id}},0)" title="OK" style="margin-left: -177px;padding: 5px 0px;" href="javascript:void(0)" class="ok">Bình luận</a> 
</div>
<ul>
@foreach($objCm_cha as $objItem)
@php
	$id_cm=$objItem->id_cm;
	$username=$objItem->username;
	$content=$objItem->content;
@endphp	
	<li style="margin-bottom: 5px; ">
		<div class="cm_cha">
			<div class="avata">
				<img src="https://dangchuc.pro.vn/wp-content/uploads/2017/03/anh-dep-hot-girl-Na-Na-chiec-vay-trang-4.jpg" >
			</div>
			<div class="noidung">
				<div class="item">
					<p><span class="username">{{$username}}</span> {{$content}}</p>
				</div>
				<span class="nut">
					<span id="traloi{{$id_cm}}">
						<a onclick="traloi(0,{{$id_cm}})" href="javascript:void(0)">Trả lời</a>
					</span>
					<span id="xem{{$id_cm}}">
						<a onclick="view(0,{{$id_cm}})" href="javascript:void(0)">Binh luận con</a>
					</span>
				</span>
			</div>
			<div class="clr"></div>
		</div>
		<div id="form_traloi{{$id_cm}}" class="traloi" style="display: none;">
			<input id="id{{$id_cm}}" style="display: none;" type="text" value="{{$id}}">
			<input id="id_cm{{$id_cm}}" style="display: none;" type="text" value="{{$id_cm}}">
			<input id="content{{$id_cm}}" class="input" type="" name="">
			<a onclick="comment({{$id}},{{$id_cm}})" href="javascript:void(0)" class="ok">ok</a> 
		</div>
		<ul class="ul_con" id="ul_con{{$id_cm}}" style="display: none;">
		@foreach($objCm_con as $Item)
		@if($Item->parent_id==$id_cm)
		@php
			$username=$Item->username;
			$content=$Item->content;
		@endphp
			<li>
				<div class="cm_con">
					<div class="_avata">
						<img src="https://dangchuc.pro.vn/wp-content/uploads/2017/03/anh-dep-hot-girl-Na-Na-chiec-vay-trang-4.jpg" >
					</div >
					<div class="_noidung">
						<div class="item">
							<p><span class="username">{{$username}}</span> {{$content}}</p>
						</div>
					</div>
				</div>
			</li>
		@endif
		@endforeach
		</ul>
	</li>
@endforeach
</ul>