<?php
$shop = mysqli_query($mysqli2, "SELECT * FROM table_store");
$oldshop = mysqli_query($mysqli2, "SELECT * FROM table_store WHERE curdate()>=date_add(created_at,interval -5 day)");

?>
<?php if (mysqli_num_rows($shop) == 0) { ?>
    <div class=" d-flex justify-content-center flex-column h-100">
    <div class=" w-100 h-100 text-center">
        <i class="bi bi-cart-x text-danger fs-1 m-0"></i>
        <p class=" text-white-50  lh-1">ยังไม่มีสินค้าในตอนนี้</p>
    </div>
</div>
<?php } else { ?>
    <div class=" row row-cols-4 g-3">
        <div class="col">
            <?php while ($item = mysqli_fetch_array($shop)) { ?>
                <div class=" card card-bg border-0 shadow rounded-4  position-relative shop-hover h-100">
                    <div class=" card-body">
                        <div class=" w-100 d-flex justify-content-center align-items-center">
                            <img src="<?= $item['image'] ?>" alt="logo item" width="150px" height="150px">
                        </div>
                        <div class="mb-2">
                            <div class="w-100 d-flex justify-content-center">
                                <hr class=" <?php echo $fn_bg ?>  rounded-pill card-hr opacity-100" style="padding: 2px; ">
                            </div>
                            <p class=" text-white m-0 fs-4 text-center"><?= $item['name'] ?> x<?= $item['unitvalue'] ?></p>
                            <div class=" w-100 d-flex justify-content-center">
                                <p class="text-dark <?php echo $fn_bg ?> rounded-pill text-center m-0" style="width:100px"><?= $item['server'] ?></p>
                            </div>
                            <p class="lh-1 text-center text-white-50 tl-2"><?= $item['subname'] ?></p>
                        </div>
                        <?php if (!empty($_SESSION['authme_username'])) { ?>
                            <div class=" d-flex justify-content-between">
                                <p class=" m-0 <?php echo $fn_text ?> fs-4"><?= $item['price'] ?> Point</p>
                                <div>
                                    <button class="btn btn-primary shadow-none py-1" data-bs-toggle="modal" data-bs-target="#iditemall" data-html="<?= $item['html'] ?>">ดูข้อมูล</button>
                                    <button id="btn1" class="btn btn-warning shadow-none py-1" data-bs-toggle="modal" data-bs-target="#itemshopall" data-id="<?= $item['id'] ?>" data-name="<?= $item['name'] ?>" data-image="<?= $item['image'] ?>" data-unitvalue="<?= $item['unitvalue'] ?>" data-server="<?= $item['server'] ?>" data-subname="<?= $item['subname'] ?>" data-price="<?= $item['price'] ?>">ซื้อเลย</button>
                                </div>
                            </div>
                        <?php } else { ?>
                            <div class=" d-flex justify-content-center">
                                <button disabled class="btn btn-danger shadow-none py-1">โปรดทำการ Login ก่อน</button>
                            </div>
                        <?php } ?>
                    </div>
                </div>
        </div>
    <?php } ?>
    </div>
<?php } ?>
<?php include('components/modelitemshop.php') ?>
