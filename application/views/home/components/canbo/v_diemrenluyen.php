<div class="span12">
	<div class="control-group">
		<table class="table table-bordered table-hover table-striped">
		    <thead>
		        <tr>
		            <th>STT</th>
		            <th>Mã Sinh Viên</th>
		            <th>Mã Học Kỳ</th>
		            <th>Điểm</th>
		            <th>Quy đổi</th>
		            <th>Xếp loại</th>
		            <th>Ngày XN</th>
		        </tr>
		    </thead>
		    <tbody>
	        <?php
	        $i = 1;
	        foreach($dsdiemrenluyen as $k ){
		    ?>
		        <tr>
		            <td><?php echo $i; ?></td>
		            <td><?php echo $k['MaSV']; ?></td>
		            <td><?php echo $k['MaHK']; ?></td>
		            <td><?php echo $k['Diem']; ?></td>
		            <td><?php echo $k['DiemCD']; ?></td>
		            <td><?php echo $k['XepLoai']; ?></td>
		            <td><?php echo $k['NgayXN']; ?></td>
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