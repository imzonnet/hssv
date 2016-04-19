<?php if($ds == false) redirect(base_url('sinhvien'));?>
<?php
	if($this->session->flashdata('result') != ''){
		echo "<div class='alert alert-success' role='alert'><strong>".$this->session->flashdata('result')."</strong></div>";
	}
	if($this->session->flashdata('error') != ''){
		echo "<div class='alert alert-danger' role='alert'><strong>".$this->session->flashdata('error')."</strong></div>";
	}
	foreach ($ds as $k => $v) { ?>
		<div class="studentFeedBack">
			<a href="<?php echo base_url('sinhvien/xemtinphanhoi').'/'.$v['MaSo']; ?>"><?php echo $v['TieuDe']; ?> </a>
			<p><?php echo substr($v['NoiDung'],0,300).'...'; ?> </p>
			<p class="feedback_time"><?php echo '<strong>'.$v['HoTen'].'</strong>'.'    '.'Cập nhật: '.$v['ThoiGianCapNhat'] ?></p>
		</div> 

<?php } ?>
<a href="<?php echo base_url('sinhvien/dangtinphanhoi'); ?>" class="btn btn-primary">Thêm phản hồi</a>	
<div class="pagination">
	    <?php echo $page_link; ?>
</div>