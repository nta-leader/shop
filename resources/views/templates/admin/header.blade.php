<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
@php
    $auth=Auth::user();
    $fullname=$auth->fullname;
    $chucvu=$auth->chucvu;
@endphp
@if($chucvu > 1)
<script type="text/javascript">
    window.location.href="{{route('shop.index.index')}}";  
</script> 
@endif
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>AdminCP | VinaEnter Edu</title>
    <!-- BOOTSTRAP STYLES-->
    <link href="{{$urlAdmin}}/css/bootstrap.css" rel="stylesheet" />
    <!-- FONTAWESOME STYLES-->
    <link href="{{$urlAdmin}}/css/font-awesome.css" rel="stylesheet" />
    <!-- CUSTOM STYLES-->
    <link href="{{$urlAdmin}}/css/custom.css" rel="stylesheet" />
    <script src="{{$urlAdmin}}/js/jquery-2.1.1.min.js"></script>
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <!-- GOOGLE FONTS-->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
    <script src="{{$urlAdmin}}/sweetalert-dev.js"></script>
    <link rel="stylesheet" href="{{$urlAdmin}}/sweetalert.css">
</head>

<body>
    <div id="wrapper">
        <nav class="navbar navbar-default navbar-cls-top " role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.html">Shop.vne</a>
            </div>
            <div style="color: white;
padding: 15px 50px 5px 50px;
float: right;
font-size: 16px;"> Xin chào, <b>{{$fullname}}</b> &nbsp; <a href="{{route('auth.logout')}}" class="btn btn-danger square-btn-adjust">Đăng xuất</a> </div>
        </nav>
        <!-- /. NAV TOP  -->