<?php
if ($ds == false) redirect(base_url('canbo/thongtintuyendung'));
if ($this->session->flashdata('success_mgs') != '') {
    echo "<div class='alert alert-success' role='alert'><strong>" . $this->session->flashdata('success_mgs') . "</strong></div>";
}
?>
<table class="table table-bordered table-hover table-striped">
    <thead>
    <tr>
        <th>Mã Số</th>
        <th>Tiêu Đề</th>
        <th>Ngày đăng</th>
        <th>Người Đăng</th>
        <th>Chỉnh sửa</th>
        <th>Xóa</th>
    </tr>
    </thead>
    <tbody>
    <?php
    foreach ($ds as $k => $v) {
        ?>
        <tr>
            <td><?php echo $v['MaSo']; ?></td>
            <td>
                <a href='<?php echo base_url('canbo/xemtintuyendung') . '/' . $v['MaSo']; ?>'><?php echo $v['TieuDe']; ?></a>
            </td>
            <td><?php echo $v['NgayDangTin']; ?></td>
            <td><?php echo $v['TenCb']; ?></td>
            <td>
                <button type="button" class="btn btn-info" data-toggle="modal"
                        data-target="#modal-<?php echo $v['MaSo']; ?>">Sửa
                </button>
                <!-- form modal edit -->
                <div id="modal-<?php echo $v['MaSo']; ?>" class="modal hide fade" tabindex="1" role="dialog"
                     aria-labelledby="myModalLabel" aria-hidden="true">
                    <form action="<?php echo base_url('canbo/suatintuyendung'); ?>" method="POST">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            <h3>Chỉnh sửa tin:<?php echo $v['MaSo']; ?></h3>
                        </div>
                        <div class="modal-body">
                            <p>Tiêu đề</p>
                            <input type="hidden" name="MaSo" value="<?php echo $v['MaSo']; ?>">
                            <input type="text" name="TieuDe" value="<?php echo $v['TieuDe']; ?>">
                            <div class="control-group">
                                <p class="control-label">Nội Dung</p>
                                <div class="controls">
                                    <textarea name="NoiDung" class="form-control"> <?php echo $v['NoiDung']; ?></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button class="btn" data-dismiss="modal" aria-hidden="true">Đóng</button>
                            <input class="btn btn-primary" type="submit" name="tuyendung_edit_submit"
                                   onclick="myFunction(<?php echo $v['MaSo']; ?>)" value="Lưu thay đổi">
                        </div>
                    </form>
                </div>
                <!-- end form modal edit -->
            </td>
            <td>
                <button type="button" class="btn btn-small confirmbutton" onclick="xoatin(<?php echo $v['MaSo']; ?>)">
                    <i class="icon-trash"></i>
                </button>
            </td>
            <td id="rs"></td>
        </tr>
    <?php } ?>
    </tbody>
</table>
<p><b>Results:</b> <span id="results"></span></p>
<a href='<?php echo base_url('canbo/themtintuyendung'); ?>' class="btn btn-primary">Thêm tin</a>
<div class="pagination">
    <?php echo $page_link; ?>
</div>
<script type="text/javascript">
    function xoatin(id) {
        if (confirm("Bạn muốn xóa chứ?")) {
            $.ajax({
                type: 'POST',
                data: {id: id},
                url: '<?php echo base_url('canbo/xoatintuyendung') . '/'; ?>' + id,
                success: function () {
                    alert("Xóa thành công!");
                    window.location = "<?php echo base_url('canbo/thongtintuyendung'); ?>";
                }
            });
            return false;
        }
    }
</script>