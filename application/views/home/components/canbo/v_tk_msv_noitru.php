<h4>Danh sách các sinh viên có Mã Sinh Viên "<?php echo $nd; ?>"</h4>
<table class="table table-bordered table-striped ngoaitru table-hover">
    <tr>
        <td>STT</td>
        <td>MSV</td>
        <td>Tên SV</td>
        <td>Lớp</td>
        <td>Tên Phường</td>
        <td>Tên Quận</td>
    </tr>
    <?php
    $i = $this->uri->segment(6)+1;
    foreach($kqtk as $kq) :
    ?>
        <tr>
            <td><?php echo $i; ?></td>
            <td><?php echo $kq['MaSV']; ?></td>
            <td><?php echo $kq['HoTen']; ?></td>
            <td><?php echo $kq['MaLop']; ?></td>
            
            <td><?php echo $kq['TenPhuong']; ?></td>
            <td><?php echo $kq['TenQuan']; ?></td>
        </tr>
    <?php 
        $i++;
    endforeach;
    ?>
</table>
<div class="pagination">
<?php echo $page_link;  ?>
</div>
<p>
    <a href="<?php echo base_url('canbo/tksvnoitru'); ?>" class="btn" /><i class="icon-chevron-left"></i>Quay Lại</a>
    <a href="<?php echo base_url('canbo').'/thongKeDsSvNoiTruTheoTen/'.$tc.'/'.$nd;?>" onclick="mocuaso('<?php echo base_url('canbo').'/thongKeDsSvNoiTruTheoTen/'.$tc.'/'.$nd;?>',1000,700);return false;" class="btn btn-success"><i class="icon-print icon-white"></i> In Thống Kê</a>
</p>

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