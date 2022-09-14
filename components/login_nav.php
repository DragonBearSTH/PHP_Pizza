<div class="modal fade bg-br " id="login_nav" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content card-bg ">
            <div class="modal-body">
                <div class=" d-flex flex-column justify-content-center w-100">
                    <p class=" <?php echo $fn_text?> fs-3 mb-0 lh-1 text-center">เข้าสู่ระบบ </p>
                    <hr class=" <?php echo $fn_bg?>  rounded-pill lh-1 m-0 mx-auto" style="padding: 2px; width: 100px;">
                </div>
                <form class="mt-3 " autocomplete="off" id="login_from">
                    <div class=" mb-3 ">
                        <input type="text" class=" form-control border-1 <?php echo $fn_border?> rounded-pill bg-dark shadow-none text-center text-white w-75 mx-auto" autocomplete="off" placeholder="Username" name="username" required>
                    </div>
                    <div class=" mb-3 ">
                        <input type="password" class="form-control border-1 <?php echo $fn_border?> rounded-pill bg-dark shadow-none text-center text-white w-75 mx-auto" autocomplete="off" placeholder="Password" name="password" required>
                    </div>
                    <div class=" mb-3 d-grid">
                        <button type="submit" class=" btn btn-outline-success w-75 mx-auto rounded-pill">เข้าสู่ระบบ</button>
                    </div>

                </form>
                <p class=" <?php echo $fn_text?> text-center m-0">ยังไม่มีบัญชีเข้าสู่ระบบใช่หรือไม่ ? <button data-bs-target="#register_nav" data-bs-toggle="modal" class="p-0 btn border-0 lh-1 link-warning">สมัครเลย!</button></p>
            </div>
        </div>
    </div>
</div>
<?php include("register_nav.php"); ?>
<script>
    $(document).ready(function() {
        $('#login_from').submit(function(e) {
            e.preventDefault();
            $.ajax({
                url: '/api/login.php',
                type: 'POST',
                data: $('#login_from').serialize(),
                dataType: 'json',
                success: function(response) {
                    Swal.fire({
                        icon: response.status,
                        title: response.title,
                        showConfirmButton: false,
                        text: response.message,
                        timer: 1000
                    }).then(function(result) {
                        if (result) {
                            window.location.href = '/';
                        }
                    });
                },
                error: function(err) {
                    Swal.fire({
                        icon: err.responseJSON.status,
                        title: err.responseJSON.title,
                        showConfirmButton: false,
                        text: err.responseJSON.message,
                        timer: 2000
                    });
                }
            });
        });
    });
</script>