<div class="span12">
	<p>Số lượng sinh viên đăng ký phòng: <strong><?php echo $soluongsv; ?></strong></p>
</div>
<table class="table table-bordered table-hover table-striped">

    <thead>
        <tr>
            <th>STT</th>
            <th>Mã sinh viên</th>
            <th>Ngày sinh</th>
            <th>Giới tính</th>
            <th>Lớp sinh hoạt</th>
            <th>Khóa học</th>
            <th>Ngày đăng ký</th>
        </tr>
    </thead>
    <tbody>
	        <?php
	        $i = 1;
	        foreach($dssv as $v){
		    ?>
		        <tr>
		            <td><?php echo $i; ?></td>
		            <td><?php echo $v['MaSV']; ?></td>
		            <td><?php echo $v['NgaySinh']; ?></td>
		            <td><?php 
		            		if($v['GioiTinh']==1)
		            			echo "Nam"; 
		            		else
		            			echo "Nữ";
		            	?>
		            </td>
		            <td><?php echo $v['MaLop']; ?></td>
		            <td><?php echo $v['KhoaHoc']; ?></td>
		            <td><?php echo $v['NgayDK']; ?></td>
		        </tr>
		    <?php
		            $i++;
		        }
		    ?>
	</tbody>
</table>
<div class="span12">
	<a href="<?php echo base_url();?>canbo/tinhtrangphongktx">Quay lại tình trạng phòng ký túc xá</a>
</div>
<?php