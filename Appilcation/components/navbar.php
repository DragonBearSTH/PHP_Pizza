<nav class="navbar navbar-expand-lg bg-success shadow">
    <div class="container">
        <img src="/Appilcation/Includes/image/logo.svg" alt="" width="100px">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mb-2 mb-lg-0 w-100 ">
                <li class="nav-item d-flex align-items-center text-white ">
                    <a class="nav-link active link-light border-end py-0" aria-current="page"
                        href="?page=หน้าแรก">หน้าแรก</a>
                </li>
                <li class="nav-item d-flex align-items-center text-white">
                    <a class="nav-link active link-light border-end py-0" aria-current="page"
                        href="?page=หน้าแรก">พิซซ่าทั้งหมด</a>
                </li>
                <li class="nav-item d-flex align-items-center text-white">
                    <a class="nav-link active link-light border-end py-0" aria-current="page"
                        href="?page=หน้าแรก">โปรโมชั่นทั้งหมด</a>
                </li>
                <li class="nav-item d-flex align-items-center text-white">
                    <a class="nav-link active link-light" aria-current="page" href="?page=หน้าแรก">ดีลสุดพิเศษ</a>
                </li>
            </ul>
            <ul class="navbar-nav mb-2 mb-lg-0 w-100 d-flex justify-content-end">
                <?php
        if($_SESSION['user']){?>
                <li class="nav-item d-flex align-items-center text-white">
                    Username
                    <a href="?page=chest" class=" btn border-0 text-white p-0 ms-2 position-relative">
                        <span class="position-absolute top-0 start-100 translate-middle bg-danger d-flex align-items-center justify-content-center rounded-circle" style="width: 20px; height: 20px;">
                            1
                        </span>
                        <i class="bi bi-cart-fill fs-3"></i>
                    </a>

                    <i class="bi bi-person-circle fs-2 ms-2 border-end pe-2"></i>

                    <a href="?page=logout" class=" btn border-0 text-danger p-0 ms-2"><i
                            class="bi bi-box-arrow-right fs-4"></i></a>
                </li>
                <?php }else{ ?>
                <li class="nav-item d-flex align-items-center text-white">
                    <i class="bi bi-person-fill"></i>
                    <a class="nav-link active link-light" aria-current="page" href="?page=login">เข้าสู่ระบบ</a>/
                    <a class="nav-link active link-light" aria-current="page" href="?page=register">ลงทะเบียน</a>
                </li>

                <?php }?>
            </ul>
        </div>
    </div>
</nav>