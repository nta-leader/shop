@extends('templates.admin.master')
@section('content')
<div class="row">
    <div class="col-md-12">
        <h2>TRANG QUẢN TRỊ VIÊN</h2>
    </div>
</div>
<!-- /. ROW  -->
<hr />
@if(Session::has('msg'))
    <h2>{{Session::get('msg')}}</h2>
@endif
<div class="row">
    <div class="col-md-4 col-sm-4 col-xs-4">
        <div class="panel panel-back noti-box">
            <span class="icon-box bg-color-green set-icon">
            <i class="fa fa-bars"></i>
        </span>
        <div class="text-box">
            <p data-toggle="dropdown" class="main-text"><a href="" title="">Quản lý thông tin</a></p>
            <ul class="dropdown-menu">
                <li><a href="">Giới Thiệu</a></li>
                <li><a href="">Chính sách</a></li>
                <li><a href="">HD mua hàng</a></li>
            </ul>
        </div>
        </div>
    </div>
    <div class="col-md-4 col-sm-4 col-xs-4">
        <div class="panel panel-back noti-box">
            <span class="icon-box bg-color-blue set-icon">
            <i class="fa fa-bell-o"></i>
        </span>
        <div class="text-box">
            <p class="main-text"><a href="{{route('admin.cat.index')}}" title="">Quản lý danh mục</a></p>
        </div>
        </div>
    </div>
    <div class="col-md-4 col-sm-4 col-xs-4">
        <div class="panel panel-back noti-box">
            <span class="icon-box bg-color-brown set-icon">
            <i class="fa fa-rocket"></i>
        </span>
        <div class="text-box">
            <p class="main-text"><a href="{{route('admin.thuoctinh.index')}}" title="">Quản lý thuộc tính</a></p>
        </div>
        </div>
    </div>


     <div class="col-md-4 col-sm-4 col-xs-4">
        <div class="panel panel-back noti-box">
            <span class="icon-box bg-color-green set-icon">
            <i class="fa fa-bars"></i>
        </span>
            <div class="text-box">
                <p class="main-text"><a href="{{route('admin.sanpham.index')}}" title="">Quản lý sản phẩm</a></p>
            </div>
        </div>
    </div>
    <div class="col-md-4 col-sm-4 col-xs-4">
        <div class="panel panel-back noti-box">
            <span class="icon-box bg-color-blue set-icon">
            <i class="fa fa-bell-o"></i>
        </span>
            <div class="text-box">
                <p class="main-text"><a href="{{route('admin.donhang.index')}}" title="">Quản lý đơn hàng</a></p>
            </div>
        </div>
    </div>
    <div class="col-md-4 col-sm-4 col-xs-4">
        <div class="panel panel-back noti-box">
            <span class="icon-box bg-color-brown set-icon">
            <i class="fa fa-rocket"></i>
        </span>
        <div class="text-box">
                <p class="main-text"><a href="{{route('admin.news.index')}}" title="">Quản lý bài viết</a></p>
            </div>
        </div>
    </div>
    <div class="col-md-4 col-sm-4 col-xs-4">
        <div class="panel panel-back noti-box">
            <span class="icon-box bg-color-green set-icon">
            <i class="fa fa-bars"></i>
        </span>
            <div class="text-box">
                <p class="main-text"><a href="{{route('admin.slide.index')}}" title="">Quản lý slide</a></p>
            </div>
        </div>
    </div>
    <div class="col-md-4 col-sm-4 col-xs-4">
        <div class="panel panel-back noti-box">
            <span class="icon-box bg-color-blue set-icon">
            <i class="fa fa-bell-o"></i>
        </span>
            <div class="text-box">
                <p class="main-text"><a href="{{route('admin.contact.index')}}" title="">Quản lý liên hệ</a></p>
            </div>
        </div>
    </div>
    <div class="col-md-4 col-sm-4 col-xs-4">
        <div class="panel panel-back noti-box">
            <span class="icon-box bg-color-brown set-icon">
            <i class="fa fa-rocket"></i>
        </span>
        <div class="text-box">
                <p class="main-text"><a href="{{route('admin.user.index')}}" title="">Quản lý đơn user</a></p>
            </div>
        </div>
    </div>
</div>
@endsection