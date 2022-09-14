<div class=" d-flex justify-content-center">
    <div class="nav nav-pills me-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">
        <button class="nav-link btn-tmw active d-flex align-items-center justify-content-center px-2 me-2 text-center" id="v-pills-tmw-tab" data-bs-toggle="pill" data-bs-target="#v-pills-tmw" type="button" role="tab" aria-controls="v-pills-tmw" aria-selected="true" style="width: 220px"><i class="bank bank-tmn xxxl"></i>Truewallet Gift</button>
        <?php if ($license['kbank'] == 'active') { ?>
            <button class="nav-link btn-kbank d-flex align-items-center justify-content-center px-2 me-2" id="v-pills-kbank-tab" data-bs-toggle="pill" data-bs-target="#v-pills-kbank" type="button" role="tab" aria-controls="v-pills-tmw" aria-selected="true" style="width: 220px"><i class="bank bank-kbank xxxl"></i>Kasikornbank</button>
        <?php } ?>
        <?php if ($license['scb'] == 'active') { ?>
            <button class="nav-link btn-scb d-flex align-items-center justify-content-center px-2 me-2" id="v-pills-scb-tab" data-bs-toggle="pill" data-bs-target="#v-pills-scb" type="button" role="tab" aria-controls="v-pills-tmw" aria-selected="true" style="width: 220px"><i class="bank bank-scb xxxl"></i>Siam Commercial Bank</button>
        <?php } ?>
    </div>
</div>