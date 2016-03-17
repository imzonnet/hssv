<?php
if($data==false){
	echo "<div class='span12'><p>Không có yêu cầu chờ duyệt</p></div>";
}	
else{
?>
<div class="span12">
	<div class="control-group">
		<table class="table table-bordered table-hover table-striped">
		    <thead>
		        <tr>
		            <th>STT</th>
		            <th>ID</th>
		            <th>Mã Sinh Viên</th>
		            <th>Mã Phòng</th>
		            <th>Mã Học Kỳ</th>
		            <th>Thời gian đăng ký</th>
		            <th>Xác Nhận</th>
		        </tr>
		    </thead>
		    <tbody>
	        <?php
	        $i = 1;
	        foreach($data as $k){
		    ?>
		        <tr>
		            <td><?php echo $i; ?></td>
		            <td><?php echo $k['Id']; ?></td>
		            <td><?php echo $k['MaSV']; ?></td>
		            <td><?php echo $k['MaPhong']; ?></td>
		            <td><?php echo $k['MaHK']; ?></td>
		            <td><?php echo $k['NgayDK']; ?></td>
		            <td><a href='<?php echo base_url('canbo/svDkPhong').'/'.$k['Id'].'/'.$k['MaSV'].'/'.$k['MaPhong'];?>' class="btn btn-info">xác nhận</a></td>
		        </tr>
		    <?php
		            $i++;
		        }
		    ?>
		    </tbody>
		</table>
		<div class="pagination">
		    <?php echo $page_link; ?>
		</div>
	</div>
	
</div>
<?php
}
?>