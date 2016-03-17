<html>
<head>
    <title>Giấy Hoãn Nghĩa Vụ Quân Sự</title>
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
        .print { cursor: pointer;}
    </style>
</head>

<body>
<div id="wrapper">
<button class="print" onclick="this.style.display ='none';window.print();window.close();"><img src="templates/img/btn_print.gif" /></button>
    <div class="header container">
        <div class="span5 text-center pull-left text-strong">
            ĐẠI HỌC ĐÀ NẴNG<br />
            TRƯỜNG CAO ĐẲNG CÔNG NGHỆ<br />
            <img src="templates/img/i1.png" class="icon" /><br />
            <img src="templates/img/dct.jpg" class="logo" /><br />

        </div>
        <div class="span5 text-center pull-right text-strong">
            <b>CỘNG HOÀ XÃ HỘI CHỦ NGHĨA VIỆT NAM</b><br />
            Độc lập – Tự do - Hạnh phúc<br />
            <img src="templates/img/i2.png" class="icon" /><br />
        </div>
        
    </div>
    
    <div class="header-sub container">
            <div class="span5 text-center pull-left text-strong">
                Số:  <?php echo $maxn; ?>/CĐCN-CT,HSSV<br />     
          <i>“V/v tạm hoãn nghĩa vụ Quân sự”</i>
    
            </div>
            <div class="span5 text-center pull-right text-strong">
                <i>Đà Nẵng, ngày <?php echo $ngayxn['ngay'];?> tháng <?php echo $ngayxn['thang'];?>  năm <?php echo $ngayxn['nam'];?></i>
            </div>
    </div>
    <h3 class="container text-header">Giấy Xác Nhận</h3>
    
    <div class="send container">
        Kính gửi: <strong>- UBND <?php echo $address['diachi']; ?></strong><br />
    </div>
    
    <div class="content container">
        <p class="law">
            - Căn cứ Luật nghĩa vụ Quân sự của nước Cộng hoà Xã hội Chủ nghĩa Việt Nam.<br />
            - Căn cứ Nghị định số 38/2007/NĐ- CP  ngày 15 tháng 03 năm 2007 của Chính phủ, về việc tạm hoãn gọi nhập ngũ và miễn gọi nhập ngũ thời bình đối với công dân nam trong độ tuổi gọi nhập ngũ.<br />
            - Căn cứ Thông tư liên tịch số 175/2011/TTLT - BQP - BGDĐT ngày 13 tháng 09 năm 2011 của liên Bộ Quốc phòng - Giáo dục và đào tạo hướng dẫn thực hiện Nghị định số 38/2007/NĐ-CP ngày 15 tháng 03 năm 2007 của Chính phủ, về việc tạm hoãn gọi nhập ngũ và miễn gọi nhập ngũ thời bình đối với công dân Nam trong độ tuổi gọi nhập ngũ.<br />
        </p>
        <br />
        Trường Cao đẳng Công nghệ kính đề nghị Quý cơ quan xét tạm hoãn NVQS cho:
        <br /><br />
        Học sinh, sinh viên : <?php echo $sinhvien->hoten; ?><br />             
        Sinh năm: <?php echo date('Y',strtotime($sinhvien->ngaysinh)); ?><br />                                                               
        Thường trú tại: <?php echo $address['thuongtru']; ?><br />
        Là  HSSV Lớp: <?php echo $sinhvien->malop; ?> &nbsp;&nbsp;&nbsp;Cấp học:<?php echo $sinhvien->hedaotao; ?><br />
        Học kỳ: <?php echo $mahk; ?><br />                                    	
        Năm học: <?php echo $namhoc; ?><br />
    </div>
    
    <div class="footer text-strong">
        TL. HIỆU TRƯỞNG<br />
      TRƯỞNG PHÒNG CT-HSSV

    </div>
</div>


</body>

</html>

