    <h4 class="text-center">PHIẾU TỔNG HỢP ĐÁNH GIÁ KẾT QUẢ RÈN LUYỆN</h4>
    <p>
        <?php echo $namhoc; ?> <br />
        <?php echo $malop; ?><br />
        <?php if($ok>0): ?>
            <span class="alert-success">Có <b><?php echo $ok; ?></b> Sinh viên sẽ được cập nhật.<br /></span>
        <?php endif; ?>
        <?php if($no>0): ?>
            <span class="alert-error">Có <b><?php echo $no; ?></b> Sinh viên đã có bảng điểm tại kỳ <?php echo $mahk; ?></span>
        <?php endif; ?>
        
    </p>
<table class="table table-bordered table-striped ngoaitru">
    <tr>
        <th>STT</th>
        <th>Mã Sinh Viên</th>
        <th>Họ</th>
        <th>Tên</th>
        <th>Tổng Điểm</th>
        <th>Xếp Loại</th>
        <th>Điểm Quy Đổi</th>
        <th>Ghi Chú</th>
    </tr>
<?php
    $i = 1;
    foreach($ds_sv as $k =>$v) {
?>
        <tr class="<?php echo $v['class']; ?>">
            <td><?php echo $i; ?></td>
            <td><?php echo $v['MaSV']; ?></td>
            <td><?php echo $v['HoSV']; ?></td>
            <td><?php echo $v['TenSV']; ?></td>
            <td><?php echo $v['Diem']; ?></td>
            <td><?php echo $v['XepLoai']; ?></td>
            <td><?php echo $v['DiemCD']; ?></td>
            <td><?php echo $v['GhiChu']; ?></td>
        </tr>
<?php
        ++$i;
    }
?>
</table>
<form action="canbo/themdrl" method="post">
    <input type="hidden" name="file" value="<?php echo $file; ?>" />
    <a href='canbo/themdrl' class="btn btn-inverse">Hủy Bỏ</a>
    <?php if(count($ds_sv) > $no ) : ?><button type="submit" name="done" class="btn btn-primary" value="ok">Xác Nhận</button><?php endif; ?>
</form>
<ul class="notice">
    <li><span class="error">&nbsp;</span>Điểm rèn luyện này không hợp lệ hoặc đã có.</li>
    <li><span class="success">&nbsp;</span>Điểm rèn luyện hợp lệ và sẽ được cập nhật.</li>
</ul>