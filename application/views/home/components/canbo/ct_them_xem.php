<h4 class="text-center">DANH SÁCH SINH VIÊN CHÍNH TRỊ ĐẦU KHÓA</h4>
<form action="canbo/themsvnt" method="post">
    <table class="table table-bordered table-striped ngoaitru">
        <tr>
            <th>STT</th>
            <th>Số BD</th>
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
                <td><?php echo $i; ?></td>
                <td><?php echo $v['sbd']; ?></td>
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