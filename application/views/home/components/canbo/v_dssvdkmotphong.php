<?php
if($dssv == false){?>
	<div class="span12">
		<p>Không có sinh viên đăng ký</p>
		<a href="<?php echo base_url();?>canbo/tinhtrangphongktx">Quay lại tình trạng phòng ký túc xá</a>
	</div>
<?php
}
else{
?>
<div class="span12">
	<p>Số lượng sinh viên hiện đăng ký: <?php echo $soluongsv; ?></p>
</div>
<table class="table table-bordered table-hover table-striped">
    <thead>
        <tr>
            <th>STT</th>
            <th>Id</th>
            <th>Mã SV</th>
            <th>Thời gian ĐK</th>
            <th>Mã Học Kỳ</th>
            <th>Xác Nhận</th>
            <th>Từ Chối</th>
        </tr>
    </thead>
    <tbody>
	        <?php
	        $i = 1;
	        foreach($dssv as $v){
		    ?>
		        <tr>
		            <td><?php echo $i; ?></td>
		            <td><?php echo $v['Id']; ?></td>
		            <td><?php echo $v['MaSV']; ?></td>
		            <td><?php echo $v['NgayDK']; ?></td>
		            <td><?php echo $v['MaHK']; ?></td>
		            <td><a href="<?php echo base_url('canbo/svDkPhong').'/'.$v['Id'].'/'.$MaPhong.'/'.$v['MaSV']; ?>">Xác Nhận</a></td>
		            <td><a href="<?php echo base_url('canbo/formTuChoiSvDkPhong').'/'.$v['Id'].'/'.$MaPhong;?>">Từ Chối</a></td>
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
<div class="pagination">
    <?php echo $page_link; 
}?>
</div>