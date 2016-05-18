<html>
<head>
    <title>Biên lai thu tiền</title>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
    <base href="<?php echo base_url(); ?>" />
    <style>
        * {padding: 0px; margin: 0px;}
        body{background-color: white; font:12pt "Times New Roman";}
        #wrapper{width: 8.27in; height: 10.7in; margin: 0 auto;}
        .header {margin-top: 30px;width: 8.27in; display: block; float: left;}
        .text-center {text-align: center;} .text-strong {font-weight: bold;}
        .pull-left{float: left;} .pull-right{float: right}
        .container { width: 100%; display: block; margin-bottom: 10px; clear: both; }
        .text-header {text-align: center;text-transform: uppercase; display: block; padding: 10px 10px 4px; margin-bottom:50px;}
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
		p { clear: both; text-indent: 30px; padding: 3px 0px; font-size:16px;}
		b{ font-size:14px; }
		.kyten{
			margin-top: 60px;
		}
		.right{float:right; margin-right:50px;}
		.thongtin{
			margin-bottom:50px;
		}
		.footer {
            display: block; clear: both;
            text-align: center;
        }
        .footer h3{
        	margin-left:26px;
        }
		.footer h4 { clear: both; text-align: right; }
		div.fright { margin-right: 50px; }
		.note{ margin-top:200px; }
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
	        	PHÒNG CÔNG TÁC HSSV<br />
	            <b>BAN QUẢN LÝ KTX</b><br />
	            02 Thanh Sơn, Tp Đà Nẵng<br />
	        </div>
	        
	    </div>
	    <h3 class="container text-header">BIÊN LAI THU TIỀN</h3>
		
	    <div class="content container">
	        <div class="ngay_nop">
	        	<p><b>Ngày nộp:</b> <?php echo $ngaynop; ?><span class="right"><b> Biên lai số:</b><?php echo $bienlaiso; ?></span></p>
	        </div>

	        <div class="thongtin">
	        	<p><b>Họ và tên người nộp:</b> <?php echo $tensv; ?></p>
	        	<p><b>Địa chỉ:</b> <?php echo $diachi; ?></p> 
	        	<p><b>Mã SV:</b> <?php echo $masv ?></p>
	        	<p><b>Số phòng đăng ký ở:</b> <?php echo $phongdk; ?></p>
	        	<p><b>Nội dung thu:</b> Tạm thu lệ phí ở KTX, học kỳ <?php echo $hocky ?></p>
	        	<p><b>Số tiền thu:</b> 600.000đ</p>
	        	<p><b>Viết bằng chữ:</b> Sáu trăm nghìn đồng y</p>
	        </div>
	    </div>
	    <div class="footer text-strong">
			<div class="fleft">
				<h3>Người nộp</h3>
				<p class="kyten"><?php echo $tensv; ?></p>
			</div>
			<div class="fright">
				<h3>Người thu tiền</h3>
			  	<p class="kyten"><?php echo $tencb; ?></p>
			</div>
	    </div>
	    <p class="note">(Tiền phụ thu thế chấp đăng ký ở KTX : 100.000đ, sẽ hoàn trả lại sau khi ra trường) </p>
	</div>
</body>
</html>

