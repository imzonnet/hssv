<html>
<head>
    <title>Giấy Xác Nhận Vay Vốn</title>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
    <base href="<?php echo base_url(); ?>" />
    <style>
        * {padding: 0px; margin: 0px;}
        body{background-color: white; font:13pt "Times New Roman";}
        #wrapper{width: 8.27in; height: 10.7in;}
        .span5{width: 50%; display: block;}
        .header {margin-top: 30px;width: 8.27in; display: block; float: left;}
        .logo {width: 60px; height: 60px;}
        .text-center {text-align: center;} .text-strong {font-weight: bold;}
        .pull-left{float: left;} .pull-right{float: right}
        .container { width: 100%; display: block; margin-bottom: 15px; clear: both;}
        .text-header {text-align: center; font-size: 22pt; text-transform: uppercase; display: block; padding: 10px; }
        .content, .send  {width: 7.22in; padding: 0in 0.35in 0in 0.8in}
        .send .address {text-indent: 70px; display: block;}
        .law { font-style: italic;}
        .footer {
            display: block; clear: both;
            width: 4in;
            float: right;
            text-align: center;
            margin-top: 20px;
        }
		.list { margin-left: 40px; list-style: none; }
        .list li { display: block; height: 25px; width: 200px; line-height: 25px;}
        .list li span {display: block; border: 1px solid; float: right; width: 20px; height: 20px;}
        .print { cursor: pointer;}
        table tr {margin-bottom: 15px;}
    </style>
</head>

<body>
<div id="wrapper">
<button class="print" onclick="this.style.display ='none';window.print();window.close();"><img src="templates/img/btn_print.gif" /></button>
    <div class="header container">
        <div class="span5 text-center pull-left text-strong">
            ĐẠI HỌC ĐÀ NẴNG<br />
            TRƯỜNG CAO ĐẲNG CÔNG NGHỆ<br />

        </div>
        <div class="span5 text-center pull-right text-strong">
            <b>CỘNG HOÀ XÃ HỘI CHỦ NGHĨA VIỆT NAM</b><br />
            Độc lập – Tự do - Hạnh phúc<br />
        </div>
        
    </div>
    
    <div class="header-sub container">
            <div class="span5 text-center pull-left text-strong">
                Số:  <?php echo $maxn; ?>/CĐCN-CT,HSSV<br />     
    
            </div>
    </div>
    <h3 class="container text-header">Giấy Xác Nhận</h3>
        
    <div class="content container">
        Họ và tên học sinh ( sinh viên): <?php echo $sinhvien->hoten; ?><br />
		Ngày sinh: <?php echo date('d-m-Y',strtotime($sinhvien->ngaysinh)); ?> Giới tính: <?php echo $sinhvien->gioitinh; ?> <br />
		CMND số: <?php echo $sinhvien->cmnd; ?> Ngày cấp: <?php echo date('d-m-Y',strtotime($sinhvien->ngaycap)); ?> Nơi cấp: <?php echo $sinhvien->noicap; ?> <br />
		Mã trường theo học: <b>DDC</b> <br />
		Tên trường: TRƯỜNG CAO ĐẲNG CÔNG NGHỆ - ĐÀ NẴNG <br />
		Ngành học: <?php echo $sinhvien->tennganh; ?> <br />
		Hệ đào tạo:<?php echo $sinhvien->hedaotao; ?><br />
		Khóa: <?php echo $sinhvien->khoahoc; ?> Loại hình đào tạo: Chính quy<br />
		Lớp: <?php echo $sinhvien->malop; ?> Số thẻ HSSV: <?php echo $sinhvien->masv; ?><br />
		Khoa: <?php echo $sinhvien->tenkhoa; ?><br />
		Ngày nhập học: <?php echo date('d-m-Y',strtotime($sinhvien->ngaynhaphoc)); ?>Thời gian ra trường ( tháng/năm): 6/<?php echo date('Y',strtotime($sinhvien->ngaynhaphoc))+3; ?> <br />
		( Thời gian học tại trường: 36 tháng) <br />
		- Số tiền học phí hàng tháng: 500 000đ
		<table>
			<tr>
				<td valign="top">Thuộc diện: </td>
				<td>
					<ul class="list">
						<li>- Không miễn giảm<span>&nbsp;</span></li>
						<li>- Giảm học phí<span>&nbsp;</span></li>
						<li>- Miễn học phí<span>&nbsp;</span></li>
					</ul>
				</td>
			</tr>
			<tr>
				<td valign="top">Thuộc đối tượng: </td>
				<td>
					<ul class="list">
						<li>- Mô côi<span>&nbsp;</span></li>
						<li>- Không mồ côi<span>&nbsp;</span></li>
					</ul>
				</td>
			</tr>
		</table>
        <p>
        <br />
        - Trong thời gian theo học tại trường, anh (chị) <?php echo $sinhvien->hoten; ?> không bị xử phạt hành chính trở lên về các hành vi: cờ bạc, nghiện hút, trộm cắp, buôn lậu.<br />
        - Số tài khoản của Nhà trường: 945020800013 tại Ngân Hàng Công Thương (Vietinbank)- Thành phố Đà Nẵng.
        </p>
    </div>
    
    <div class="footer text-strong">
    
        
            <i>Đà Nẵng, ngày <?php echo $ngayxn['ngay'];?> tháng <?php echo $ngayxn['thang'];?>  năm <?php echo $ngayxn['nam'];?></i>
        <br />
		
        TL. HIỆU TRƯỞNG<br />
      TRƯỞNG PHÒNG CT-HSSV

    </div>
</div>


</body>

</html>

