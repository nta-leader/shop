<?php
Route::namespace('Auth')->group(function(){
	Route::get('/login',[
		'uses'=>'AuthController@login',
		'as'=>'auth.login'
	]);
	Route::post('/login',[
		'uses'=>'AuthController@postLogin',
		'as'=>'auth.login'
	]);
	Route::get('/dangky',[
		'uses'=>'AuthController@dangky',
		'as'=>'auth.dangky'
	]);
	Route::post('/dangky',[
		'uses'=>'AuthController@postDangky',
		'as'=>'auth.dangky'
	]);
	Route::get('/logout',[
		'uses'=>'AuthController@logout',
		'as'=>'auth.logout'
	]);
});
Route::namespace('Shop')->group(function(){
	Route::get('/',[
		'uses'=>'IndexController@index',
		'as'=>'shop.index.index'
	]);
	Route::get('/tim-kiem',[
		'uses'=>'CatController@timkiem',
		'as'=>'shop.timkiem'
	]);
	Route::get('/about',[
		'uses'=>'AboutController@index',
		'as'=>'shop.about.index'
	]);
	Route::get('/contact',[
		'uses'=>'ContactController@index',
		'as'=>'shop.contact.index'
	]);
	Route::post('/contact',[
		'uses'=>'ContactController@post',
		'as'=>'shop.contact.post'
	]);
	Route::prefix('user')->middleware('auth')->group(function(){
		Route::get('index',[
			'uses'=>'UserController@index',
			'as'=>'shop.user.index'
		]);
		Route::get('don-hang',[
			'uses'=>'UserController@donhang',
			'as'=>'shop.user.donhang'
		]);
		Route::get('doi-mat-khau',[
			'uses'=>'UserController@doimk',
			'as'=>'shop.user.doimk'
		]);
		Route::post('doi-mat-khau',[
			'uses'=>'UserController@post_doimk',
			'as'=>'shop.user.doimk'
		]);
	});
	Route::get('/gioi-thieu',[
		'uses'=>'AboutController@gioithieu',
		'as'=>'shop.gioithieu.index'
	]);
	Route::get('/chinh-sach',[
		'uses'=>'AboutController@chinhsach',
		'as'=>'shop.chinhsach.index'
	]);
	Route::get('/huong-dan-mua-hang',[
		'uses'=>'AboutController@huongdan',
		'as'=>'shop.huongdan.index'
	]);
	//gio hang
	Route::prefix('gio-hang')->group(function(){
		Route::get('index',[
			'uses'=>'GiohangController@index',
			'as'=>'shop.giohang.index'
		]);
		Route::get('view',[
			'uses'=>'GiohangController@view',
			'as'=>'shop.giohang.view'
		]);
		Route::get('add',[
			'uses'=>'GiohangController@add',
			'as'=>'shop.giohang.add'
		]);
		Route::get('delete',[
			'uses'=>'GiohangController@delete',
			'as'=>'shop.giohang.delete'
		]);
		Route::get('del',[
			'uses'=>'GiohangController@del',
			'as'=>'shop.giohang.del'
		]);
		Route::get('tang',[
			'uses'=>'GiohangController@tang',
			'as'=>'shop.giohang.tang'
		]);
		Route::get('giam',[
			'uses'=>'GiohangController@giam',
			'as'=>'shop.giohang.giam'
		]);
		Route::get('thuoctinh',[
			'uses'=>'GiohangController@thuoctinh',
			'as'=>'shop.giohang.thuoctinh'
		]);
		Route::get('thanhtoan',[
			'uses'=>'GiohangController@thanhtoan',
			'as'=>'shop.giohang.thanhtoan'
		]);
		Route::post('dathang',[
			'uses'=>'GiohangController@dathang',
			'as'=>'shop.giohang.dathang'
		]);
		Route::get('tinhtrang',[
			'uses'=>'GiohangController@tinhtrang',
			'as'=>'shop.giohang.tinhtrang'
		]);
		Route::post('tinhtrang',[
			'uses'=>'GiohangController@tinh_trang',
			'as'=>'shop.giohang.tinh_trang'
		]);
	});
	Route::get('/news',[
		'uses'=>'NewsController@index',
		'as'=>'shop.news.index'
	]);
	Route::get('/news/{namenews}-{id}.html',[
		'uses'=>'NewsController@detail',
		'as'=>'shop.news.detail'
	]);
	Route::post('/news/comment',[
		'uses'=>'NewsController@comment',
		'as'=>'shop.news.binhluan'
	]);
	Route::prefix('danh-muc')->group(function(){
		Route::get('{namecat}-{id}',[
			'uses'=>'CatController@index',
			'as'=>'shop.cat.index'
		]);
	});
	Route::prefix('san-pham')->group(function(){
		Route::get('{namesanpham}-{id}.html',[
			'uses'=>'SanphamController@index',
			'as'=>'shop.sanpham.index'
		]);
		Route::post('comment',[
			'uses'=>'SanphamController@comment',
			'as'=>'shop.sanpham.comment'
		]);
	});
});

