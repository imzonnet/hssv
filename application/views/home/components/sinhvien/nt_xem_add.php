<div class="span5">
    <form class="form-horizontal" method="post" action="<?php echo base_url(); ?>sinhvien/addngoaitru" id="ngoaitru">
                        
        <div class="control-group">
            <label class="control-label" for="ten">Tên chủ trọ <i class="icon-star-empty"></i></label>
            <div class="controls">
                <input type="hidden" name="ten" id="ten" placeholder="Nguyễn Đức Anh" value="<?php echo isset($input['ten']) ? htmlspecialchars($input['ten']) : null; ?>" />
                <?php echo isset($input['ten']) ? htmlspecialchars($input['ten']) : null; ?>
            </div>
            
        </div>
        <div class="control-group">
            <label class="control-label">Số điện thoại <i class="icon-star-empty"></i> </label>
            <div class="controls">
                <input type="hidden" name="sodt"  id="sodt" placeholder="0987987987" value="<?php echo isset($input['sodt']) ? htmlspecialchars($input['sodt']) : null; ?>"/>
                <?php echo isset($input['sodt']) ? htmlspecialchars($input['sodt']) : null; ?>
            </div>
        </div>
        
        <div class="control-group">
            <label class="control-label" for="diachi">Địa chỉ ngoại trú <i class="icon-star-empty"></i></label>
            <div class="controls">
                <input type="hidden" name="diachi" id="diachi" placeholder="48 Cao Thắng" value="<?php echo isset($input['diachi']) ? $input['diachi'] : null; ?>" />
                <?php echo isset($input['diachi']) ? htmlspecialchars($input['diachi']) : null; ?>
            </div>
        </div>
        
        <div class="control-group">
            <label class="control-label" for="quan">Quận <i class="icon-star-empty"></i></label>
            <div class="controls">
                <input type="hidden" name="quan" id="quan" value="<?php echo isset($input['quan']) ? $input['quan'] : null; ?>" />
                <?php echo isset($input['tquan']) ? $input['tquan'] : null; ?>
            </div>
        </div>
        <div class="control-group">
            <label class="control-label" for="phuong">Phường <i class="icon-star-empty"></i></label>
            <div class="controls">
                <input type="hidden" name="phuong" id="phuong" value="<?php echo isset($input['phuong']) ? $input['phuong'] : null; ?>" />
                <?php echo isset($input['tphuong']) ? $input['tphuong'] : null; ?>
            </div>
        </div>
        
        <div class="control-group">
            <label class="control-label" for="ngayden">Ngày đến <i class="icon-star-empty"></i></label>
            <div class="controls">
                    <input type="hidden" name="ngayden" class="span12" id="ngayden" value="<?php echo isset($input['ngayden']) ? $input['ngayden'] : null; ?>"/>
                    <?php echo isset($input['ngayden']) ? $input['ngayden'] : null; ?>
            </div>
        </div>
        
        <div class="control-group">
            <label class="control-label" for="ngaydi">Ngày đi</label>
            <div class="controls">
                    <input type="hidden" class="span12" name="ngaydi" id="ngaydi" value="<?php echo isset($input['ngaydi']) ? $input['ngaydi'] : null; ?>"/>
                    <?php echo isset($input['ngaydi']) ? $input['ngaydi'] : null; ?>
            </div>
        </div>
        
        <div class="control-group text-center">
                <button type="submit" class="btn btn-inverse" onclick="history.go(-1)">Chỉnh sửa</button>
                <button type="submit" class="btn btn-primary" name="add" id="add" value="ok">Thêm</button>
        </div>
    </form>
</div>
<div class="span6 alert alert-danger">
    <strong>Chú ý:</strong><br />
    Những thông tin về địa chỉ ngoại trú phải chính xác.<br />Sau khi thêm sẽ <strong><u>không có quyền chỉnh sửa</u></strong><br />
    Sinh viên vui lòng <strong><u>kiểm tra</u></strong> lại trước khi <strong><u>Xác nhận thêm</u></strong>
</div>