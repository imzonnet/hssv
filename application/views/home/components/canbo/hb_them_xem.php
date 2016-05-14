<h4 class="text-center"><?php echo $tieude; ?><p>
    <?php if($ok>0): ?>
        <span class="alert-success">Có <b><?php echo $ok; ?></b> sinh viên được cấp học bổng.<br /></span>
    <?php endif; ?>
</p>
<form action="canbo/themdshb" method="post">
    <table class="table table-bordered table-striped">
        <tr>
            <th>STT</th>
            <th>Mã Sinh Viên</th>
            <th>Họ Và Tên</th>
            <th>Ngày sinh</th>
            <th>Lớp</th>
            <th>Số TC</th>
            <th>Điểm TB</th>
            <th>Điểm RL</th>
        </tr>
    <?php
        $i = 1;
        foreach($ds_sv as $k =>$v) {
    ?>
            <tr>
                <td><?php echo $i; ?></td>
                <td><?php echo $v['MaSV']; ?></td>
                <td><?php echo $v['TenSV']; ?></td>
                <td><?php echo $v['NgaySinh']; ?></td>
                <td><?php echo $v['Lop']; ?></td>
                <td><?php echo $v['STC']; ?></td>
                <td><?php echo $v['DTB']; ?></td>
                <td><?php echo $v['DRL']; ?></td>
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