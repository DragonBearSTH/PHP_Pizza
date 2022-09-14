<div class=" mt-5 pt-54">
    <div class="mb-2 ">
        <p class=" <?php echo $fn_text?> fs-2 m-0 lh-1">ประกาศจาก Server </p>
        <hr class=" <?php echo $fn_bg?> rounded-pill" style="padding: 2px; width: 100px;">
    </div>
    <div class=" shadow mb-4">
        <?php include('./components/carousel_home.php') ?>
    </div>
    <div class="mb-5">
        <?php include('./components/announce_server.php') ?>
    </div>
    <div class="mb-2 ">
        <p class=" <?php echo $fn_text?> fs-2 m-0 lh-1">กระดานคะแนน</p>
        <hr class=" <?php echo $fn_bg?>  rounded-pill" style="padding: 2px; width: 100px;">
    </div>
    <div class=" mb-4">
        <?php include('./components/leaderboards.php') ?>
    </div>
    <div class=" mb-5">
        <?php include('./components/join_server.php') ?>
    </div>
    <div class="mb-2 ">
        <p class=" <?php echo $fn_text?> fs-2 m-0 lh-1">สินค้าใหม่</p>
        <hr class=" <?php echo $fn_bg?>  rounded-pill" style="padding: 2px; width: 100px;">
    </div>
    <div class="mb-5">
        <?php include('./components/itemshop_new.php') ?>
    </div>
</div>

<?php include('./components/modelitemshop.php') ?>
