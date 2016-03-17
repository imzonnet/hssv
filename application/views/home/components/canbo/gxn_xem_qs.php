<h4 class="text-center"><?php echo $task_name; ?></h4>
<table class="table table-bordered">
    <tr>
        <td>Mã số sinh viên</td>
        <td><?php echo $sinhvien->masv; ?></td>
    </tr>
    <tr>
        <td>Họ và tên: </td>
        <td><?php echo $sinhvien->hoten; ?></td>
    </tr>
    <tr>
        <td>Sinh năm: </td>
        <td><?php echo $sinhvien->ngaysinh; ?></td>
    </tr>
    <tr>
        <td>Lớp: </td>
        <td><?php echo $sinhvien->malop; ?></td>
    </tr>
    <tr>
        <td>Cấp học:</td>
        <td><?php echo $sinhvien->hedaotao; ?></td>
    </tr>
    <tr>
        <td>Học kỳ:</td>
        <td><?php echo $mahk; ?></td>
    </tr>
    <tr>
        <td>Năm học:</td>
        <td><?php echo $namhoc; ?></td>
    </tr>
    <tr>
        <td>Địa chỉ thường trú:</td>
        <td><?php echo $address['thuongtru']; ?></td>
    </tr>
    <tr>
        <td>Địa chỉ nhận:</td>
        <td><?php echo $address['diachi']; ?></td>
    </tr>
    <tr>
        <td>Số lần cấp:</td>
        <td><?php echo $solanin; ?></td>
    </tr>
    <?php
        if($trangthai == 0) :
    ?>
    <tr class="error">
        <td>Trạng thái sinh viên:</td>
        <td><strong>Chưa đóng học phí</strong></td>
    </tr>
    <tr>
        <td colspan="2" class="text-center">
            <center><a href="<?php echo base_url('canbo').'/huygxn/'.$yeucau['mayc'].'/'.$yeucau['lg'];?>" class="btn btn-danger">Hủy Bỏ</a></center>
        </td>
    </tr>
    <?php
        else :
    ?>
    <tr class="success">
        <td>Trạng thái sinh viên:</td>
        <td><strong>Bình thường</strong></td>
    </tr>
    <tr>
        <td colspan="2" class="text-center">
            <center><a href="<?php echo base_url('canbo').'/ingxn/'.$yeucau['mayc'].'/'.$yeucau['lg'];?>" onclick="mocuaso('<?php echo base_url('canbo').'/ingxn/'.$yeucau['mayc'].'/'.$yeucau['lg'];?>',1000,700); location.href='<?php echo base_url('canbo').'/xemyccg/'.$yeucau['mayc']; ?>';return false" class="btn btn-success">Xác Nhận và In Giấy</a></center>
        </td>
    </tr>
    <?php
        endif;
    ?>
</table>
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
