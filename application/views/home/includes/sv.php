<div class="container">
    <div class="row-fluid">
        <div id="sidebar" class="span3">
            <div class="widget">
                <h3 class="nav-header widget-title">Quản lý giấy xác nhận</h3>
                <ul class="nav nav-list">
                    <li><a href="<?php echo base_url(); ?>sinhvien/yeucaucapgiay"><i class="icon-chevron-right"></i>Gửi Yêu cầu cấp giấy</a></li>
                    <li><a href="<?php echo base_url(); ?>sinhvien/dsyeucau"><i class="icon-chevron-right"></i>Xem danh sách yêu cầu</a></li>
                </ul>
            </div><!--end .widget-->
            <div class="widget">
                <h3 class="nav-header">Quản lý thông tin phòng KTX</h3>
                <ul class="nav nav-list">
                    <li><a href="<?php echo base_url(); ?>sinhvien/dsPhongTrong"><i class="icon-chevron-right"></i>Đăng ký phòng ký túc xá</a></li>
                    <li><a href="<?php echo base_url(); ?>sinhvien/lsDkPhong"><i class="icon-chevron-right"></i>Xem lịch sử đăng ký</a></li>
                    <li><a href="<?php echo base_url(); ?>sinhvien/chuyenPhong"><i class="icon-chevron-right"></i>Chuyển phòng</a></li>
                </ul>
            </div><!--end .widget-->
            <div class="widget">
                <h3 class="nav-header">Quản lý thông tin ngoại trú</h3>
                <ul class="nav nav-list">
                    <li><a href="<?php echo base_url(); ?>sinhvien/addngoaitru"><i class="icon-chevron-right"></i>Thêm địa chỉ ngoại trú</a></li>
                    <li><a href="<?php echo base_url(); ?>sinhvien/dsngoaitru"><i class="icon-chevron-right"></i>Xem danh sách địa chỉ ngoại trú</a></li>
                </ul>
            </div><!--end .widget-->
            <div class="widget">
                <h3 class="nav-header">Quản lý điểm rèn luyện</h3>
                <ul class="nav nav-list">
                    <li><a href="<?php echo base_url(); ?>sinhvien/xemdrl"><i class="icon-chevron-right"></i>Xem thông tin điểm rèn luyện</a></li>
                </ul>
            </div><!--end .widget-->
            <div class="widget">
                <h3 class="nav-header">Phản hồi - Đóng góp ý kiến</h3>
                <ul class="nav nav-list">
                    <li><a href="<?php echo base_url(); ?>sinhvien/sinhvienphanhoi"><i class="icon-chevron-right"></i>Phản hồi - đóng góp ý kiến</a></li>
                    <li><a href="<?php echo base_url(); ?>sinhvien/phanhoicuasinhvien"><i class="icon-chevron-right"></i>Phản hồi của bạn</a></li>
                </ul>
            </div><!--end .widget-->
            <div class="widget">
                <h3 class="nav-header">Thông Tin Khác</h3>
                <ul class="nav nav-list">
                    <li><a href="<?php echo base_url(); ?>sinhvien/xemhocbong"><i class="icon-chevron-right"></i>Xem thông tin học bổng</a></li>
                    <li><a href="<?php echo base_url(); ?>sinhvien/xemcohoivieclam"><i class="icon-chevron-right"></i>Xem cơ hội việc làm</a></li>
                </ul>
            </div><!--end .widget-->
            <div class="widget">
                <h3 class="nav-header">Thông tin sinh viên</h3>
                <ul class="nav nav-list">
                    <li>Xin chào: <?php echo $sv_name; ?></li>
                    <li>Mã sinh viên: <?php echo $sv_id; ?></li>
                    <li><a href="<?php echo base_url(); ?>sinhvien/updateinfo"><i class="icon-edit"></i>Cập nhật thông tin</a></li>
                    <li><a href="<?php echo base_url(); ?>sinhvien/doituong"><i class="icon-edit"></i>Cập nhật đối tượng chính sách</a></li>
                    <li><a href="<?php echo base_url(); ?>sinhvien/changepass"><i class="icon-edit"></i>Đổi mật khẩu</a></li>
                    <li><a href="<?php echo base_url(); ?>sinhvien/logout" id="btn-logout"><i class="icon-off"></i>Đăng Xuất</a></li>
                </ul>
            </div><!--end .widget-->
        </div><!--end sidebar-->