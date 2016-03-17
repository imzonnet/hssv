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
            <center><a href="<?php echo base_url('sinhvien').'/xemyeucau/'.$yeucau['mayc'];?>" class="btn btn-success">Đợi Xác Nhận Phòng HSSV</a></center>
        </td>
    </tr>
</table>
