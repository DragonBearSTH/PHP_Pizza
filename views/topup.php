<div class="row g-2">
    <div class="col-4">
        <div class=" card card-bg rounded-4 border-0 shadow">
            <div class=" card-header text-center <?php echo $fn_text ?>">
                อัตราแลกเปลี่ยน
            </div>
            <div class=" card-body">
                <table class="w-100">
                    <?php $query_rate = mysqli_query($mysqli2, "SELECT * FROM table_rate_donate");
                    while ($rate_donate = mysqli_fetch_array($query_rate)) { ?>
                        <tr class="mb-2">
                            <td class=" text-white">
                                <img src="https://media.discordapp.net/attachments/924396892689956894/924779738218778704/equip_icon_gold.png" alt="" width="30px" height="30px">
                            </td>
                            <td class=" text-white text-sm-start">
                                <?= $rate_donate['price'] ?> บาท
                            </td>
                            <td class=" text-white text-center">
                                X<?= $setting['promotion'] ?>
                            </td>
                            <td class=" text-white text-end">
                                <?= ($setting['promotion'] > 0)? $rate_donate['point']*$setting['promotion'] : $rate_donate['point'] ?> พ้อย
                            </td>
                        </tr>
                    <?php } ?>
                </table>
            </div>
        </div>
    </div>
    <div class="col-8 position-relative">
        <div class=" card card-bg rounded-4 border-0 shadow position-absolute w-100" style="z-index: 999;">
            <div class=" card-header text-center <?php echo $fn_text ?>">
                เติมเงิน
            </div>
            <div class=" card-body ">
                <?php include('./components/topup_nav.php');
                include('./components/topup_conten.php');
                ?>

            </div>
        </div>
    </div>
</div>