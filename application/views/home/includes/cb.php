<div class="container">
    <div class="row-fluid">
        <div id="sidebar" class="span3">
            <div class="widget">
                <h3 class="nav-header widget-title">Quản lý giấy xác nhận</h3>
                <ul class="nav nav-list">
                    <li><a href="<?php echo base_url(); ?>canbo/yccgxn"><i class="icon-chevron-right"></i>In giấy xác nhận</a></li>
                    <li><a href="<?php echo base_url(); ?>canbo/dsyccg"><i class="icon-chevron-right"></i>Xác nhận cấp giấy</a></li>
                </ul>
            </div><!--end .widget-->
            <div class="widget">
                <h3 class="nav-header">Chính trị đầu khóa</h3>
                <ul class="nav nav-list">
                    <li><a href="<?php echo base_url(); ?>canbo/themdiemctdk"><i class="icon-chevron-right"></i>Tạo danh sách điểm học CTĐK</a></li>
                    <li><a href="<?php echo base_url(); ?>canbo/timdiemctdk"><i class="icon-chevron-right"></i>Tìm kiếm điểm học CTĐK</a></li>
                    <li><a href="<?php echo base_url(); ?>canbo/tkdiemctdaukhoa"><i class="icon-chevron-right"></i>Thống kê điểm học CTĐK</a></li>
                </ul>
            </div><!--end .widget-->
            <div class="widget">
                <h3 class="nav-header">Quản lý sinh viên nội trú</h3>
                <ul class="nav nav-list">
                    <li><a href="<?php echo base_url(); ?>canbo/dssvnoitru"><i class="icon-chevron-right"></i>Thống kê danh sách nội trú</a></li>
                    <li><a href="<?php echo base_url(); ?>canbo/tksvnoitru"><i class="icon-chevron-right"></i>Tìm kiếm thông tin nội trú</a></li>
                    <!--<li><a href="<?php echo base_url(); ?>canbo/thongkesvnt"><i class="icon-chevron-right"></i>Thống kê SVNT</a></li>-->
                </ul>
            </div><!--end .widget-->
            <div class="widget">
                <h3 class="nav-header">Quản lý sinh viên ngoại trú</h3>
                <ul class="nav nav-list">
                    <li><a href="<?php echo base_url(); ?>canbo/themsvnt"><i class="icon-chevron-right"></i>Tạo danh sách ngoại trú</a></li>
                    <li><a href="<?php echo base_url(); ?>canbo/timkiemsvnt"><i class="icon-chevron-right"></i>Tìm kiếm thông tin ngoại trú</a></li>
                    <!--<li><a href="<?php echo base_url(); ?>canbo/thongkesvnt"><i class="icon-chevron-right"></i>Thống kê SVNT</a></li>-->
                </ul>
            </div><!--end .widget-->
            <div class="widget">
                <h3 class="nav-header">Quản lý đăng ký phòng KTX</h3>
                <ul class="nav nav-list">
                    <li><a href="<?php echo base_url(); ?>canbo/tinhtrangphongktx"><i class="icon-chevron-right"></i>Tình trạng phòng ký túc xá</a></li>
                    <!--<li><a href="<?php echo base_url(); ?>canbo/dschoduyet"><i class="icon-chevron-right"></i>Chờ duyệt</a></li> -->
                    <li><a href="<?php echo base_url(); ?>canbo/dsdkchuyenphong"><i class="icon-chevron-right"></i>Danh sách đăng ký chuyển phòng</a></li>
                </ul>
            </div><!--end .widget-->
            <?php
            if($this->my_auth->is_GiaoVien()){
            ?>
            <div class="widget">
                <h3 class="nav-header">Quản lý lớp</h3>
                <ul class="nav nav-list">
                    <li><a href="<?php echo base_url(); ?>canbo/dssinhvien"><i class="icon-chevron-right"></i>Xem danh sách sinh viên</a></li>
                    <li><a href="<?php echo base_url(); ?>canbo/diemrenluyensinhvien"><i class="icon-chevron-right"></i>Xem điểm rèn luyện</a></li>
                    <!--<li><a href="<?php echo base_url(); ?>canbo/thongkedrl"><i class="icon-chevron-right"></i>Thống kế điểm rèn luyện</a></li>-->
                </ul>
            </div><!--end .widget-->
            <?php
            }   
            ?>
            <div class="widget">
                <h3 class="nav-header">Quản lý điểm rèn luyện</h3>
                <ul class="nav nav-list">
                    <li><a href="<?php echo base_url(); ?>canbo/themdrl"><i class="icon-chevron-right"></i>Tạo danh sách điểm rèn luyện</a></li>
                    <li><a href="<?php echo base_url(); ?>canbo/timkiemdrl"><i class="icon-chevron-right"></i>Tìm kiếm điểm rèn luyện</a></li>
                    <!--<li><a href="<?php echo base_url(); ?>canbo/thongkedrl"><i class="icon-chevron-right"></i>Thống kế điểm rèn luyện</a></li>-->
                </ul>
            </div><!--end .widget-->
            <div class="widget">
                <h3 class="nav-header">Quản lý học bổng</h3>
                <ul class="nav nav-list">
                    <li><a href="<?php echo base_url(); ?>canbo/themdshb"><i class="icon-chevron-right"></i>Thêm danh sách học bổng</a></li>
                    <li><a href="<?php echo base_url(); ?>canbo/timkiemdrl"><i class="icon-chevron-right"></i>Tìm kiếm điểm rèn luyện</a></li>
                </ul>
            </div><!--end .widget-->
            <div class="widget">
                <h3 class="nav-header">Thông tin tuyển dụng</h3>
                <ul class="nav nav-list">
                    <li><a href="<?php echo base_url(); ?>canbo/thongtintuyendung"><i class="icon-chevron-right"></i>Thông tin tuyển dụng</a></li>
                    <li><a href="<?php echo base_url(); ?>canbo/themtintuyendung"><i class="icon-chevron-right"></i>Đăng tin tuyển dụng</a></li>
                </ul>
            </div><!--end .widget-->
            <div class="widget">
                <h3 class="nav-header">Thông tin phản hồi</h3>
                <ul class="nav nav-list">
                    <li><a href="<?php echo base_url(); ?>canbo/yeucausinhvien"><i class="icon-chevron-right"></i>Xem thông tin phản hồi</a></li>
                </ul>
            </div><!--end .widget-->
            <div class="widget">
                <h3 class="nav-header">Thông tin cán bộ</h3>
                <ul class="nav nav-list">
                    <li>Xin chào: <?php echo $cb_name; ?></li>
                    <li>Mã cán bộ: <?php echo $cb_id; ?></li>
                    <li><a href="canbo/changepass"><i class="icon-edit"></i>Thay đổi mật khẩu</a></li>
                    <li><a href="canbo/logout" id="btn-logout"><i class="icon-off"></i>Đăng Xuất</a></li> 
                </ul>
            </div><!--end .widget-->
        </div><!--end sidebar-->
