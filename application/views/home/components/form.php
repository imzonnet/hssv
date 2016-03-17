<div class="alert alert-success">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    <h4>Thành công</h4>
    Hello Succes
</div><!-- end box alert-->
<div class="alert alert-warring">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    <h4>Thành công</h4>
    Hello Succes
</div><!-- end box alert-->

<div class="alert alert-error">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    <h4>Thành công</h4>
    Hello Succes
</div><!-- end box alert-->

<form class="form-horizontal">

    <div class="control-group">
        <label class="control-label">Tên chủ trọ</label>
        <div class="controls">
            <input type="text" name="name" placeholder="Nguyễn Đức Anh">
            <i class="icon-star-empty"></i>
        </div>
        
    </div>
    <div class="control-group">
        <label class="control-label">Số điện thoại</label>
        <div class="controls">
            <input type="text" name="phone" placeholder="0987987987">
            <i class="icon-star-empty"></i>
        </div>
    </div>
    
    <div class="control-group">
        <label class="control-label">Địa chỉ ngoại trú:</label>
        <div class="controls">
            <input type="text" name="address" placeholder="Email">
            <i class="icon-star-empty"></i>
        </div>
        
    </div>
    
    <div class="control-group">
        <label class="control-label">Quận</label>
        <div class="controls">
            <select name="district">
                <option value="1">Thanh Binh</option>
                <option value="1">Thanh Binh</option>
                <option value="1">Thanh Binh</option>
                <option value="1">Thanh Binh</option>
            </select>
            
            <i class="icon-star-empty"></i>
        
            <i class="icon-refresh"></i>
        </div>
    </div>
    <div class="control-group">
        <label class="control-label" for="inputPassword">Phường</label>
        <div class="controls">
            <select name="ward">
                <option value="1">Thanh Binh</option>
                <option value="1">Thanh Binh</option>
                <option value="1">Thanh Binh</option>
                <option value="1">Thanh Binh</option>
            </select>
            
            <i class="icon-star-empty"></i>
        </div>
    </div>
    
    <div class="control-group">
        <label class="control-label">Ngày đến</label>
        <div class="controls">
            <div id="datetimepicker1" class="controls input-append datetimepicker">
                <input type="text" name="date-start" disabled="disabled" id="disabledInput" />
                <span class="add-on">
                  <i data-time-icon="icon-time" data-date-icon="icon-calendar" class="icon-calendar"></i>
                </span>
            </div>
            <i class="icon-star-empty"></i>
        </div>
    </div>
    
    <div class="control-group">
        <label class="control-label">Ngày đi</label>
        <div class="controls">
            <div id="datetimepicker2" class="controls input-append datetimepicker">
                <input type="text" name="date-end" disabled="disabled" id="disabledInput" />
                <span class="add-on">
                  <i data-time-icon="icon-time" data-date-icon="icon-calendar" class="icon-calendar"></i>
                </span>
            </div>
            
        </div>
    </div>
    
    <div class="control-group">
        <div class="controls">
            <button type="reset" class="btn">Reset</button>
            <button type="submit" class="btn btn-primary">Submint</button>
        </div>
    </div>
</form>
