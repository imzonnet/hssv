<div class="span12">
	<div class="control-group">
		<table class="table table-bordered table-hover table-striped">
		    <thead>
		        <tr>
		            <th>STT</th>
		            <th>Mã Sinh Viên</th>
		            <th>Mã Lop</th>
		            <th>Họ Tên</th>
		            <th>Ngày Sinh</th>
		            <th>Giới Tính</th>
		            <th>Khóa Học</th>
		        </tr>
		    </thead>
		    <tbody>
	        <?php
	        $i = 1;
	        foreach($dssinhvien as $k ){
		    ?>
		        <tr>
		            <td><?php echo $i; ?></td>
		            <td><?php echo $k['MaSV']; ?></td>
		            <td><?php echo $k['MaLop']; ?></td>
		            <td><?php echo $k['HoTen']; ?></td>
		            <td><?php echo $k['NgaySinh']; ?></td>
		            <td><?php 
		            	if($k['GioiTinh'] ==1){
		            		echo "Nam";
		            	}
		            	else
		            		echo "Nữ" ;
		            	?>
		            </td>
		            <td><?php echo $k['KhoaHoc']; ?></td>
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