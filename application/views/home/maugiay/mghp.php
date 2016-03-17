<html>
<head>
    <title>Giấy Miễn Giảm Học Phí</title>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
    <base href="<?php echo base_url(); ?>" />
    <style>
        * {padding: 0px; margin: 0px;}
        body{background-color: white; font:12pt "Times New Roman";}
        #wrapper{width: 8.27in; height: 10.7in;}
        .header {margin-top: 30px;width: 8.27in; display: block; float: left;}
        .text-center {text-align: center;} .text-strong {font-weight: bold;}
        .pull-left{float: left;} .pull-right{float: right}
        .container { width: 100%; display: block; margin-bottom: 10px; clear: both;}
        .text-header {text-align: center;text-transform: uppercase; display: block; padding: 10px 10px 4px; }
        .content, .send  {width: 7in; margin: 0px auto;}
		#doituong { margin-top: 10px; margin-left: 20px; margin-bottom: 10px;}
		.checkbox {display: block; margin-left: 20px; min-height: 20px; line-height: 20px; margin-bottom: 3px; min-width: 280px; float: left;}
		#doituong span { display: block; clear: both; text-decoration: underline; margin-bottom: 5px;}
		.doituong { float: left; margin-left: -20px; display: block; margin-top: 4px;}
		.Sendto table{ margin-left: 1.7in;}
		.Sendto table tr td { font-weight: bold; padding: 0px 10px;}
		.list { margin-left: 40px; list-style: none; }
        .print { cursor: pointer;}
		.fleft {float: left;} .fright {float: right; }
		p { clear: both; text-indent: 30px; padding: 3px 0px;}
		
		.footer {
            display: block; clear: both;
            text-align: center;
        }
        table tr td { padding: 0px 10px 0px 0px;}
		.footer h4 { clear: both; text-align: right; }
		div.fright { margin-right: 50px; }
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
    <h3 class="container text-header">Đơn xin miễn giảm học phí</h3>
	<div class="Sendto">
		<table>
			<tr>
				<td rowspan="2" valign="top" >Kính gửi:</td>
				<td> Ban giám hiệu Nhà trường</td>
			</tr>
			<tr>
				<td>Phòng Công tác - HSSV</td>
			</tr>
		</table>
	</div>
    <div class="content container">
        Họ và tên học sinh ( sinh viên): <?php echo $sinhvien->hoten; ?> &nbsp;&nbsp; Giới tính: <?php echo $sinhvien->gioitinh; ?> <br />
		<table>
			<tr><td>Ngày sinh: <?php echo date('d/m/Y',strtotime($sinhvien->ngaysinh)); ?> </td>
				<td>Dân tộc: ....</td></tr>
			<tr><td>Ngành học:<?php echo $sinhvien->tennganh; ?> </td>
				<td>Mã số sinh viên: <?php echo $sinhvien->masv; ?></td></tr>
			<tr><td>Lớp: <?php echo $sinhvien->malop; ?> </td>
				<td>Cao đẳng (Trung cấp) hệ chính quy</td></tr>
			<tr><td>Điện thoại: </td>
				<td>Email:  </td></tr>
		</table>
		CMND số: <?php echo $sinhvien->cmnd; ?> Ngày cấp: <?php echo date('d-m-Y',strtotime($sinhvien->ngaycap)); ?> Nơi cấp: <?php echo $sinhvien->noicap; ?> <br />
		Đăng ký hộ khẩu thường trú tại xã/phường/thị trấn: <?php echo $address['phuong']; ?><br />
		huyện/quận/thị xã: <?php echo $address['quan']; ?> &nbsp; &nbsp; &nbsp; tỉnh/thành phố:<?php echo $address['tinh']; ?><br />
		<div id="doituong" class="control-group">
			<span>Thuộc đối tượng nào: </span>
            <?php echo $doituong; ?>
		</div>
		<p>
			Căn cứ NĐ 74/2013/NĐ-CP ngày 15 tháng 07 năm 2013 về sửa đổi, bổ sung một số điều của Nghị định số 49/2010/NĐ-CP ngày 14 tháng 5 năm 2010
			của Chính phủ quy định về miễn giảm học phí, hỗ trợ chi phí học tập và cơ chế thu, sử dụng học phí đối với cơ sở giáo dục thuộc hệ giáo dục
			quốc dân từ năm học 2010-2011 đến năm học 2014-2015
		</p>
		<p>
			Em cam đoan các lời khai trong đơn này là đúng sự thật và xin được hưởng chế độ miễn, giảm học phí theo tiêu chuẩn Nhà nước tại trường.
			Nếu có sai trái, em xin hoàn toàn chịu trách nhiệm trước pháp luật.
		</p>
    </div>
    
    <div class="footer text-strong">
		<h4>Đà Nẵng, ngày 8 tháng 11 năm 2013 </h4>
		<div class="fleft">
			<h3>Xác nhận của địa phương</h3>
			(đề nghị ý kiến, ký và ghi rõ họ tên)
		</div>
		<div class="fright">
			<h3>Sinh viên</h3>
		  (ký và ghi rõ họ tên)
		</div>
    </div>
</div>


</body>

</html>

