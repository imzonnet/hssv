<form action="canbo/dsyccg" method="post" class="form-search" name="fixds" id="fixds">
    <div class="input-prepend input-append">
        <select name="tc" class="btn span4">
            <option value="2">Mã Sinh Viên</option>
            <option value="1">Mã Yêu Cầu</option>
        </select>
        <input type="text" placeholder="Nhập yêu cầu tìm kiêm" name="key"/>
        <button type="submit" name="search" class="btn" value="search">Tìm kiếm</button>
    </div>
    <div id="message-box"></div>
</form>
<script>
$().ready(function(){
    $('#fixds').validate({
        rules : {
            key : {
                required : true,
                number : true
            }
        },
        messages : {
            key : {
                required: "Nội dung tìm kiếm Không được để trống!",
                number: "Giá trị nhập vào không hợp lệ, chỉ được nhập số!"
            }
        },
        errorLabelContainer: '#message-box'
    }); 
});
</script>
<table class="table table-bordered table-hover table-striped">
    <thead>
        <tr>
            <th>STT</th>
            <th>Mã Yêu Cầu</th>
            <th>Mã Sinh Viên</th>
            <th>Ngày Yêu Cầu</th>
            <th>Học Kỳ</th>
            <th>Số Đơn</th>
            <th>Xác Nhận</th>
        </tr>
    </thead>
    <tbody>
    <?php
        $i = 1;
        foreach($list_yccg as $k){
    ?>
        <tr>
            <td><?php echo $i; ?></td>
            <td><?php echo $k['mayc']; ?></td>
            <td><?php echo $k['masv']; ?></td>
            <td><?php echo $k['ngayyc']; ?></td>
            <td><?php echo $k['mahk']; ?></td>
            <td><?php echo $k['sodon']; ?></td>
            <td><a href='<?php echo base_url('canbo/xemyccg').'/'.$k['mayc'];?>' class="btn btn-info"><i class="icon-eye-open icon-white"></i>Chi Tiết</a></td>
        </tr>
    <?php
            $i++;
        }
    ?>
    </tbody>
</table>
<div class="pagination">
    <?php echo $page_link; ?>
</div>