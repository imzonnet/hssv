<table class="table table-bordered table-hover table-striped">
    <thead>
        <tr>
            <th>STT</th>
            <th>Phòng</th>
            <th>Loại Phòng</th>
            <th>Số lượng</th>
            <th>Hiện đã ở</th>
            <th>Đang đăng ký</th>
        </tr>
    </thead>
    <tbody>
    <?php
        $i = 1;
        foreach($rs as $k){
    ?>
        <tr>
            <td><?php echo $i; ?></td>
            <td><?php echo $k['MaPhong']; ?></td>
            <td>
            <?php 
                    if($k['LoaiPhong']==1)
                        echo "Nam"; 
                    else
                        echo "Nữ";
                ?>
            </td>
            <td><?php echo $k['SoLuong']; ?></td>
            
            <td><?php
                    if($k['HienDangO']<=0){
                        echo $k['HienDangO'];
                    }
                    else{
                    ?>
                        <?php echo $k['HienDangO'];?>&nbsp;&nbsp;&nbsp;&nbsp;<a href='<?php echo base_url('canbo/thongtinmotphong').'/'.$k['MaPhong'];?>'>Xem</a>
                    <?php
                    }
                    ?>
            </td>
            <td><?php
                    if($k['SoLuongDK']<=0){
                        echo $k['SoLuongDK'];
                    }
                    else{
                    ?>
                        <?php echo $k['SoLuongDK'];?>&nbsp;&nbsp;&nbsp;&nbsp;<a href='<?php echo base_url('canbo/dsSvDkMotPhong').'/'.$k['MaPhong'];?>'>Xem</a>
                    <?php
                    }
                    ?>
            </td>
        </tr>
    <?php
            $i++;
        }
    ?>
    </tbody>
</table>