<h3 class="text-center">Kết quả tìm kiếm điểm rèn luyện</h3>
<table class="table span5">
    <tr>
        <td>Mã lớp:</td>
        <td><?php echo $lopsh; ?></td>
    </tr>
    <tr>
        <td>Mã học kỳ:</td>
        <td><?php echo $mahk; ?></td>
    </tr>
</table>
<div class="span6">
    <ul class="span12 thongkedrl">
    <?php $ts = 0; foreach($thongke as $k => $v) : ?>
        <li>
            <span class="tk-header"><?php echo $v['XepLoai']; ?></span>
            <span><?php echo $v['DCD']; $ts+=$v['DCD']; ?></span>
        </li>
    <?php endforeach; ?>
        <li><span class="tk-header">Tổng Số</span><span><?php echo $ts; ?></span></li>
    </ul>
</div>
<table class="table table-bordered table-striped table-hover ngoaitru">
    <tr>
        <th>STT</th>
        <th>MSV</th>
        <th>Họ và tên</th>
        <th>Điểm</th>
        <th>Điểm CĐ</th>
        <th>Xếp Loại</th>
        <th>Ngày Xác Nhận</th>
        <th>Bảng điểm rèn luyện</th>
    </tr>
    <?php
        $i = $this->uri->segment(5)+1;
        foreach($kqtk as $kq)
        {
    ?>
        <tr>
            <td><?php echo $i; ?></td>
            <td><?php echo $kq['MaSV']; ?></td>
            <td><?php echo $kq['HoTen']; ?></td>
            <td><?php echo $kq['Diem']; ?></td>
            <td><?php echo $kq['DiemCD']; ?></td>
            <td><?php echo $kq['XepLoai']; ?></td>
            <td><?php echo $kq['NgayXN']; ?></td>
            <td><a href="canbo/ketquadrlsv/<?php echo $kq['MaSV']; ?>" class="btn btn-info"><i class='icon-eye-open icon-white'></i> Chi tiết </a></td>
        </tr>
    <?php 
        $i++;
        }
    ?>
</table>
<div class="pagination">
<?php echo $page_link;  ?>
</div>
<p>
    <a href="<?php echo base_url('canbo/timkiemsvnt'); ?>" class="btn" ><i class="icon-chevron-left"></i>Quay Lại</a>
    <a href="<?php echo base_url('canbo').'/thongkedrl/'.$lopsh.'/'.$mahk;?>" onclick="mocuaso('<?php echo base_url('canbo').'/thongkedrl/'.$lopsh.'/'.$mahk;?>',1000,700); location.href='<?php echo base_url('canbo').'/timkiemdrl/'; ?>';return false;" class="btn btn-success"><i class="icon-print icon-white"></i> In Thống Kê</a>
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