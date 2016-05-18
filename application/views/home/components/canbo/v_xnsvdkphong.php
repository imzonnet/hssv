<?php 
	if(isset($mesage_susscess)){
		echo $mesage_susscess;?>
		</br>
		<div class="dual_btn">
			<a class="btn btn-primary" href="<?php echo base_url('canbo').'/inBienLaiDKP/'.$id; ?>">Quay lại danh sách</a>
			<a class="btn btn-danger" href="<?php echo base_url('canbo').'/inBienLaiDKP/'.$id; ?>" onclick="mocuaso('<?php echo base_url('canbo').'/inBienLaiDKP/'.$id;?>',1000,700); return false;" class="btn btn-success"><i class="icon-print icon-white"></i> In biên lai</a>

		</ul>
		
	<?php
	}
	else{
		echo $mesage_error;?>
		</br><a class="btn btn-danger" href="<?php echo base_url()?>canbo/dsSvDkMotPhong/<?php echo $_POST['maphong']; ?>">Quay lại danh sách</a>	
		<?php
	}
 ?>
 <script>
function mocuaso(website,rong,cao) {
    var windowprops='width=100,height=100,scrollbars=yes,s tatus=yes,resizable=no'
    var heightspeed = 15;
    var widthspeed = 15;
    var leftdist = 10;
    var topdist = 10;
    if (window.resizeTo&&navigator.userAgent.indexOf("Ope ra")==-1) {
        var winwidth = window.screen.availWidth - leftdist;
        var winheight = window.screen.availHeight - topdist;
        var sizer = window.open("","","left=" + leftdist + ",top=" + topdist +","+ windowprops);
        for (sizeheight = 1; sizeheight < cao; sizeheight += heightspeed)
        sizer.resizeTo("1", sizeheight);
        for (sizewidth = 1; sizewidth < rong; sizewidth += widthspeed)
            sizer.resizeTo(sizewidth, sizeheight);
        sizer.location = website;
    }else
        window.open(website,'mywindow');
}

</script>