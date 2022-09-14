<?php $inv_inventory = mysqli_query($mysqli2, "SELECT * FROM table_inventory WHERE username = '$_SESSION[authme_username]'") ?>
<div class=" row g-2 row-cols-4">
    <?php while ($inv = mysqli_fetch_array($inv_inventory)) { ?>
        <div class=" col">
            <div class=" card card-bg border-0 shadow rounded-4  position-relative shop-hover position-relative">
                <button class="btn border-0 position-absolute position-absolute top-0 end-0 text-danger"><i class="bi bi-trash3-fill fs-4"></i></button>
                <div class=" card-body">
                    <div class=" w-100 d-flex justify-content-center align-items-center">
                        <img src="<?= $inv['image'] ?>" alt="" class="" width="150px" height="150px">
                    </div>
                    <div class="mb-2">
                        <div class="w-100 d-flex justify-content-center">
                            <hr class=" <?php echo $fn_bg ?>  rounded-pill card-hr opacity-100" style="padding: 2px; ">
                        </div>
                        <p class=" text-white m-0 fs-4 text-center"><?= $inv['name'] ?> x<?= $inv['valueini'] ?></p>
                        <div class=" w-100 d-flex justify-content-center">
                            <p class="text-dark bg-warning rounded-pill text-center m-0" style="width:100px"><?= $inv['server'] ?></p>
                        </div>
                        <p class="lh-1 text-center text-white-50 tl-2"><?= $inv['subname'] ?></p>
                    </div>
                    <div class=" d-flex justify-content-between">
                        <button class="btn btn-primary shadow-none py-1" data-bs-toggle="modal" data-bs-target="#iditem" data-html="<?= $inv['html'] ?>">ดูข้อมูล</button>
                        <button class="btn <?php echo $btn_outline ?> shadow-none py-1 align-items-center" data-bs-toggle="modal" data-bs-target="#gif">ให้ของขวัญ</button>
                        <button class="btn btn-success shadow-none py-1">ใช้งาน</button>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>
</div>

<div class="modal fade bg-br" id="iditem" tabindex="-1" aria-labelledby="iditem" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content card-bg">
            <div class="modal-body">
                <div class="mb-2 ">
                    <p class=" <?php echo $fn_text ?> fs-2 m-0 lh-1">ข้อมูลไอเทม</p>
                    <hr class=" <?php echo $fn_bg ?>  rounded-pill mt-1" style="padding: 2px; width: 100px;">
                    <p id="htmlitem" class=" text-white-50"></p>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $sql_users = mysqli_query($mysqli2, "SELECT * FROM authme LIMIT 4"); ?>
<div class="modal fade bg-br" id="gif" tabindex="-1" aria-labelledby="gif" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content card-bg">
            <div class="modal-body">
                <div class="mb-2 ">
                    <p class=" <?php echo $fn_text ?> fs-2 m-0 lh-1">ส่งของขวัญ</p>
                    <hr class=" <?php echo $fn_bg ?>  rounded-pill mt-1" style="padding: 2px; width: 100px;">
                    <form id="queryusers">
                        <div class=" d-flex ">
                            <input type="hidden" name="username" value="<?= $_SESSION['authme_username'] ?>">
                            <input type="text" class="form-control border-1 <?php echo $fn_border ?> rounded-pill bg-dark shadow-none text-white rounded-end" name="queryusers" placeholder="ค้นหาเพื่อของคุณ" required>
                            <button type="submit" class="btn btn-warning rounded-pill rounded-start px-5">ค้นหา</button>
                        </div>
                    </form>
                    <div class="row g-2 row-cols-4 mt-2">
                        <div class="col">
                            <div class=" card card-bg rounded-4 border-0 shadow shop-hover">
                                <div class=" card-body">
                                    <form id="giftads">
                                        <div id="users"></div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $('#iditem').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget)
        var html = button.data('html')
        var modal = $(this)
        modal.find('.modal-body #htmlitem').html(html)
    })
    $(document).ready(function() {
        $('#queryusers').submit(function(e) {
            e.preventDefault();
            $.ajax({
                url: '/api/search.php',
                type: 'POST',
                data: $('#queryusers').serialize(),
                dataType: 'json',
                success: function(data) {
                    $('#users').html(data.data);
                }
            });
        });
    });
    $(document).ready(function() {
        $('#giftads').submit(function(e) {
            e.preventDefault();
            $.ajax({
                url: '/api/giftads.php',
                type: 'POST',
                data: $('#giftads').serialize(),
                dataType: 'json',
                success: function(response) {
                    Swal.fire({
                        icon: response.status,
                        title: response.title,
                        text: response.message,
                        showConfirmButton: false,
                        timer: 1500
                    }).then(function() {
                        window.location = "/inventroy";
                    });
                },
                error: function(err) {
                    Swal.fire({
                        icon: err.responseJSON.status,
                        title: err.responseJSON.title,
                        text: err.responseJSON.message,
                        showConfirmButton: false,
                        timer: 1500
                    });
                }
            });
        });
    });
</script>