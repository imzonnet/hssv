<div class="span12">
	<div class="control-group">
		<table class="table table-bordered table-hover table-striped">
		    <thead>
		        <tr>
		            <th>STT</th>
		            <th>Mã Sinh Viên</th>
		            <th>Họ Tên</th>
		            <th>Tên Lớp</th>
		            <th>Tên Phường</th>
		            <th>Tên Quận</th>
		        </tr>
		    </thead>
		    <tbody>
	        	<?php
	        $i = 1;
	        foreach($dssvnoitru as $k ){
		    ?>
		        <tr>
		            <td><?php echo $i; ?></td>
		            <td><?php echo $k['MaSV']; ?></td>
		            <td><?php echo $k['HoTen']; ?></td>
		            <td><?php echo $k['MaLop']; ?></td>
		            <td><?php echo $k['TenPhuong']; ?></td>
		            <td><?php echo $k['TenQuan']; ?></td>
		        </tr>
		    <?php
		            $i++;
		        }
		    ?>
		    </tbody>
		</table>
	</div>
	
</div>