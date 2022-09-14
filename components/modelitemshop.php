<div class="modal fade bg-br" id="iditemall" tabindex="-1" aria-labelledby="iditem" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content card-bg">
            <div class="modal-body">
                <div class="mb-2 ">
                    <p class=" <?php echo $fn_text ?> fs-2 m-0 lh-1">ข้อมูลสินค้า</p>
                    <hr class=" <?php echo $fn_bg ?>  rounded-pill mt-1" style="padding: 2px; width: 100px;">
                    <p id="ckeditor" class=" text-white-50"></p>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade bg-br" id="itemshopall" tabindex="-1" aria-labelledby="itemshop" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered ">
        <div class="modal-content card-bg">
            <div class="modal-body">
                <div class="mb-2 ">
                    <p class=" <?php echo $fn_text ?> fs-2 m-0 lh-1">ซื้อสินค้า </p>
                    <hr class=" <?php echo $fn_bg ?>  rounded-pill mt-1" style="padding: 2px; width: 100px;">
                    <div id="loadingshop">
                        <div class="d-flex justify-content-center">
                            <div class="spinner-border text-warning" role="status">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                        </div>
                    </div>
                    <div id="itemdatashop" class="d-none">
                        <div class="w-100 d-flex justify-content-center align-items-center">
                            <img id="logoitems" src="" class="" alt="logo item" width="150px" height="150px">
                        </div>
                        <div class="mb-2">
                            <div class="w-100 d-flex justify-content-center">
                                <hr class=" <?php echo $fn_bg ?>  rounded-pill card-hr opacity-100" style="padding: 2px; ">
                            </div>
                            <p id="namevue" class="text-white m-0 fs-4 text-center"></p>
                            <div class=" w-100 d-flex justify-content-center">
                                <p id="typeserver" class="text-dark <?php echo $fn_bg ?> rounded-pill text-center m-0" style="width:100px">MMO</p>
                            </div>
                            <p id="subtext" class="lh-1 text-center text-white-50 tl-2"></p>
                        </div>
                        <div>
                            <div class=" d-flex justify-content-center mt-2">
                                <form id="invactory_add">
                                    <input type="hidden" name="itemid" value="">
                                    <input type="hidden" name="username" value="<?= $_SESSION['authme_username'] ?>">
                                    <button id="invbuy" type="submit" class="col btn btn-outline-success rounded-pill px-5 py-1 shadow-none text-nowrap"></button>
                                </form>
                                <form id="but_product">
                                    <input type="hidden" name="itemid" value="">
                                    <input type="hidden" name="username" value="<?= $_SESSION['authme_username'] ?>">
                                    <button id="pricebut" class="col btn btn-success rounded-pill px-5 py-1 shadow-none"></button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $('#itemshopall').on('shown.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var id = button.data('id')
            var name = button.data('name')
            var image = button.data('image')
            var unitvalue = button.data('unitvalue')
            var server = button.data('server')
            var subname = button.data('subname')
            var price = button.data('price')
            var modal = $(this)
            modal.find('#itemdatashop').addClass('d-none') // ซ่อน
            modal.find('#loadingshop').show() // แสดง
            setTimeout(function() {
                modal.find('#namevue').text(name)
                modal.find('#subtext').text(subname)
                modal.find('#logoitems').attr('src', image)
                modal.find('#typeserver').text(server)
                modal.find('#pricebut').text('ซื้อเลย ' + price + ' Point')
                modal.find('#invbuy').text('ซื้อเข้ากระเป๋า ' + price + ' Point')
                modal.find('#invactory_add input[name="itemid"]').val(id)
                modal.find('#but_product input[name="itemid"]').val(id)
                modal.find('#loadingshop').hide() // ซ่อน
                modal.find('#itemdatashop').removeClass('d-none') // แสดง
            }, 2000);
        });
        $('#iditemall').on('shown.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var html = button.data('html')
            var modal = $(this)
            modal.find('.modal-body #ckeditor').html(html)
        });
        $(document).ready(function(e) {
            $("#invactory_add").on('submit', (function(e) {
                e.preventDefault();
                swal.fire({
                    title: 'ซื้อสินค้า',
                    text: "คุณต้องซื้อไอเทมเก็บในกระเป๋าใช่หรือไม่ ?",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'ใช่',
                    cancelButtonText: 'ไม่ใช่'
                }).then((result) => {
                    if (result.value) {
                        $.ajax({
                            url: "/api/invaddnew.php",
                            type: "POST",
                            data: $('#invactory_add').serialize(),
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
                    }
                })
            }));
        });
        $(document).ready(function(e) {
            $("#but_product").on('submit', (function(e) {
                e.preventDefault();
                swal.fire({
                    title: 'ซื้อสินค้า',
                    text: "คุณต้องซื้อไอเทมเลยใช่หรือไม่ ?",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'ใช่',
                    cancelButtonText: 'ไม่ใช่'
                }).then((result) => {
                    if (result.value) {
                        $.ajax({
                            url: "/api/buyitem.php",
                            type: "POST",
                            data: $('#but_product').serialize(),
                            dataType: 'json',
                            success: function(response) {
                                Swal.fire({
                                    icon: response.status,
                                    title: response.title,
                                    text: response.message,
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
                    }
                })
            }));
        });
    </script>