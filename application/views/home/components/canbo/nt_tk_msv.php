<h4 class="text-center">Danh sách địa chỉ ngoại trú của sinh viên</h4>
<table class="table">
    <tr>
        <td>Mã SV:</td>
        <td><?php echo $sv->masv; ?></td>
    </tr>
    <tr>
        <td>Tên SV:</td>
        <td><?php echo $sv->hoten; ?></td>
    </tr>
    <tr>
        <td>Ngày sinh: </td>
        <td><?php echo date('m-d-Y',strtotime($sv->ngaysinh));; ?></td>
    </tr>
    <tr>
        <td>Lớp:</td>
        <td><?php echo $sv->malop; ?></td>
    </tr>
</table>

<div class='mesage_show'></div>
<table class="table table-bordered table-striped ngoaitru table-hover">
    <tr>
        <th>STT</th>
        <th>Mã ngoại trú</th>
        <th>Tên Chủ Trọ</th>
        <th>Số Điện Thoại</th>
        <th>Địa Chỉ</th>
        <th>Ngày Đến</th>
        <th>Ngày Đi</th>
        <th>Sửa</th>
        <th>Xóa</th>
    </tr>
    <?php
    $i = $this->uri->segment(6)+1;
    foreach($kqtk as $kq) :
    ?>
        <tr>
            <td><?php echo $i; ?></td>
            <td><p class="ma_nt"><?php echo $kq['MaNT']; ?></p></td>
            <td><?php echo $kq['TenChuTro']; ?></td>
            <td><?php echo $kq['DienThoai']; ?></td>
            <td><?php echo $kq['DiaChi'].'-'.$kq['TenPhuong'].'-'.$kq['TenQuan']; ?></td>
            <td><?php echo date('d-m-Y',strtotime($kq['NgayDen'])); ?></td>
            <td><?php echo strtotime($kq['NgayDi']) != 0 ? date('d-m-Y',strtotime($kq['NgayDi'])) : ""; ?></td>
            <td><a href="<?php echo base_url('canbo').'/suaTTNT/'.$kq['MaNT'];?>">Sửa</a></td>
            <td><a id="<?php echo $kq['MaNT'] ?>" class="btn btn-primary xoa">Xóa</a>
        </tr>
    <?php 
        $i++;
    endforeach;
    ?>
</table>
<div class="pagination">
<?php echo $page_link;  ?>
</div>
<p>
    <a href="<?php echo base_url('canbo/timkiemsvnt'); ?>" class="btn" /><i class="icon-chevron-left"></i>Quay Lại</a>
    <a href="<?php echo base_url('canbo').'/thongkesvnt/'.$tc.'/'.$mahk.'/'.$nd;?>" onclick="mocuaso('<?php echo base_url('canbo').'/thongkesvnt/'.$tc.'/'.$mahk.'/'.$nd;?>',1000,700);return false;" class="btn btn-success"><i class="icon-print icon-white"></i> In Thống Kê</a>
</p>

<script>

function mocuaso(website,rong,cao) {
    var windowprops='width=100,height=100,scrollbars=yes,s tatus=yes,resizable=no'
    var heightspeed = 15;
    var widthspeed = 15;
    var leftdist = 10;
    var topdist = 10;
    if (window.resizeTo&&navigator.userAgent.indexOf("Ope ra")==-1) {
        var winwidth = window.screen.availWidth - leftdist;
        var winheight = window.screen.availHeight - topdist;
        var sizer = window.open("","","left=" + leftdist + ",top=" + topdist +","+ windowprops);
        for (sizeheight = 1; sizeheight < cao; sizeheight += heightspeed)
        sizer.resizeTo("1", sizeheight);
        for (sizewidth = 1; sizewidth < rong; sizewidth += widthspeed)
            sizer.resizeTo(sizewidth, sizeheight);
        sizer.location = website;
    }else
        window.open(website,'mywindow');
}
$( document ).ready(function() {
    $( "a.xoa" ).click(function() {
        var check = window.confirm("Bạn muốn xóa chứ?");
        if(check == true){
            var id =$(this).attr("id");
            $.ajax({
                    type: 'GET',
                    url: '<?php echo site_url(); ?>canbo/xoaNT/'+id,
                    success: function(data) {
                        $('.mesage_show').html(data);
                        window.setTimeout(function(){location.reload()},1000)
                    }
                });    
        }
    });
});
</script>