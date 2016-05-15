
<form name="frmSearch" method="post" class="form-horizontal" action="<?php echo base_url('canbo/danhsachhb'); ?>/">
    <div class="control-group">
        <label class="control-label">
            Học kỳ:
        </label>
        <div class="controls">
            <select name="mahk" class="span2">
                <?php
                    foreach($ds_hk as $k => $v)
                    {
                        echo '<option value="'.$v['MaHK'].'">'.$v['MaHK'].'</option>';
                    }
                ?>
            </select>
        </div>
    </div>
    <div class="control-group">
        <div class="controls">
            <input type="submit" name="search" value="Tìm kiếm" class="btn btn-primary" />
        </div>
    </div>
</form>
