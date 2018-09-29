@include('templates.admin.header')
@include('templates.admin.left_bar')
<div id="page-wrapper">
    <div id="page-inner">
   		@yield('content')
    </div>
</div>
<!-- /. PAGE WRAPPER  -->
@include('templates.admin.footer')