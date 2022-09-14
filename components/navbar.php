    <div class="position-absolute w-100" style="z-index: 999;">
        <nav class="navbar navbar-expand-lg w-100 bg-dark bg-opacity-25 ">
            <div class="container">
                <div class="collapse navbar-collapse w-100" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0 ">
                        <li class="nav-item">
                            <a class="nav-link link-light" aria-current="page" href="/">หน้าหลัก</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link link-light" aria-current="page" href="#">กฏการเล่น</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link link-light" aria-current="page" href="/shop">ร้านค้า</a>
                        </li>
                        <?php if (!empty($_SESSION['authme_username'])) { ?>
                            <!-- ขียน li ไว้เฉยๆ เป็นตัวอย่าง เวลาเพิ่มระบบ -->
                            <li class="nav-item">
                                <a class="nav-link link-light" aria-current="page" href="/topup">เติมเงิน</a>
                            </li>
                            <!-- <li class="nav-item">
                                <a class="nav-link link-light" aria-current="page" href="#">แลกโค้ด</a>
                            </li> -->
                            <li class="nav-item">
                                <a class="nav-link link-light" aria-current="page" href="/inventroy">กระเป๋าของฉัน</a>
                            </li>
                        <?php } ?>
                        <li class="nav-item">
                            <a class="nav-link link-light" aria-current="page" href="#">ติดต่อเรา</a>
                        </li>
                    </ul>
                    <ul class="navbar-nav  mb-2 mb-lg-0 d-flex justify-content-end ">
                        <?php if (empty($_SESSION['authme_username'])) { ?>
                            <li class="nav-item me-2">
                                <a class=" btn btn-outline-warning rounded-pill btn-sm px-5 shadow-none" href="/shop"><i class="bi bi-cart4 "></i> ร้านค้า</a>
                            </li>
                            <li class="nav-item">
                                <button class=" btn btn-success rounded-pill btn-sm px-5 shadow-none" data-bs-toggle="modal" data-bs-target="#login_nav"><i class="bi bi-box-arrow-in-right me-2 lh-1"></i>เข้าสู่ระบบ</button>
                            </li>
                        <?php } else {
                            $user = mysqli_query($mysqli2, "SELECT * FROM authme WHERE username = '" . $_SESSION['authme_username'] . "'");
                            $user = mysqli_fetch_assoc($user);
                        ?>
                            <li class="nav-item me-2  dropdown">
                                <button class=" btn p-0 border-0 shadow-none d-flex" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <div class=" d-flex flex-column">
                                        <p class=" text-end m-0 fw-bold text-white fs-5 lh-1">
                                            <?= $_SESSION['authme_username'] ?></p>
                                        <div class=" d-flex justify-content-center align-items-center">
                                            <p class=" text-end m-0 text-white-50 lh-1" style=" font-size: small;">
                                                คงเหลือ <?= $user['point']; ?>
                                                P</p>
                                            <a href="" class="btn border-0 text-hover p-0 shadow-none ms-1" style=" font-size: x-small;"><i class="bi bi-plus-circle"></i></a>
                                        </div>
                                    </div>

                                    <img src="https://minotar.net/avatar/<?= $_SESSION['authme_username'] ?>" alt="" class=" rounded-2 ms-2" width="35px">
                                </button>
                                <ul class="dropdown-menu dropdown-menu-dark mt-2 p-0 overflow-hidden border-0 shadow">
                                    <li><a class="dropdown-item text-hover d-flex align-items-center " href="/profile">
                                            <img src="https://minotar.net/avatar/<?= $_SESSION['authme_username'] ?>" alt="" class=" rounded-2 me-2" width="20px" height="20px">
                                            <div class=" d-flex flex-column">
                                                <p class="m-0 lh-1"><?= $_SESSION['authme_username'] ?></p>
                                                <p class=" text-white-50 m-0 lh-1" style=" font-size: small;">ตั้งค่าโปรไฟล์
                                                </p>
                                            </div>
                                        </a></li>
                                    <li>
                                        <hr class=" m-0">
                                    </li>
                                    <li><a class="dropdown-item text-hover" href="/topup"><i class="bi bi-cash-coin me-2"></i>เติมเงิน</a></li>
                                    <li><a class="dropdown-item text-hover" href="/inventroy"><i class="bi bi-archive-fill me-2"></i> กระเป๋า</a></li>
                                    <li><button class="btn dropdown-item text-hover" data-bs-toggle="modal" data-bs-target="#redem"><i class="bi bi-box2-fill me-2"></i> แลกโค้ด</button></li>
                                    <li><a class="dropdown-item text-hover" href="/profile"><i class="bi bi-bank2 me-2"></i>ประวัติการเติมเงิน</a></li>
                                    <li><a class="dropdown-item text-hover" href="/profile"><i class="bi bi-bag-check-fill me-2"></i>ประวัติการซื้อสินค้า</a></li>
                                    <li><a class="dropdown-item text-hover" href="/profile"><i class="bi bi-clipboard-check-fill me-2"></i> ประวัติการแลกสินค้า</a></li>
                                    
                                    <li>
                                        <hr class=" m-0">
                                    </li>
                                    <li><a class="dropdown-item text-hover text-center text-danger" href="/logout"><i class="bi bi-box-arrow-right me-2"></i>ออกจากระบบ</a></li>
                                </ul>
                            </li>
                            <li class="nav-item me-2  ms-2">
                                <a class=" shadow-none text-hover btn border-0" href="/logout"><i class="bi bi-box-arrow-right"></i></a>

                            </li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
        </nav>
    </div>
    <div class="mb-5">
        <div class="position-relative" style="height: 300px;">
            <div class="background position-absolute w-100 h-100 bg-transparent">
                <span></span>
                <span></span>
                <span></span>
                <span></span>
                <span></span>
                <span></span>
                <span></span>
                <span></span>
                <span></span>
                <span></span>
                <span></span>
                <span></span>
                <span></span>
                <span></span>
                <span></span>
                <span></span>
                <span></span>
                <span></span>
                <span></span>
                <span></span>
                <span></span>
                <span></span>
                <span></span>
                <span></span>
                <span></span>
                <span></span>
                <span></span>
                <span></span>
                <span></span>
                <span></span>
                <span></span>
                <span></span>
                <span></span>
                <span></span>
                <span></span>
                <span></span>
                <span></span>
                <span></span>
                <span></span>
                <span></span>
                <span></span>
                <span></span>
                <span></span>
                <span></span>
                <span></span>
                <span></span>
                <span></span>
                <span></span>
                <span></span>
                <span></span>
            </div>
            <div class="layered-image w-100 h-100">

            </div>
            <div class="position-relative">
                <!-- logo -->
                <img src="https://media.discordapp.net/attachments/866578813843931168/882460988278984704/Untitled-1_1.png" alt="" width="350px" class="position-absolute top-50 start-50 translate-middle pb-5" style="z-index: 999;">
                <div class="position-relative">
                    <nav class="bg-br position-absolute top-100 start-50 translate-middle shadow-lg w-100 position-relative overflow-hidden">
                        <div class="container  py-3 ">
                            <div class="row row-cols-3">
                                <div class="col">
                                    <div class=" d-flex align-items-center">
                                        <i class="bi bi-people-fill text-light fs-3 d-flex align-items-center"></i>
                                        <div class=" ms-3">
                                            <p class="fs-4 m-0 lh-1 text-white "><?= $setting['ipaddress'] ?></p>
                                            <p class="online m-0 text-warning  fw-normal" style="font-size: small;">ไม่สามารถตรวจสอบ Server ได้</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col">

                                </div>
                                <div class="col">
                                    <div class=" d-flex align-items-center justify-content-end">
                                        <div class=" me-3">
                                            <p class=" fs-4 m-0 lh-1 text-white text-end">Discord</p>
                                            <p class="discord m-0 text-warning  fw-normal text-end" style="font-size: small;">
                                                </p>
                                        </div>
                                        <i class="bi bi-discord text-light fs-3 d-flex align-items-center"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="position-absolute w-100 top-50 start-50 translate-middle" style="z-index: -999;">
                            <div class=" bg-br bg-dark bg-opacity-75 w-100 h-100 position-absolute" style="z-index: 999;"></div>
                            <!-- BG Nav -->
                            <img src="https://media.discordapp.net/attachments/865484859668168725/1009316400323633223/supawit-oat-fin1.jpg" alt="" width="100%" class=" opacity-10">
                        </div>
                    </nav>

                </div>
            </div>
        </div>
    </div>
 <?php include("./components/redem.php"); ?>
    <script>
        $(document).ready(function() {
                $.ajax({
                    url: "/api/discord.php",
                    type: "GET",
                    typeData: "json",
                    beforeSend: function() {
                        $('.discord').html('กำลังตรวจสอบ Server Discord');
                    },
                    success: function(data) {
                        $('.discord').html('Player Online '+data);
                    },
                });
        });

            var port = "<?= $setting['port'] ?>";
            var ipaddress = "<?= $setting['ipaddress'] ?>";
            $.ajax({
                url: "https://eu.mc-api.net/v3/server/info/"+ipaddress+":"+port,
                type: "GET",
                success: function(data) {
                    $('.online').html('Player Online ' +  data.players.online);
                },
                error: function() {
                    $('.online').html('ไม่สามารถตรวจสอบ Server ได้');
                }
            });
    </script>

    <style>
        .layered-image {
            background: linear-gradient(to bottom, transparent, #14171a),
                url("https://media.discordapp.net/attachments/865484859668168725/1009316400323633223/supawit-oat-fin1.jpg");
        }

        .bg-nav {
            background: url("https://media.discordapp.net/attachments/865484859668168725/1009316400323633223/supawit-oat-fin1.jpg");
            backdrop-filter: blur(30px);
            background-attachment: fixed;
            background-position: center top;

        }

        .bg-img-1 {
            background: url('https://media.discordapp.net/attachments/865484859668168725/1009316400323633223/supawit-oat-fin1.jpg');
        }
    </style>
    <?php
    if (empty($_SESSION['authme_username'])) {
        include './components/login_nav.php';
    }

    ?>