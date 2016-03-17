<?php
if($this->session->flashdata('error') != ''){
	echo "<div class='alert alert-danger' role='alert'><strong>".$this->session->flashdata('error')."</strong></div>";
}
?>
<h5><?php echo $nd[0]['TieuDe']; ?></h5>
<p><?php echo $nd[0]['NoiDung']; ?></p>
<p class="feedback_time"><?php echo '<strong>'.$nd[0]['HoTen'].'</strong>'.'    đăng vào: '.$nd[0]['ThoiGianCapNhat']; ?></p>
<hr>
<?php
	if($ndtraloi !=false){
		foreach ($ndtraloi as $k => $v) {?> 

			<div class="studentFeedBack">
				<?php 
					$nguoigoi = $v['NguoiGoi'];
					if(strlen($nguoigoi)==5){ ?>
						<p class="teacher_color"><?php echo $v['NoiDung']; ?> </p>
						<p class="feedback_time"><?php echo "<span class='teacher_color'><strong>".$v['TenCB']."</strong></span>   đăng vào: ".$v['ThoiGianCapNhat'];  ?></p>		
					<?php }
					else{ ?>
						<p><?php echo $v['NoiDung']; ?> </p>
						<p class="feedback_time"><?php echo '<strong>'.$v['HoTen'].'</strong>   đăng vào: '.$v['ThoiGianCapNhat']; ?>
						</p>
					<?php }
				?>
				
			</div>
		<?php
		}
	}
?>
<form action="<?php echo base_url('sinhvien/xemtinphanhoi').'/'.$nd[0]['MaSo']; ?>" method="post" accept-charset="uft-8">
	<label><b> Phản hồi </b></label>
	<input type="hidden" name="tieude" value="<?php echo $nd[0]['TieuDe']; ?>">
	<textarea name="txtnote" style="min-width:825px;min-height:150px"></textarea>
	<input type="submit" class="btn btn-primary" value="Đồng ý" name="xacnhan">
	<button class="btn btn-danger" onclick="history.go(-1);">Trở lại</button>
</form>