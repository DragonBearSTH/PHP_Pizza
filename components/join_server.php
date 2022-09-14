<div class=" overflow-hidden rounded-4 card-bg position-relative btn-hover-join" style=" height: 200px;">
    <div class=" d-flex justify-content-center align-items-center flex-column position-absolute h-100 w-100 p-3" style="z-index: 999;">
        <p class="text-center fs-1 <?php echo $fn_text?> m-0">เข้าร่วมสนุกกับเพื่อนๆได้แล้ววันนี้!</p>
        <p class=" text-white-50 fs-5 text-center">มาร่วมเป็นส่วนหนึ่งกับความสนุกมากมายใน Server ของเรา วันเจอกันใน Server น้าา</p>
        <button type="button" onclick="copyText()" class="btn <?php echo $btn_outline?> btn-lg shadow-none border-0 px-5">เล่นเลย! <?= $setting['ipaddress'] ?></button>
        <!-- <input type="hidden" name="myInput" value="<?= $setting['ipaddress'] ?>"> -->
    </div>
    <div class="img-center w-100 opacity-25 "></div>
</div>
<style>
    .img-center {
        width: 100%;
        height: 100%;
        background-image: <?php echo "url('https://media.discordapp.net/attachments/924489600162988112/924489687396130816/2021-08-07_06.59.58.png')" ?>;
        background-position: center;
    }
</style>
<script>
    function copyText() {
        navigator.clipboard.writeText("<?= $setting['ipaddress'] ?>");
        Swal.fire({
            icon: 'success',
            title: 'สำเร็จ!',
            text: 'คัดลอก <?= $setting['ipaddress'] ?> เรียบร้อยแล้ว',
            showConfirmButton: false,
            timer: 1500
        })
    }
</script>