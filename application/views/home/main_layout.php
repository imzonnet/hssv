<?php
include_once("includes/header.php");
include_once("includes/cb.php");
?>

    <div id="primary" class="span9 widget">
        <h3 class="nav-header">.:::. <?php echo isset($task_name) ? $task_name : "Home"; ?></h3>

        <div id="main-content" class="container-fluid">

            <?php
            $l_view = isset($sub_views) ? "home/components/canbo/" . $sub_views : "home/components/main_view";
            $this->load->view($l_view);
            ?>

        </div><!-- edn #main-content-->
    </div><!--end #primary-->


<?php include_once("includes/footer.php"); ?>