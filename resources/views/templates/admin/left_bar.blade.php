<nav class="navbar-default navbar-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav" id="main-menu">
            <li class="text-center">
                <img src="{{$urlAdmin}}/img/find_user.png" class="user-image img-responsive" />
            </li>
            <li>
                <a class="{{ Request::is('admin/index*') ? 'active-menu' : ''}}" href="{{route('admin.index')}}"><i class="fa fa-dashboard fa-3x"></i> Trang chủ </a>
            </li>
            <li class="">
                <a class="{{ Request::is('admin/about*') ? 'active-menu' : '' }}" href="#"><i class="fa fa-sitemap fa-3x"></i> Quản lý thông tin <span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse" style="height: 0px;">
                    <li>
                        <a href="{{route('admin.about.gioithieu')}}">Giới Thiệu</a>
                    </li>
                    <li>
                        <a href="{{route('admin.about.chinhsach')}}">Chính sách</a>
                    </li>
                    <li>
                        <a href="{{route('admin.about.huongdan')}}">HD mua hàng</a>
                    </li>
                </ul>
            </li>
            <li>
                <a class="{{ Request::is('admin/cat*') ? 'active-menu' : '' }}" href="{{route('admin.cat.index')}}"><i class="fa fa-bar-chart-o fa-3x"></i> Quản lý danh mục </a>
            </li>
            <li>
                <a class="{{ Request::is('admin/thuoctinh*') ? 'active-menu' : '' }}" href="{{route('admin.thuoctinh.index')}}"><i class="fa fa-bar-chart-o fa-3x"></i> Quản lý thuộc tính</a>
            </li>
            <li>
                <a class="{{ Request::is('admin/sanpham/*') ? 'active-menu' : ''}}" href="{{route('admin.sanpham.index')}}"><i class="fa fa-qrcode fa-3x"></i> Quản lý sản phẩm </a>
            </li>
            <li>
                <a class="{{ Request::is('admin/donhang/*') ? 'active-menu' : ''}}" href="{{route('admin.donhang.index')}}"><i class="fa fa-qrcode fa-3x"></i> Quản lý đơn hàng </a>
            </li>
            <li>
                <a class="{{ Request::is('admin/news*') ? 'active-menu' : '' }}" href="{{route('admin.news.index')}}"><i class="fa fa-desktop fa-3x"></i> Quản lý bài viết</a>
            </li>
            <li>
                <a class="{{ Request::is('admin/slide*') ? 'active-menu' : '' }}" href="{{route('admin.slide.index')}}"><i class="fa fa-desktop fa-3x"></i> Quản lý slide </a>
            </li>
            <li>
                <a class="{{ Request::is('admin/contact*') ? 'active-menu' : '' }}" href="{{route('admin.contact.index')}}"><i class="fa fa-edit fa-3x"></i> Quản lý liên hệ </a>
            </li>
            <li>
                <a class="{{ Request::is('admin/user*') ? 'active-menu' : '' }}" href="{{route('admin.user.index')}}"><i class="fa fa-table fa-3x"></i> Quản lý user</a>
            </li>
        </ul>
        
    </div>

</nav>
<!-- /. NAV SIDE  -->