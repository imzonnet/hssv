<?php
include_once("includes/header.php");
?>
<div class="container">
    <div class="row-fluid">
        <?php 
        $l_view = isset($sub_views)?"home/components/".$sub_views:"home/components/main_view";
        $this->load->view("$l_view"); 
        ?>

<?php include_once("includes/footer.php"); ?>