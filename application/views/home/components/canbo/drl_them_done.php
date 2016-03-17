<?php if($dem>0) : ?>
    <div class="alert alert-success">Có <?php echo $dem ?> sinh viên được thêm danh sách thành công!</div>
<?php else : ?>
    <div class="alert alert-error">Tất cả sinh viên lớp này đã có bảng điểm tại kì <b><?php echo $mahk; ?></b>!
<?php endif; ?>
