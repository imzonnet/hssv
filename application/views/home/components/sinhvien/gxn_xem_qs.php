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
            <center><a href="<?php echo base_url('sinhvien').'/huygxn/'.$yeucau['mayc'].'/'.$yeucau['lg'];?>" class="btn btn-danger">Hủy Bỏ</a></center>
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
            <center><a href="<?php echo base_url('sinhvien').'/xemyeucau/'.$yeucau['mayc'];?>" class="btn btn-success">Đợi Xác Nhận Phòng HSSV</a></center>
        </td>
    </tr>
    <?php
        endif;
    ?>
</table>

