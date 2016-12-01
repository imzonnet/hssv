<div class="span12">
	<div class="control-group">
		<?php if (isset($lopsh)) : ?>
			<form id="frmSearchLop" name="frmSearchLop" method="get" class="form-horizontal" action="<?php echo base_url('canbo/dssinhvien'); ?>/">
				<div class="control-group">
					<label class="control-label">
						Lớp sinh hoạt
					</label>
					<div class="controls">
						<p>
							<select name="malop">
								<?php
								$malop = isset($_GET['malop']) ? $_GET['malop'] : NULL;
								foreach($lopsh as $k => $v) {
									$selected = $v['MaLop'] == $malop ? 'selected="selected"' : '';
									echo '<option value="'.$v['MaLop'].'" '.$selected.'>'.$v['MaLop'].'</option>';
								}
								?>
							</select>
						</p>
					</div>
				</div>
				<div class="control-group">
					<div class="controls">
						<input type="submit" name="search" value="Tìm kiếm" class="btn btn-primary" />
					</div>
				</div>
			</form>
		<?php endif; ?>
		<?php if (isset($dssinhvien)) : ?>
		<table class="table table-bordered table-hover table-striped">
		    <thead>
		        <tr>
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
			if (count($dssinhvien) > 0) :
	        	foreach($dssinhvien as $k) :
		    ?>
		        <tr>
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
		        endforeach;
			endif;
		    ?>
		    </tbody>
		</table>
		<div class="pagination">
		    <?php echo $page_link; ?>
		</div>
		<?php endif; ?>
	</div>
	
</div>