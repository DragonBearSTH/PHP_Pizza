<div class="mb-2 ">
    <p class=" <?php echo $fn_text ?> fs-2 m-0 lh-1">ตั้งค่าโปรไฟล์</p>
    <hr class=" <?php echo $fn_bg ?>  rounded-pill" style="padding: 2px; width: 100px;">
</div>
<div class="row">
    <div class=" col-3">
        <div class=" card border-0 card-bg rounded-4 shadow">
            <div class=" card-body">
                <div class=" d-flex justify-content-center">
                    <img src="https://minotar.net/avatar/<?= $user['username']; ?>" alt="" width="50%" class=" rounded-4 shadow">
                </div>
                <div class="w-100 d-flex justify-content-center">
                    <hr class=" <?php echo $fn_bg ?>  rounded-pill card-hr opacity-100" style="padding: 2px; ">
                </div>
                <p class=" text-center text-white fs-4 mb-2 lh-1"><?= $user['username']; ?></p>
                <p class=" text-white-50 m-0 text-center lh-1">ยอดคงเหลือ <?= $user['point']; ?> point</p>
                <p class="text-white-50 m-0 text-center lh-1">ยอดการเติมทั้งหมด <?= $user['sumpoint']; ?> บาท</p>
                <div class=" d-grid mt-3">
                    <a class=" btn btn-sm py-0 btn-outline-danger border-0" href="/logout">ออกจากระบบ</a>
                </div>
            </div>
        </div>
    </div>
    <div class=" col-9">
        <div class=" card-bg card border-0 shadow rounded-4 mb-2 overflow-hidden">
            <div class="card-header <?php echo $fn_text ?> <?php echo $fn_text ?> ">ผู้ใช้งาน</div>
            <div class=" card-body">
                <div class=" row">
                    <div class="col">
                        <div class=" d-flex  align-items-center text-white">
                            <b class="me-2 text-white-50">ชื่อผู้เล่น :</b><?= $user['username'] ?>

                        </div>
                        <div class=" d-flex align-items-center text-white">
                            <b class="me-2 text-white-50">ระดับขั้น :</b><span class="badge text-bg-primary">Player</span>
                        </div>
                        <div class=" d-flex  align-items-center text-white">
                            <b class="me-2 text-white-50">ยอดการเติมทั้งหมด :</b><?= $user['sumpoint']; ?> บาท
                        </div>
                        <div class=" d-flex  align-items-center text-white">
                            <b class="me-2 text-white-50">คงเหลือ :</b><?= $user['point']; ?> point
                        </div>
                        <div class=" d-flex  align-items-center text-white">
                            <b class="me-2 text-white-50">แลกของไปแล้ว :</b>10 ชิ้น
                        </div>
                        <div class=" d-flex  align-items-center text-white">
                            <b class="me-2 text-white-50">เป็นสมาชิกวันที่ :</b><?= $user['created_at']; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- <div class="card-bg card border-0 shadow rounded-4 overflow-hidden">
            <div class=" card-header <?php echo $fn_text ?> <?php echo $fn_text ?>">
                ประวัติการซื้อสินค้า
            </div>
            <div class=" card-body">

            </div>
        </div> -->
        <div class=" d-grid">
            <button class="btn shadow card-bg border-0 <?php echo $fn_text ?> text-start border-start border-3 <?php echo $fn_border ?> mt-2" type="button" data-bs-toggle="collapse" data-bs-target="#history_item" aria-expanded="false">
                <i class="bi bi-caret-down-fill"></i> ประวัติการซื้อสินค้า
            </button>
            <div class="collapse mb-2" id="history_item">
                <div class="card card-bg rounded-bottom shadow">
                    <div class=" card-body">
                        <p class=" <?php echo $fn_text ?>">
                        <table class=" table">

                        </table>
                        </p>
                    </div>
                </div>
            </div>
            <button class="btn shadow card-bg border-0 <?php echo $fn_text ?> text-start border-start border-3 <?php echo $fn_border ?> mt-2" type="button" data-bs-toggle="collapse" data-bs-target="#history_item" aria-expanded="false">
                <i class="bi bi-caret-down-fill"></i> ประวัติการเติมเงิน
            </button>
        </div>
    </div>
</div>