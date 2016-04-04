<?php if(!$ds) redirect("canbo/themdiemctdk"); ?>
<h4 class="text-center">DANH SÁCH SINH VIÊN CHÍNH TRỊ ĐẦU KHÓA</h4>
<form action="canbo/addctdaukhoa" method="post">
    <table class="table table-bordered table-striped ngoaitru">
        <tr>
            <th>STT</th>
            <th>Mã SV</th>
            <th>Biên Lai</th>
            <th>Họ Tên</th>
            <th>Ngày Sinh</th>
            <th>Ngành</th>
            <th>Lớp</th>
        </tr>
    <?php
        $i = 1;
        foreach($ds as $k =>$v) {
    ?>
            <tr>
                <td><?php echo $v['stt']; ?></td>
                <td><?php echo $v['masv']; ?></td>
                <td><?php echo $v['bienlaiso']; ?></td>
                <td><?php echo $v['hovachulot'].' '.$v['ten']; ?></td>
                <td><?php echo $v['ngaysinh']; ?></td>
                <td><?php echo $v['nganh']; ?></td>
                <td><?php echo $v['lop']; ?></td>
            </tr>
    <?php
            ++$i;
        }
    ?>
    </table>
    <a href='canbo/themdiemctdk' class="btn btn-inverse">Hủy Bỏ</a>
    <button type="submit" name="done" class="btn btn-primary" value="ok">Xác Nhận</button>
</form>