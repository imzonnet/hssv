<table class="table table-bordered table-hover table-striped">
    <caption><?php echo $task_name; ?></caption>
    <thead>
        <tr>
            <th>STT</th>
            <th>Mã Yêu Cầu</th>
            <th>Học Kỳ</th>
            <th>Ngày Yêu Cầu</th>
            <th>Số Đơn</th>
            <th>Chi Tiết</th>
        </tr>
    </thead>
    <tbody>
    <?php
        $i = 1;
        foreach($list_yccg as $k => $v)
        {
            echo "<tr> 
                    <td>$i</td>
                    <td>{$v['mayc']}</td>
                    <td>{$v['mahk']}</td>
                    <td>{$v['ngayyc']}</td>
                    <td>{$v['sodon']}</td>
                    <td>
                        <div  class='btn-group'>
                            <a href='".base_url('sinhvien/xemyeucau')."/{$v['mayc']}' class='btn btn-info' title='Xem chi tiết'><i class='icon-eye-open icon-white'></i> Chi Tiết</a>
                            <a href='".base_url('sinhvien/xoagxn')."/{$v['mayc']}' class='btn btn-danger' title='Xóa yêu cầu'><i class='icon-trash icon-white'></i> Xóa</a>
                        </div>
                    </td>
                </tr>";
            $i++;
        }
    ?>
        
        
    </tbody>
</table>
<div class="pagination">
<?php echo $page_link;  ?>
</div>
<p>
    <a href="sinhvien" title="Trang chủ" class="btn btn-inverse">Trở về</a>
    <a href="sinhvien/yeucaucapgiay" title="Yêu cầu cấp giấy" class="btn btn-primary">Gửi yêu cầu cấp giấy</a>
</p>