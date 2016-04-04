<?php 
if($ds == false) redirect(base_url('canbo/thongtintuyendung'));
if($this->session->flashdata('success_mgs') != ''){
	echo "<div class='alert alert-success' role='alert'><strong>".$this->session->flashdata('success_mgs')."</strong></div>";
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
        foreach($ds as $k =>$v){
    ?>
        <tr>
            <td><?php echo $v['MaSo']; ?></td>
            <td><a href='<?php echo base_url('canbo/xemtintuyendung').'/'.$v['MaSo'];?>' ><?php echo $v['TieuDe']; ?></a></td>
            <td><?php echo $v['NgayDangTin']; ?></td>
            <td><?php echo $v['TenCb']; ?></td>
            <td><button type="button" class="btn btn-info" data-toggle="modal" data-target="#Modal-<?php echo $v['MaSo']; ?>">Sửa</button>
        <div id="Modal-<?php echo $v['MaSo']; ?>" class="modal hide fade" tabindex="1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h3 id="myModalLabel">Modal header</h3>
          </div>
          <div class="modal-body">
            <p>One fine body…</p>
          </div>
          <div class="modal-footer">
            <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
            <button class="btn btn-primary">Save changes</button>
          </div>
        </div>

            </td>
            <td><button type="button" class="btn btn-small confirmbutton" onclick="xoatin(<?php echo $v['MaSo'];?>)"><i class="icon-trash"></i></button></td>
        </tr>
    <?php } ?>
    </tbody>
</table>
<a href='<?php echo base_url('canbo/themtintuyendung');?>' class="btn btn-primary" >Thêm tin</a>
<div class="pagination">
<?php echo $page_link;  ?>
</div>
<script type="text/javascript">
	function xoatin(id) {
		if (confirm("Bạn muốn xóa chứ?")) {
		    $.ajax({
		    	type:'POST',
		    	data: { id: id},
		    	url: '<?php echo base_url('canbo/xoatintuyendung').'/'; ?>' + id,
		    	success: function(){ 
		    		alert("Xóa thành công!"); 
		    		window.location = "<?php echo base_url('canbo/thongtintuyendung'); ?>";
		    	}
		    });	
		    return false;
		}
	}
</script>

<!-- Button to trigger modal -->
<a href="#myModal" role="button" class="btn" data-toggle="modal">Launch demo modal</a>
 
<!-- Modal -->
<div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel">Modal header</h3>
  </div>
  <div class="modal-body">
    <p>One fine body…</p>
  </div>
  <div class="modal-footer">
    <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
    <button class="btn btn-primary">Save changes</button>
  </div>
</div>