<ul class='unstyled'>
	<li>Mã sinh viên: <?php echo $sv->masv; ?></li>
	<li>Họ và tên: <?php echo $sv->hoten; ?></li>
	<li>Lớp: <?php echo $sv->malop; ?></li>
</ul>
<table class="table table-bordered table-striped">
    <tr>
        <th>Học Kỳ</th>
        <th>Điểm</th>
        <th>Điểm Quy Đổi</th>
        <th>Xếp Loại</th>
        <th>Ngày XN</th>
    </tr>
    <?php foreach($kqtk as $k => $v) : ?>
        <tr>
            <td><?php echo $v['MaHK']; ?></td>
            <td><?php echo $v['Diem']; ?></td>
            <td><?php echo $v['DiemCD']; ?></td>
            <td><?php echo $v['XepLoai']; ?></td>
            <td><?php echo $v['NgayXN']; ?></td>
        </tr>
    <?php endforeach; ?>
</table>
<p>
    <a href="canbo/timkiemdrl" class="btn btn-inverse" onclick="history.go(-1);">Trở về</a>
</p>