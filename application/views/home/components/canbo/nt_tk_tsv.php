<h4>Danh sách các sinh viên có vần "<?php echo $nd; ?>"</h4>
<h5>Có tất cả <?php echo $max; ?> sinh viên được tìm thấy</h5>
<table class="table table-bordered table-striped ngoaitru table-hover">
    <tr>
        <td>STT</td>
        <td>MSV</td>
        <td>Tên SV</td>
        <td>Ngày Sinh</td>
        <td>Lớp</td>
        <td>Tên Chủ Trọ</td>
        <td>Số đt</td>
        <td>Địa chỉ</td>
        <td>Ngày đến</td>
        <td>Ngày đi</td>
    </tr>
    <?php
    $i = $this->uri->segment(6)+1;
    foreach($kqtk as $kq) :
    ?>
        <tr>
            <td><?php echo $i; ?></td>
            <td><?php echo $kq['MaSV']; ?></td>
            <td><?php echo $kq['HoTen']; ?></td>
            <td><?php echo date('d-m-Y',strtotime($kq['NgaySinh'])); ?></td>
            <td><?php echo $kq['MaLop']; ?></td>
            <td><?php echo $kq['TenChuTro']; ?></td>
            <td><?php echo $kq['DienThoai']; ?></td>
            <td><?php echo $kq['DiaChi'].'-'.$kq['TenPhuong'].'-'.$kq['TenQuan']; ?></td>
            <td> <?php echo date('d-m-Y',strtotime($kq['NgayDen'])); ?></td>
            <td> <?php echo strtotime($kq['NgayDi']) != 0 ? date('d-m-Y',strtotime($kq['NgayDi'])) : ""; ?></td>
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
    <a href="<?php echo base_url('canbo/timkiemsvnt'); ?>" class="btn" /><i class="icon-chevron-left"></i>Quay Lại</a>
    <a href="<?php echo base_url('canbo').'/thongkesvnt/'.$tc.'/'.$mahk.'/'.$nd;?>" onclick="mocuaso('<?php echo base_url('canbo').'/thongkesvnt/'.$tc.'/'.$mahk.'/'.$nd;?>',1000,700);return false;" class="btn btn-success"><i class="icon-print icon-white"></i> In Thống Kê</a>
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