<h4 class="text-center">Bảng điểm rèn luyện</h4>
<table class="table table-bordered table-striped">
    <tr>
        <th>Học Kỳ</th>
        <th>Điểm</th>
        <th>Điểm Quy Đổi</th>
        <th>Xếp Loại</th>
        <th>Ngày XN</th>
    </tr>
    <?php foreach($drl as $k => $v) : ?>
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
    <a href="sinhvien" class="btn btn-inverse">Trở về</a>
</p>