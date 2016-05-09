<div class="span3">
    <div class="widget">
        <h3 class="nav-header">Thông tin tuyển dụng</h3>
        <ul class="nav nav-list">
            <?php foreach($thongtintuyendung as $item) : ?>
                <li><a href="<?php echo base_url('tuyen-dung/'.$item['MaSo']); ?>"><i class="icon-chevron-right"></i><?php echo $item['TieuDe']; ?></a></li>
            <?php endforeach; ?>
        </ul>
    </div><!--end .widget-->
</div>

<div class="span9 well">
    <h3>Hệ thống quản lý học sinh sinh viên</h3>

    <p>
        Trường cao đẳng Công Nghệ Đà Nẵng là cơ sở đào tạo nguồn nhân lực kỹ thuật công nghệ đáp ứng nhu cầu phát triển
        kinh tế xã hội của thành phố Đà Nẵng,
        khu vực miền Trung - Tây Nguyên và của đất nước Việt Nam. <br/>
        Tự tin, năng động, thực tiễn và sáng tạo là các cam kết của nhà trường về phẩm chất sinh viên tốt nghiệp trường
        cao đẳng Công Nghệ Đà Nẵng.

    </p>
    <p>
        PHÒNG CÔNG TÁC HỌC SINH SINH VIÊN <br/>
        Số điện thoại : 0511.3.896601<br/>
        Trưởng phòng : Thạc sĩ Trần Quốc Việt<br/>
        Phó trưởng phòng : Kỹ sư Phan Văn Mẫn<br/>
        Phó trưởng phòng : Thạc sĩ Võ Quang Trường
    </p>
    <p>
        MỤC ĐÍCH <br/>
        Thực hiện quản lý toàn diện đối với học sinh sinh viên của trường theo quy chế công tác học sinh sinh viên của
        Bộ Giáo dục và Đào tạo<br/>
        Tổ chức và quản lý việc đánh giá điểm rèn luyện của học sinh sinh viên<br/>
        Thực hiện tổ chức quản lý học sinh sinh viên ngoại trú theo quy chế quản lý HS-SV ngoại trú

    </p>
</div>