Route::namespace('Admin')->prefix('admincp')->middleware('auth')->group(function(){
	Route::get('/',[
		'uses'=>'IndexController@index',
		'as'=>'admin.index'
	]);	
	Route::prefix('about')->group(function(){
		Route::get('gioithieu',[
			'uses'=>'AboutController@gioithieu',
			'as'=>'admin.about.gioithieu'
		]);
		Route::post('gioithieu',[
			'uses'=>'AboutController@post_gioithieu',
			'as'=>'admin.about.gioithieu'
		]);
		Route::get('chinhsach',[
			'uses'=>'AboutController@chinhsach',
			'as'=>'admin.about.chinhsach'
		]);
		Route::post('chinhsach',[
			'uses'=>'AboutController@post_chinhsach',
			'as'=>'admin.about.chinhsach'
		]);
		Route::get('huongdan',[
			'uses'=>'AboutController@huongdan',
			'as'=>'admin.about.huongdan'
		]);
		Route::post('huongdan',[
			'uses'=>'AboutController@post_huongdan',
			'as'=>'admin.about.huongdan'
		]);
	});
	Route::prefix('cat')->group(function(){
		Route::get('index',[
			'uses'=>'CatController@index',
			'as'=>'admin.cat.index'
		]);
		Route::post('check',[
			'uses'=>'CatController@check',
			'as'=>'admin.cat.check'
		]);
		Route::get('add',[
			'uses'=>'CatController@add',
			'as'=>'admin.cat.add'
		]);
		Route::post('add',[
			'uses'=>'CatController@postAdd',
			'as'=>'admin.cat.add'
		]);
		Route::get('edit/{id}',[
			'uses'=>'CatController@edit',
			'as'=>'admin.cat.edit'
		]);
		Route::post('edit/{id}',[
			'uses'=>'CatController@postEdit',
			'as'=>'admin.cat.edit'
		]);
		Route::get('del/{id}',[
			'uses'=>'CatController@del',
			'as'=>'admin.cat.del'
		])->middleware('role:admin');
	});
	Route::prefix('thuoctinh')->group(function(){
		Route::get('index',[
			'uses'=>'ThuoctinhController@index',
			'as'=>'admin.thuoctinh.index'
		]);
		Route::get('add',[
			'uses'=>'ThuoctinhController@add',
			'as'=>'admin.thuoctinh.add'
		]);
		Route::post('add',[
			'uses'=>'ThuoctinhController@postAdd',
			'as'=>'admin.thuoctinh.add'
		]);
		Route::get('edit',[
			'uses'=>'ThuoctinhController@edit',
			'as'=>'admin.thuoctinh.edit'
		]);
		Route::post('edit',[
			'uses'=>'ThuoctinhController@postEdit',
			'as'=>'admin.thuoctinh.edit'
		]);
		Route::get('del/{id}',[
			'uses'=>'ThuoctinhController@del',
			'as'=>'admin.thuoctinh.del'
		]);
	});
	
	Route::prefix('sanpham')->group(function(){
		Route::get('index',[
			'uses'=>'SanphamController@index',
			'as'=>'admin.sanpham.index'
		]);
		Route::get('add',[
			'uses'=>'SanphamController@add',
			'as'=>'admin.sanpham.add'
		]);
		Route::post('add',[
			'uses'=>'SanphamController@postAdd',
			'as'=>'admin.sanpham.add'
		]);
		Route::get('edit/{id}',[
			'uses'=>'SanphamController@edit',
			'as'=>'admin.sanpham.edit'
		]);
		Route::post('edit/{id}',[
			'uses'=>'SanphamController@postEdit',
			'as'=>'admin.sanpham.edit'
		]);
		Route::get('del/{id}',[
			'uses'=>'SanphamController@del',
			'as'=>'admin.sanpham.del'
		])->middleware('role:admin');
		Route::post('active',[
			'uses'=>'SanphamController@active',
			'as'=>'admin.sanpham.active'
		]);
		Route::get('loc',[
			'uses'=>'SanphamController@loc',
			'as'=>'admin.sanpham.loc'
		]);
		Route::post('timkiem',[
			'uses'=>'SanphamController@timkiem',
			'as'=>'admin.sanpham.timkiem'
		]);
		Route::prefix('anh')->group(function(){
			Route::get('index/{id}',[
				'uses'=>'AnhController@index',
				'as'=>'admin.sanpham.anh'
			]);
			Route::post('add/{id}',[
				'uses'=>'AnhController@add',
				'as'=>'admin.sanpham.add_anh'
			]);
			Route::get('del/{id}',[
				'uses'=>'AnhController@del',
				'as'=>'admin.sanpham.del_anh'
			])->middleware('role:admin');
			Route::get('delete/{id}',[
				'uses'=>'AnhController@delete',
				'as'=>'admin.sanpham.delete_anh'
			])->middleware('role:admin');
		});
		Route::prefix('comment')->group(function(){
			Route::get('index/{id}',[
				'uses'=>'CommentController@index',
				'as'=>'admin.sanpham.comment'
			]);
			Route::post('index',[
				'uses'=>'CommentController@cm_con',
				'as'=>'admin.sanpham.cm_con'
			]);
			Route::get('del/{id}',[
				'uses'=>'CommentController@del',
				'as'=>'admin.sanpham.del_cm'
			])->middleware('role:admin');
			Route::get('delete/{id}',[
				'uses'=>'CommentController@del_sp',
				'as'=>'admin.sanpham.del_sp'
			])->middleware('role:admin');
		});
	});
	Route::prefix('donhang')->group(function(){
		Route::get('index',[
			'uses'=>'DonhangController@index',
			'as'=>'admin.donhang.index'
		]);
		Route::post('trangthai',[
			'uses'=>'DonhangController@trangthai',
			'as'=>'admin.donhang.trangthai'
		]);
		Route::post('view',[
			'uses'=>'DonhangController@view',
			'as'=>'admin.donhang.view'
		]);
		Route::post('email',[
			'uses'=>'DonhangController@email',
			'as'=>'admin.donhang.email'
		]);
		Route::post('timkiem',[
			'uses'=>'DonhangController@timkiem',
			'as'=>'admin.donhang.timkiem'
		]);
		Route::get('del/{id}',[
			'uses'=>'DonhangController@del',
			'as'=>'admin.donhang.del'
		])->middleware('role:admin');
	});
	Route::prefix('slide')->group(function(){
		Route::get('index',[
			'uses'=>'SlideController@index',
			'as'=>'admin.slide.index'
		]);
		Route::post('active',[
			'uses'=>'SlideController@active',
			'as'=>'admin.slide.active'
		]);
		Route::post('timkiem',[
			'uses'=>'SlideController@timkiem',
			'as'=>'admin.slide.timkiem'
		]);
	});
	Route::prefix('contact')->group(function(){
		Route::get('index',[
			'uses'=>'ContactController@index',
			'as'=>'admin.contact.index'
		]);
		Route::get('del/{id}',[
			'uses'=>'ContactController@del',
			'as'=>'admin.contact.del'
		])->middleware('role:admin');
		Route::post('email',[
			'uses'=>'ContactController@email',
			'as'=>'admin.contact.email'
		]);
		Route::post('timkiem',[
			'uses'=>'ContactController@timkiem',
			'as'=>'admin.contact.timkiem'
		]);
	});
	Route::prefix('user')->group(function(){
		Route::get('index',[
			'uses'=>'UserController@index',
			'as'=>'admin.user.index'
		])->middleware('role:admin');
		Route::post('active',[
			'uses'=>'UserController@active',
			'as'=>'admin.user.active'
		])->middleware('role:admin');
		Route::post('timkiem',[
			'uses'=>'UserController@timkiem',
			'as'=>'admin.user.timkiem'
		])->middleware('role:admin');
		Route::get('edit/{id}',[
			'uses'=>'UserController@edit',
			'as'=>'admin.user.edit'
		])->middleware('role:admin');
		Route::post('edit/{id}',[
			'uses'=>'UserController@postEdit',
			'as'=>'admin.user.edit'
		])->middleware('role:admin');
		Route::get('del/{id}',[
			'uses'=>'UserController@del',
			'as'=>'admin.user.del'
		])->middleware('role:admin');
	});
	Route::prefix('news')->group(function(){
		Route::prefix('comment')->group(function(){
			Route::get('index/{id}',[
				'uses'=>'CommentController@index_news',
				'as'=>'admin.news.comment'
			]);
			Route::post('index',[
				'uses'=>'CommentController@cm_con_news',
				'as'=>'admin.news.cm_con'
			]);
			Route::get('del/{id}',[
				'uses'=>'CommentController@del_news',
				'as'=>'admin.news.del_cm'
			])->middleware('role:admin');
			Route::get('delete/{id}',[
				'uses'=>'CommentController@del_news_all',
				'as'=>'admin.news.del_sp'
			])->middleware('role:admin');
		});
		Route::get('index',[
			'uses'=>'NewsController@index',
			'as'=>'admin.news.index'
		]);
		Route::post('active',[
			'uses'=>'NewsController@active',
			'as'=>'admin.news.active_news'
		]);
		Route::post('timkiem',[
			'uses'=>'NewsController@timkiem',
			'as'=>'admin.news.timkiem'
		]);
		Route::get('add',[
			'uses'=>'NewsController@add',
			'as'=>'admin.news.add'
		]);
		Route::post('add',[
			'uses'=>'NewsController@postAdd',
			'as'=>'admin.news.add'
		]);
		Route::get('edit/{id}',[
			'uses'=>'NewsController@edit',
			'as'=>'admin.news.edit'
		]);
		Route::post('edit',[
			'uses'=>'NewsController@postEdit',
			'as'=>'admin.news.postedit'
		]);
		Route::get('del/{id}',[
			'uses'=>'NewsController@del',
			'as'=>'admin.news.del'
		])->middleware('role:admin');
	});
});

//->middleware('role:admin');