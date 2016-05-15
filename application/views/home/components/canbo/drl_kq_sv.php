<div class='mesage_show'></div>
<ul class='unstyled'>
	<li id="">Mã sinh viên: <?php echo $sv->masv; ?></li>
	<li>Họ và tên: <?php echo $sv->hoten; ?></li>
	<li>Lớp: <?php echo $sv->malop; ?></li>
</ul>
<table class="table table-bordered table-striped">
    <tr>
        <th>Học Kỳ</th>
        <th>Điểm</th>
        <th>Điểm Quy Đổi</th>
        <th>Xếp Loại</th>
        <th>Ngày XN</th>
        <th>Xóa</th>
    </tr>
    <?php foreach($kqtk as $k => $v) : ?>
        <tr>
            <td class="mahk"><?php echo $v['MaHK']; ?></td>
            <td><?php echo $v['Diem']; ?></td>
            <td><?php echo $v['DiemCD']; ?></td>
            <td><?php echo $v['XepLoai']; ?></td>
            <td><?php echo $v['NgayXN']; ?></td>
            <td><a name="<?php echo $sv->masv; ?>" id="<?php echo $v['MaHK'] ?>" class="btn btn-primary xoa">Xóa</a>
        </tr>
    <?php endforeach; ?>
</table>
<p>
    <a href="canbo/timkiemdrl" class="btn btn-inverse" onclick="history.go(-1);">Trở về</a>
</p>
<script>
    $( document ).ready(function() {
        $( "a.xoa" ).click(function() {
            var check = window.confirm("Bạn muốn xóa chứ?");
            if(check == true){
                var mahk =$(this).attr("id");
                var masv = $(this).attr("name");
                $.ajax({
                        type: 'POST',
                        data:{
                            'MaHK' : mahk,
                            'MaSV' : masv
                        },
                        url: '<?php echo site_url(); ?>canbo/xoaDRL/',
                        success: function(data) {
                            $('.mesage_show').html(data);
                            window.setTimeout(function(){location.reload()},1000)
                        }
                    });    
            }
        });
    });
</script>