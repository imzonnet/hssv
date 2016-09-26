<table class="table table-bordered table-hover table-striped">
    <tr>
        <th>STT</th>
        <th>Chủ Trọ</th>
        <th>SĐT</th>
        <th>Địa Chỉ</th>
        <th>Ngày Đến</th>
        <th>Ngày Đi</th>
        <th>Học Kỳ</th>
        <th>Cập Nhật</th>
    </tr>
    <?php
    //var_dump($ds_nt);
    $i = 1;
    foreach($ds_nt as $k)
    {
    ?>
        <tr>
            <td><?php echo $i; ?></td>
            <td><?php echo stripslashes($k['TenChuTro']); ?></td>
            <td><?php echo $k['DienThoai']; ?></td>
            <td><?php echo stripslashes($k['DiaChi']); ?></td>
            <td><?php echo $k['NgayDen']; ?></td>
            <td><?php echo $k['NgayDi']; ?></td>
            <td><?php echo $k['MaHK']; ?></td>
            <td>
                <?php if(strlen($k['NgayDi'])<1) : ?>
                <div class="btn-group">
                    <a href="sinhvien/editngoaitru/edit/<?php echo $k['MaNT']; ?>" title="Edit" class="btn btn-info"><i class="icon-edit icon-white"></i>Cập nhật</a>
                </div>
                <?php endif; ?>
            </td>
        </tr>
    <?php
    $i++;
    }
    ?>
    
    
</table>
<p>
    <a href="sinhvien" title="Edit" class="btn btn-inverse">Trở về</a>
    <a href="sinhvien/addngoaitru" title="Delete" class="btn btn-primary">Thêm địa chỉ ngoại trú</a>
</p>
<!--
<div class="pagination">
    <ul>
        <li><a href="#">Prev</a></li>
        <li class="active"><a href="#">1</a></li>
        <li><a href="#">2</a></li>
        <li><a href="#">3</a></li>
        <li><a href="#">4</a></li>
        <li><a href="#">5</a></li>
        <li><a href="#">Next</a></li>
    </ul>
</div><!--paging page-->