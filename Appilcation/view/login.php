<section>
    <div class=" container">
        <p class=" m-0 text-white fs-2 text-center my-5">เข้าสู่ระบบ</p>
        <div class=" d-flex justify-content-center align-items-center">
            <div class="  card bg-black bg-opacity-50 border-0 shadow rounded-4" style="width: 30rem;">
                <div class=" card-body py-5">
                    <?php include('./Controllers/login.php'); ?>
                    <form  method="POST">
                        <div class=" mb-2 d-flex">
                        <i class="bi bi-envelope-fill text-success fs-3"></i>
                        <input type="email" class=" form-control rounded-0 border-bottom border-start-0 border-top-0 border-end-0 bg-transparent shadow-none text-white" placeholder="email" name="email">
                        </div>
                        <div class=" mb-2 d-flex">
                        <i class="bi bi-key-fill  text-success fs-3"></i>
                        <input type="password" class=" form-control rounded-0 border-bottom border-start-0 border-top-0 border-end-0 bg-transparent shadow-none text-white" placeholder="password" name="password">
                        </div>
                        <div class=" d-grid mt-3">
                            <button class=" btn btn-success rounded-3" name="login">เข้าสู่ระบบ</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>