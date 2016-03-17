<!DOCTYPE html>
<html>
<head>
    
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta name="description" content="Hệ Thống Quản Lý Học Sinh, Sinh Viên - Trường Cao Đẳng Công Nghệ" />
    <meta name="author" content="vnzacky39@hotmail.com" />
    <meta name="keywords" content="hệ thống quản lý, quản lý sinh viên, trường cao đẳng công nghệ" />
    <title>Hệ Thống Quản Lý Học Sinh, Sinh Viên - Trường Cao Đẳng Công Nghệ</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <base href="<?php echo base_url(); ?>" />
    <!-- Bootstrap -->
    <link href="<?php echo base_url();?>templates/css/style.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url();?>templates/css/bootstrap.css" rel="stylesheet" media="screen" />
    <link href="<?php echo base_url();?>templates/css/bootstrap-responsive.min.css" rel="stylesheet" media="screen" />
    <link href="<?php echo base_url();?>templates/css/datetimepicker.min.css" rel="stylesheet" media="screen" />
    <script src="<?php echo base_url();?>templates/js/jquery.js"></script>
    <link rel="icon" href="<?php echo base_url();?>templates/img/logo.ico" type="image/x-icon">
</head>
<body>
<div id="wrapper" class="container">
    <div id="header" class="container-fluid">
        <h3 id="logo"><a href="#"></a></h3>
    </div><!--end header-->
    
    <div class="navbar">
        <div class="navbar-inner">
            <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <div class="nav-collapse collapse">
                <ul class="nav">
                  <li class="<?php echo active_link('main'); ?>"><a href="<?php echo base_url("main"); ?>"><i class="icon-home"></i>Trang Chủ</a></li>
                  <li class="<?php echo active_link('canbo'); ?>"><a href="<?php echo base_url("canbo"); ?>"><i class="icon-briefcase"></i>Cán Bộ</a></li>
                  <li class="<?php echo active_link('sinhvien'); ?>"><a href="<?php echo base_url("sinhvien"); ?>"><i class="icon-user"></i>Sinh Viên</a></li>
                  <li class="<?php echo active_link('contact'); ?>"><a href="<?php echo base_url("contact"); ?>"><i class="icon-envelope"></i>Liên Hệ</a></li>
                </ul>
            </div><!--/.nav-collapse -->
        </div>
    </div><!--navbar-->