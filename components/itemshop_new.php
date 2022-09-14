<?php $oldshop = mysqli_query($mysqli2, "SELECT * FROM table_store WHERE curdate()>=date_add(created_at,interval -5 day) LIMIT 4"); ?>
<?php if (mysqli_num_rows($oldshop) !== 0) { ?>
<div class=" row row-cols-4 g-3">
    <?php while ($olditem = mysqli_fetch_array($oldshop)) { ?>
    <div class="col">
        <div class=" card card-bg border-0 shadow rounded-4  position-relative shop-hover h-100">
            <div class=" card-body position-relative">
                <div class=" w-100 d-flex justify-content-center align-items-center">
                    <img src="<?= $olditem['image'] ?>" alt="logo item" width="150px" height="150px">
                </div>
                <div class="mb-2">
                    <div class="w-100 d-flex justify-content-center">
                        <hr class=" <?php echo $fn_bg ?>  rounded-pill card-hr opacity-100" style="padding: 2px; ">
                    </div>
                    <p class=" text-white m-0 fs-4 text-center"><?= $olditem['name'] ?> x<?= $olditem['unitvalue'] ?>
                    </p>
                    <div class=" w-100 d-flex justify-content-center">
                        <p class="text-white bg-danger rounded-pill text-center m-0" style="width:100px">สินค้าใหม่</p>
                        <p class="text-dark <?php echo $fn_bg ?> rounded-pill text-center m-0" style="width:100px">
                            <?= $olditem['server'] ?></p>
                    </div>
                    <p class="lh-1 text-center text-white-50 tl-2"><?= $olditem['subname'] ?></p>
                </div>
                <?php if (!empty($_SESSION['authme_username'])) { ?>
                <div class=" d-flex justify-content-between">
                    <p class=" m-0 <?php echo $fn_text ?> fs-4"><?= $olditem['price'] ?> Point</p>
                    <div>
                        <button class="btn btn-primary shadow-none py-1" data-bs-toggle="modal"
                            data-bs-target="#iditemall" data-html="<?= $olditem['html'] ?>">ดูข้อมูล</button>
                        <button id="btn1" class="btn btn-warning shadow-none py-1" data-bs-toggle="modal"
                            data-bs-target="#itemshopall" data-id="<?= $olditem['id'] ?>"
                            data-name="<?= $olditem['name'] ?>" data-image="<?= $olditem['image'] ?>"
                            data-unitvalue="<?= $olditem['unitvalue'] ?>" data-server="<?= $olditem['server'] ?>"
                            data-subname="<?= $olditem['subname'] ?>"
                            data-price="<?= $olditem['price'] ?>">ซื้อเลย</button>
                    </div>
                </div>
                <?php } else { ?>
                <div class=" d-flex justify-content-center fit">
                    <button disabled class="btn btn-danger shadow-none py-1">โปรดทำการ Login ก่อน</button>
                </div>
                <?php } ?>
            </div>
        </div>
    </div>
    <?php } ?>
</div>
<?php } else { ?>
<div class=" d-flex justify-content-center flex-column h-100">
    <div class=" w-100 h-100 text-center">
        <i class="bi bi-cart-x text-danger fs-1 m-0"></i>
        <p class=" text-white-50  lh-1">ยังไม่มีสินค้าในตอนนี้</p>
    </div>
</div>
<?php } ?>