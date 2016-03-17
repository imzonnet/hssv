<h4 class="text-center"><?php echo $task_name; ?></h4>
<table class="table span5">
    <tr>
        <td>Mã SV</td>
        <td><?php echo $sv_id; ?></td>
    </tr>
    <tr>
        <td>Họ và tên: </td>
        <td><?php echo $sv_name; ?></td>
    </tr>
    <tr>
        <td>Ngày yêu cầu</td>
        <td><?php echo $list_info[0]['ngayyc']; ?></td>
    </tr>
    <tr>
        <td>Mã HK</td>
        <td><?php echo $list_info[0]['mahk']; ?></td>
    </tr>
</table>

<table class="table table-bordered table-hover table-striped">
    <thead>
        <tr>
            <th>STT</th>
            <th>Tến Loại Giấy</th>
            <th>Ngày Xác Nhận</th>
            <th>Tình Trạng</th>
            <th>Chi Tiết</th>
        </tr>
    </thead>
    <tbody>
    <?php
        $i = 1;
        foreach($list_detail as $k => $v)
        {
            if($v['trangthai'] == 0) $cl = "info";
            else if($v['trangthai'] == 1) $cl = "success";
            else $cl = "error";
            echo "<tr class='$cl'> 
                    <td>$i</td>
                    <td>{$v['tenlg']}</td>
                    <td>{$v['ngayxn']}</td>
                    <td>{$v['tinhtrang']}</td>
                    <td>";
                if($v['trangthai']==0)
                    echo "<a href='canbo/kiemtragxn/".$mayc."/{$v['malg']}'>Xác nhận</a>";
             echo   "</td></tr>";
            $i++;
        }
    ?>
    </tbody>
</table>
<p>
    <a href="canbo/dsyccg" class="btn btn-inverse">Trở về</a>
</p>