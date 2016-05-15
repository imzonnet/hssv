<h3 class="text-center">Danh sách học bổng Học Kỳ <strong><?php echo $mahk; ?></strong></h3>

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
        <th>Xếp Loại</th>
        <th>Mức HB</th>
        <th>Tổng Tiền</th>
    </tr>
    <?php
    $i = $this->uri->segment(4)+1;
    foreach($kqtk as $k =>$v) {
        ?>
        <tr>
            <td><?php echo $i; ?></td>
            <td><?php echo $v['MaSV']; ?></td>
            <td><?php echo $v['HoTen']; ?></td>
            <td><?php echo $v['NgaySinh']; ?></td>
            <td><?php echo $v['MaLop']; ?></td>
            <td><?php echo $v['SoTC']; ?></td>
            <td><?php echo $v['DiemTK']; ?></td>
            <td><?php echo $v['DiemCD']; ?></td>
            <td><?php echo xep_loai($v['SoTC'], $v['DiemTK'], $v['DiemCD']); ?></td>
            <td>
                <?php
                $mucHB = muc_hoc_bong($v['SoTC'], $v['DiemTK'], $v['DiemCD']);
                echo number_format($mucHB);
                ?>
            </td>
            <td><?php echo number_format($mucHB * 5); ?></td>
        </tr>
        <?php
        ++$i;
    }
    ?>
</table>

<div class="pagination">
<?php echo $page_link;  ?>
</div>
<p>
    <a href="<?php echo base_url('canbo/timkiemsvnt'); ?>" class="btn" ><i class="icon-chevron-left"></i>Quay Lại</a>
</p>