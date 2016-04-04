<div class="span12">
	<div class="control-group">
		<table class="table table-bordered table-hover table-striped">
		    <thead>
		        <tr>
		            <th>Mã SV</th>
		            <th>Họ Tên</th>
		            <th>Ngày Sinh</th>
		            <th>Ngành</th>
		            <th>Lớp</th>
		            <th>Điểm</th>
		            <th>Đạt</th>
		        </tr>
		    </thead>
		    <tbody>
	        <?php
	        foreach($kqtk as $k ){
		    ?>
		        <tr>
		            <td><?php echo $k['MaSV']; ?></td>
		            <td><?php echo $k['HoTen']; ?></td>
		            <td><?php echo $k['NgaySinh']; ?></td>
		            <td><?php echo $k['Nganh']; ?></td>
		            <td><?php echo $k['Lop']; ?></td>
		            <td><?php echo $k['Diem']; ?></td>
		            <td><?php echo $k['Dat']; ?></td>
		        </tr>
		    <?php
		        }
		    ?>
		    </tbody>
		</table>
		
		<div class="pagination">
		    <?php echo $page_link; ?>
		</div>
	</div>
	<p>
	<a href="<?php echo base_url('canbo').'/thongKeDsCtDk';?>" onclick="mocuaso('<?php echo base_url('canbo').'/thongKeDsCtDk/';?>',1000,700);return false;" class="btn btn-success"><i class="icon-print icon-white"></i> In Thống Kê</a>
	</p>
	<script>
	function mocuaso(website,rong,cao) {
	var windowprops='width=100,height=100,scrollbars=yes,s tatus=yes,resizable=no'
	var heightspeed = 15;
	var widthspeed = 15;
	var leftdist = 10;
	var topdist = 10;
	if (window.resizeTo&&navigator.userAgent.indexOf("Ope ra")==-1) {
	    var winwidth = window.screen.availWidth - leftdist;
	    var winheight = window.screen.availHeight - topdist;
	    var sizer = window.open("","","left=" + leftdist + ",top=" + topdist +","+ windowprops);
	    for (sizeheight = 1; sizeheight < cao; sizeheight += heightspeed)
	    sizer.resizeTo("1", sizeheight);
	    for (sizewidth = 1; sizewidth < rong; sizewidth += widthspeed)
	        sizer.resizeTo(sizewidth, sizeheight);
	    sizer.location = website;
	}else
	    window.open(website,'mywindow');
	}

	</script>
	
</div>