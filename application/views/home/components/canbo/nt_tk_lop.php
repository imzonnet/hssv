<h4 class="text-center">Danh sách địa chỉ ngoại trú của sinh viên</h4>
<table class="table">
    <tr>
        <td>Lớp sinh hoạt:</td>
        <td><?php echo $malop; ?></td>
    </tr>
    <tr>
        <td>Học kỳ:</td>
        <td><?php echo $mahk; ?></td>
    </tr>

    </tr>
</table>

<table class="table table-bordered table-striped ngoaitru">
    <tr>
        <th>STT</th>
        <th>MSV</th>
        <th>Tên SV</th>
        <th>Ngày Sinh</th>
        <th>Tên Chủ Trọ</th>
        <th>Số đt</th>
        <th>Địa chỉ</th>
        <th>Ngày đến</th>
        <th>Ngày đi</th>
    </tr>
    <?php
    $i = $this->uri->segment(5)+1;
    foreach($kqtk as $kq) :
    ?>
        <tr>
            <td><?php echo $i; ?></td>
            <td><?php echo $kq['MaSV']; ?></td>
            <td><?php echo $kq['HoTen']; ?></td>
            <td><?php echo date('d-m-Y',strtotime($kq['NgaySinh'])); ?></td>
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
    <a href="<?php echo base_url('canbo').'/thongkelopnt/'.$malop.'/'.$mahk;?>" onclick="mocuaso('<?php echo base_url('canbo').'/thongkelopnt/'.$malop.'/'.$mahk;?>',1000,700);return false;" class="btn btn-success"><i class="icon-print icon-white"></i> In Thống Kê</a>
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