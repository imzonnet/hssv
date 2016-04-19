<?php if($ds == false) redirect(base_url('sinhvien'));?>
<?php
foreach ($ds as $k => $v) { ?>
	<div class="studentFeedBack">
		<a href="<?php echo base_url('sinhvien/xemtinvieclam').'/'.$v['MaSo']; ?>"><?php echo $v['TieuDe']; ?> </a>
		<p><?php echo substr($v['NoiDung'],0,300).'...'; ?> </p>
		<p class="feedback_time"><?php echo '<strong>'.$v['TenCb'].'</strong>'.'    '.'Cập nhật: '.$v['NgayDangTin'] ?></p>
	</div> 

<?php } ?>
<div class="pagination">
	<?php echo $page_link; ?>
</div>