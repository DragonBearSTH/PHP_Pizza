<div class="tab-content " id="v-pills-tabContent">
    <div class="tab-pane fade show active" id="v-pills-tmw" role="tabpanel" aria-labelledby="v-pills-tmw-tab" tabindex="0">
        <div class="d-flex flex-column justify-content-center my-3">
            <div class="text-white d-flex justify-content-center my-3">
                <img src="https://www.truemoney.com/wp-content/uploads/2020/12/truemoneywallet-logo-20190424.png" alt="" width="300px" class="my-3">
                <div class="d-flex flex-column justify-content-center">
                    <span>เบอร์โทรศัพท์ : 0928213157</span>
                    <span>ชื่อ : BinSpace</span>
                </div>
            </div>
            <form id="truemoney" class="d-flex flex-column justify-content-center">
                <div class=" mb-3 ">
                    <input type="text" class="form-control border-1 <?php echo $fn_border ?> rounded-pill bg-dark shadow-none text-center text-white w-75 mx-auto" autocomplete="off" placeholder="Truewallet Gift" name="ref_code">
                    <input type="hidden" name="username" value="<?= $_SESSION['authme_username'] ?>">
                </div>
                <button type="submit" class="btn btn-warning rounded-pill shadow-none w-50 mx-auto">ตรวจสอบการโอนเงิน</button>
            </form>
        </div>
    </div>
    <?php if ($license['kbank'] == 'active') { ?>
        <div class="tab-pane fade" id="v-pills-kbank" role="tabpanel" aria-labelledby="v-pills-kbank-tab" tabindex="0">
            <div class=" d-flex flex-column justify-content-center my-3">
                <div class="text-white d-flex justify-content-center my-3">
                    <img src="https://www.kasikornbank.com/SiteCollectionDocuments/assets/img/logo/kasikornbank.png" alt="" width="300px" class="my-3 p-3">
                    <div class="d-flex flex-column justify-content-center">
                        <span>เลขที่บัญชี : 8202876661</span>
                        <span>ชื่อ-นามสกุล : BinSpace</span>
                    </div>
                </div>
                <form id="kbank" class="d-flex flex-column justify-content-center">
                    <div class=" mb-3 d-flex w-75 mx-auto">
                        <input type="date" class="form-control border-1 <?php echo $fn_border ?> rounded-pill bg-dark shadow-none text-center text-white w-50 mx-auto p-2" name="date">
                        <input type="time" class="form-control border-1 <?php echo $fn_border ?> rounded-pill bg-dark shadow-none text-center text-white w-50 mx-auto" name="time">
                        <input type="hidden" name="username" value="<?= $_SESSION['authme_username'] ?>">
                    </div>
                    <button type="submit" class="btn btn-warning rounded-pill shadow-none w-50 mx-auto">ตรวจสอบการโอนเงิน</button>
                </form>
            </div>
        </div>
    <?php } ?>
    <?php if ($license['scb'] == 'active') { ?>
        <div class="tab-pane fade" id="v-pills-scb" role="tabpanel" aria-labelledby="v-pills-scb-tab" tabindex="0">
            <div class=" d-flex flex-column justify-content-center my-3">
                <div class="text-white d-flex justify-content-center my-3">
                    <img src="https://www.logolynx.com/images/logolynx/65/658470bcebfc8a6c93c134d2506a2733.png" alt="" width="300px" class="my-3 p-3">
                    <div class="d-flex flex-column justify-content-center">
                        <span>เลขที่บัญชี : 8202876661</span>
                        <span>ชื่อ-นามสกุล : BinSpace</span>
                    </div>
                </div>
                <form id="scb" class=" d-flex flex-column justify-content-center">
                    <div class=" mb-3 d-flex w-75 mx-auto">
                        <input type="date" class="form-control border-1 <?php echo $fn_border ?> rounded-pill bg-dark shadow-none text-center text-white w-50 mx-auto p-2" name="date">
                        <input type="time" class="form-control border-1 <?php echo $fn_border ?> rounded-pill bg-dark shadow-none text-center text-white w-50 mx-auto" name="time">
                    </div>
                    <button class=" btn btn-warning rounded-pill shadow-none w-50 mx-auto">ตรวจสอบการโอนเงิน</button>
                </form>
            </div>
        </div>
    <?php } ?>
</div>

<script>
    $(document).ready(function() {
        $('#truemoney').submit(function(e) {
            e.preventDefault();
            $.ajax({
                url: 'api/truemoney.php',
                type: 'POST',
                data: $('#truemoney').serialize(),
                dataType: 'json',
                success: function(data) {
                    Swal.fire({
                        icon: data.status,
                        title: data.title,
                        text: data.message,
                        showConfirmButton: false,
                        timer: 1500
                    }).then(function() {
                        window.location = "/";
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
    <?php if ($license['kbank'] == 'active') { ?>
        $(document).ready(function() {
            $('#kbank').submit(function(e) {
                e.preventDefault();
                $.ajax({
                    url: 'api/kbank.php',
                    type: 'POST',
                    data: $('#kbank').serialize(),
                    dataType: 'json',
                    beforeSend: function() {
                        Swal.fire({
                            title: 'Kasikorn Bank',
                            html: 'กำลังตรวจสอบธุระกรรม',
                            timer: 120000,
                            timerProgressBar: true,
                            didOpen: () => {
                                Swal.showLoading()
                                const b = Swal.getHtmlContainer().querySelector('b')
                                timerInterval = setInterval(() => {
                                    b.textContent = Swal.getTimerLeft()
                                }, 100)
                            },
                            willClose: () => {
                                clearInterval(timerInterval)
                            }
                        })
                    },
                    success: function(data) {
                        Swal.fire({
                            icon: data.status,
                            title: data.title,
                            text: data.message,
                            showConfirmButton: false,
                            timer: 1500
                        }).then(function() {
                            window.location = "/";
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
    <?php } ?>
</script>