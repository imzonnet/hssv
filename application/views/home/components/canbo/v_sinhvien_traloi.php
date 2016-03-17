<div class="span12">
	<div class="control-group">
		<table class="table table-bordered table-hover table-striped">
		    <thead>
		        <tr>
		            <th>Mã Số</th>
		            <th>Nội Dung</th>
		            <th>Người Gởi</th>
		            <th>Thời gian đăng tin</th>
		        </tr>
		    </thead>
		    <tbody>
	        <?php
	        foreach($danhsach as $k ){
		    ?>
		        <tr>
		            <td><?php echo $k['MaSo']; ?></td>
		            <td><?php echo $k['NoiDung']; ?></td>
		            <td><?php echo $k['NguoiGoi']; ?></td>
		            <td><?php echo $k['ThoiGianCapNhat']; ?></td>
		        </tr>
		    <?php
		        }
		    ?>
		    </tbody>
		</table>
		<a class="btn btn-info" href="<?php echo base_url('canbo/phanhoisinhvien');?>">Trở lại phản hồi sinh viên</a>
		<div class="pagination">
		    <?php echo $page_link; ?>
		</div>
	</div>
	
</div>