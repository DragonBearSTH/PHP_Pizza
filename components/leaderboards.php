<?php $doate_rate = mysqli_query($mysqli2, "SELECT SUM(amount),username,TYPE FROM table_history GROUP BY username") ?>
<div class="row row-cols-3">
    <div class=" col">
        <div class=" card border border-warning shadow rounded-4 overflow-hidden card-bg h-100">
            <div class=" card-header text-center text-warning ">เติมเงินเยอะที่สุด</div>
            <div class=" card-body">
                <?php if (mysqli_num_rows($doate_rate) !== 0) { ?>
                <?php while ($donate_1 = mysqli_fetch_array($doate_rate)) { ?>
                <div class=" d-flex justify-content-between py-2">
                    <div class=" text-warning"><img src="https://minotar.net/avatar/<?= $donate_1[1] ?>" alt=""
                            class=" rounded-2 ms-2" width="25px"></div>
                    <p class=" text-white m-0"><?= $donate_1[1] ?></p>
                    <p class=" text-white m-0"><?= $donate_1[2] ?></p>
                    <p class=" text-warning m-0"><?= $donate_1[0] ?></p>
                </div>
                <?php } ?>
                <?php } else { ?>
                    <div class=" d-flex justify-content-center flex-column h-100">
                    <div class=" w-100 h-100 text-center">
                        <i class="bi bi-controller text-danger fs-1 m-0"></i>
                        <p class=" text-white-50 m- lh-1">ยังไม่มีการจัดอันดับ</p>
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>
    </div>
    <?php $doate_rate2 = mysqli_query($mysqli2, "SELECT * FROM table_history ORDER BY id DESC") ?>
    <div class=" col">
        <div class=" card border border-warning shadow rounded-4 overflow-hidden card-bg h-100">
            <div class=" card-header text-center text-warning ">เติมเงินล่าสุด</div>
            <div class=" card-body">
                <?php if (mysqli_num_rows($doate_rate2) !== 0) { ?>
                <?php while ($donate_2 = mysqli_fetch_array($doate_rate2)) { ?>
                <div class=" d-flex justify-content-between py-2">
                    <div class=" text-warning"><img src="https://minotar.net/avatar/<?= $donate_2['username'] ?>" alt=""
                            class=" rounded-2 ms-2" width="25px"></div>
                    <p class=" text-white m-0"><?= $donate_2['username'] ?></p>
                    <p class=" text-white m-0"><?= $donate_2['type'] ?></p>
                    <p class=" text-warning m-0"><?= $donate_2['amount'] ?></p>
                </div>
                <?php } ?>
                <?php } else { ?>
                    <div class=" d-flex justify-content-center flex-column h-100">
                    <div class=" w-100 h-100 text-center">
                        <i class="bi bi-controller text-danger fs-1 m-0"></i>
                        <p class=" text-white-50 m- lh-1">ยังไม่มีการจัดอันดับ</p>
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>
    </div>
    <?php $history_item = mysqli_query($mysqli2, "SELECT * FROM table_history_item LIMIT 10") ?>
    <div class=" col">
        <div class=" card border border-info shadow rounded-4 overflow-hidden card-bg h-100">
            <div class=" card-header text-center text-info ">ซื้อสินค้าล่าสุด</div>
            <div class=" card-body">
                <?php if (mysqli_num_rows($history_item) !== 0) { ?>
                <?php while ($fetc_his = mysqli_fetch_array($history_item)) { ?>
                <div class=" d-flex justify-content-between py-2">
                    <div class="text-info"><img src="https://minotar.net/avatar/<?= $fetc_his['username'] ?>" alt=""
                            class=" rounded-2 ms-2" width="25px"></div>
                    <p class=" text-white m-0"><?= $fetc_his['username'] ?></p>
                    <p class=" text-white m-0"><?= $fetc_his['name'] ?></p>
                    <p class=" text-info m-0"><?= $fetc_his['valueini'] ?> ชิ้น</p>
                </div>
                <?php } ?>
                <?php } else { ?>
                <div class=" d-flex justify-content-center flex-column h-100">
                    <div class=" w-100 h-100 text-center">
                        <i class="bi bi-controller text-danger fs-1 m-0"></i>
                        <p class=" text-white-50 m- lh-1">ยังไม่มีการจัดอันดับ</p>
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>