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
        <td>Giới tính: </td>
        <td><?php echo $sinhvien->gioitinh; ?></td>
    </tr>
    <tr>
        <td>Số CMND: </td>
        <td><?php echo $sinhvien->cmnd; ?></td>
    </tr>
    <tr>
        <td>Ngày cấp: </td>
        <td><?php echo $sinhvien->ngaycap; ?> &nbsp; <b>Nơi cấp</b>:<?php echo $sinhvien->noicap; ?></td>
    </tr>
    
    <tr>
        <td>Hệ đào tạo:</td>
        <td><?php echo $sinhvien->hedaotao; ?></td>
    </tr>
    <tr>
        <td>Khóa: </td>
        <td><?php echo $sinhvien->khoahoc; ?></td>
    </tr>
    <tr>
        <td>Lớp: </td>
        <td><?php echo $sinhvien->malop; ?></td>
    </tr>
    <tr>
        <td>Khoa: </td>
        <td><?php echo $sinhvien->tenkhoa; ?></td>
    </tr>
    <tr>
        <td>Ngày nhập học:</td>
        <td><?php echo $sinhvien->ngaynhaphoc; ?></td>
    </tr>
    <tr>
        <td>Ngày kết thúc học:</td>
        <td><?php echo date('Y',strtotime($sinhvien->ngaynhaphoc))+3; ?></td>
    </tr>
    <tr>
        <td>Địa chỉ thường trú:</td>
        <td><?php echo $address['thuongtru']; ?></td>
    </tr>
    <tr>
        <td>Số lần cấp:</td>
        <td><?php echo $solanin; ?></td>
    </tr>
     <tr>
        <td colspan="2" class="text-center">
            <center><a id="linkz" href="<?php echo base_url('canbo').'/ingxn/'.$yeucau['mayc'].'/'.$yeucau['lg'];?>" onclick="mocuaso('<?php echo base_url('canbo').'/ingxn/'.$yeucau['mayc'].'/'.$yeucau['lg'];?>',1000,700); location.href='<?php echo base_url('canbo').'/xemyccg/'.$yeucau['mayc']; ?>';return false;" class="btn btn-success">Xác Nhận và In Giấy</a></center>
        </td>
    </tr>
</table>
<script type="text/javascript">
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
