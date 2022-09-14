<div class="modal fade bg-br " id="register_nav" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content card-bg ">
            <div class="modal-body">
                <div class=" d-flex flex-column justify-content-center w-100">
                    <p class=" <?php echo $fn_text?> fs-3 mb-0 lh-1 text-center">สมัครเข้าสู่ระบบ </p>
                    <hr class=" bg-warning  rounded-pill lh-1 m-0 mx-auto" style="padding: 2px; width: 100px;">
                </div>
                <form class="mt-3 " autocomplete="off" id="form_register">
                    <div class=" mb-3 ">
                        <input type="text" class=" form-control border-1 <?php echo $fn_border?> rounded-pill bg-dark shadow-none text-center text-white w-75 mx-auto" autocomplete="off" placeholder="Username" name="username" required>
                    </div>
                    <div class=" mb-3 ">
                        <input type="email" class=" form-control border-1 <?php echo $fn_border?> rounded-pill bg-dark shadow-none text-center text-white w-75 mx-auto" autocomplete="off" placeholder="Email" name="email" required>
                    </div>
                    <div class=" mb-3 ">
                        <input type="password" class="form-control border-1 <?php echo $fn_border?> rounded-pill bg-dark shadow-none text-center text-white w-75 mx-auto" autocomplete="off" placeholder="Password" name="password" required>
                    </div>
                    <div class=" mb-3 ">
                        <input type="password" class="form-control border-1 <?php echo $fn_border?> rounded-pill bg-dark shadow-none text-center text-white w-75 mx-auto" autocomplete="off" placeholder="Password" name="confirmpassword" required>
                    </div>
                    <div class=" mb-3 d-grid">
                        <button type="submit" class=" btn btn-outline-success w-75 mx-auto rounded-pill">สมัครสมาชิก</button>
                    </div>
                </form>
                <p class=" <?php echo $fn_text?> text-center m-0">มีบัญชีเข้าสู่ระบบใช่หรือไม่ ? <button data-bs-target="#login_nav" data-bs-toggle="modal" class="p-0 btn border-0 lh-1 link-warning">เข้าสู่ระบบ!</button></p>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('#form_register').submit(function(e) {
            e.preventDefault();
            $.ajax({
                url: '/api/register.php',
                type: 'POST',
                data: $('#form_register').serialize(),
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