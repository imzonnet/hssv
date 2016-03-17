<h4 class="text-center">DANH SÁCH HỌC SINH - SINH VIÊN NGOẠI TRÚ (DIỆN THUÊ NHÀ TRỌ)</h4>
<p>
    <?php echo $namhoc; ?> <br /><?php echo $malop; ?><br />
    <?php if($ok>0): ?>
        <span class="alert-success">Có <b><?php echo $ok; ?></b> địa chỉ ngoại trú sẽ được cập nhật.<br /></span>
    <?php endif; ?>
    <?php if($no>0): ?>
        <span class="alert-error">Có <b><?php echo $no; ?></b> địa chỉ ngoại trú đã được đăng ký<?php echo $mahk; ?></span>
    <?php endif; ?>
</p>
<form action="canbo/themsvnt" method="post">
    <table class="table table-bordered table-striped ngoaitru">
        <tr>
            <th>STT</th>
            <th>Sinh Viên</th>
            <th>Ngày sinh</th>
            <th>Mã sinh viên</th>
            <th>Chủ Trọ</th>
            <th>Địa chỉ</th>
            <th>Điện thoại</th>
            <th>Ngày ở</th>
        </tr>
    <?php
        $i = 1;
        foreach($ds_sv as $k =>$v) {
    ?>
            <tr class="<?php echo $v['class']; ?>">
                <td><?php echo $i; ?></td>
                <td><?php echo $v['TenSV']; ?></td>
                <td><?php echo $v['NgaySinh']; ?></td>
                <td><?php echo $v['MaSV']; ?></td>
                <td><?php echo $v['TenChuTro']; ?></td>
                <td><?php echo $v['DiaChi'].' - '.$v['TenPhuong'].''.$v['TenQuan']; ?></td>
                <td><?php echo $v['DienThoai']; ?></td>
                <td><?php echo $v['NgayDen']; ?></td>
            </tr>
    <?php
            ++$i;
        }
    ?>
    </table>

    <input type="hidden" name="file" value="<?php echo $file; ?>" />
    <a href='canbo/themsvnt' class="btn btn-inverse">Hủy Bỏ</a>
    <button type="submit" name="done" class="btn btn-primary" value="ok">Xác Nhận</button>
</form>

<ul class="notice">
    <li><span class="error">&nbsp;</span>Địa chỉ này không hợp lệ hoặc đã có.</li>
    <li><span class="success">&nbsp;</span>Địa chỉ hợp lệ và sẽ được cập nhật.</li>
</ul>