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
                    echo "<a href='sinhvien/kiemtragxn/$mayc/{$v['malg']}'>Xem chi tiết</a>";
             echo   "</td></tr>";
            $i++;
        }
    ?>
    </tbody>
</table>
<div class="alert alert-success">
    Sau khi phòng HSSV xác nhận xong. Vui Lòng bạn lên và lấy giấy tờ đúng theo yêu cầu của bạn.<br />
    Để thuận tiện và tìm kiếm nhanh chóng. Vui lòng nhớ lấy <strong><u>Mã Số Yêu Cầu</u></strong> của bạn<br />
    
    <strong style="color: red"><u>Mã Số Yêu Cầu: <?php echo $mayc; ?></u></strong>
</div>
<p><a href="sinhvien/dsyeucau" class="btn btn-inverse" >Trở Về</a></p>