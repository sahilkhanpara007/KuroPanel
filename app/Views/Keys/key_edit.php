<?= $this->extend('Layout/Starter') ?>
<?= $this->section('content') ?>
<?php
// $exCount = 0;
// if ($key->devices) {
//     $ex = explode(',', reduce_multiples($key->devices, ",", true));
//     $listDevice = "";
//     foreach ($ex as $ld) {
//         $listDevice .= "$ld\n";
//     }
//     $exCount = count($ex);
// }
?>

<div class="row pb-5 justify-content-center">
    <div class="col-lg-8">
        <?= $this->include('Layout/msgStatus') ?>

    </div>
    <div class="col-lg-8 mb-3">
        <div class="card">
            <div class="card-header text-white"style="background: linear-gradient(0.9turn, #FF00FF88, #25383C, #307D7E); max-width: 80rem;">
                <div class="row">
                    <div class="col pt-1">
                        Key Information
                    </div>
                    <div class="col">
                        <div class="text-end">
                            <a class="btn btn-sm btn-outline-light" href="<?= site_url('keys/generate') ?>"><i class="bi bi-person-plus"></i></a>
                            <a class="btn btn-sm btn-outline-light" href="<?= site_url('keys') ?>"><i class="bi bi-people"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <?= form_open('keys/edit') ?>

                <div class="row">
                    <input type="hidden" name="id_keys" value="<?= $key->id_keys ?>">
                    <?php if ($user->level == 1) : ?>
                        <div class="col-lg-6 mb-3">
                            <label for="game" class="form-label">Games</label>
                            <input type="text" name="game" id="game" class="form-control" placeholder="RandomKey" aria-describedby="help-game" value="<?= old('game') ?: $key->game ?>">
                            <?php if ($validation->hasError('game')) : ?>
                                <small id="help-game" class="text-danger"><?= $validation->getError('game') ?></small>
                            <?php endif; ?>
                        </div>
                        <div class="col-lg-6 mb-3">
                            <label for="user_key" class="form-label">User Key</label>
                            <input type="text" name="user_key" id="user_key" class="form-control" placeholder="RandomKey" aria-describedby="help-user_key" value="<?= old('user_key') ?: $key->user_key ?>">
                            <?php if ($validation->hasError('user_key')) : ?>
                                <small id="help-user_key" class="text-danger"><?= $validation->getError('user_key') ?></small>
                            <?php endif; ?>
                        </div>
                        <div class="col-lg-6 mb-3">
                            <label for="duration" class="form-label">Duration <small class="text-muted">(in days)</small></label>
                            <input type="number" name="duration" id="duration" class="form-control" placeholder="3" aria-describedby="help-duration" value="<?= old('duration') ?: $key->duration ?>">
                            <?php if ($validation->hasError('duration')) : ?>
                                <small id="help-duration" class="text-danger"><?= $validation->getError('duration') ?></small>
                            <?php endif; ?>
                        </div>
                        <div class="col-lg-6 mb-3">
                            <label for="max_devices" class="form-label">Max Devices</label>
                            <input type="number" name="max_devices" id="max_devices" class="form-control" placeholder="3" aria-describedby="help-max_devices" value="<?= old('max_devices') ?: $key->max_devices ?>">
                            <?php if ($validation->hasError('max_devices')) : ?>
                                <small id="help-max_devices" class="text-danger"><?= $validation->getError('max_devices') ?></small>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>
                    <div class="col-md-6 mb-2" id="col-status">
                        <label for="status" class="form-label">Status</label>
                        <?php $sel_status = ['' => '&mdash; Select Status &mdash;', '0' => 'Banned/Block', '1' => 'Active',]; ?>
                        <?= form_dropdown(['class' => 'form-select', 'name' => 'status', 'id' => 'status'], $sel_status, $key->status) ?>
                        <?php if ($validation->hasError('status')) : ?>
                            <small id="help-status" class="text-danger"><?= $validation->getError('status') ?></small>
                        <?php endif; ?>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="registrator" class="form-label">Registrator</label>
                        <input type="text" name="registrator" id="registrator" class="form-control" placeholder="nata" aria-describedby="help-registrator" value="<?= old('registrator') ?: $key->registrator ?>">
                        <?php if ($validation->hasError('registrator')) : ?>
                            <small id="help-registrator" class="text-danger"><?= $validation->getError('registrator') ?></small>
                        <?php endif; ?>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="expired_date" class="form-label">Expired <?= !$key->expired_date ? '(Not started yet)' : ''  ?></label>
                        <input type="text" name="expired_date" id="expired_date" class="form-control" placeholder="<?= $time::now() ?>" aria-describedby="help-expired_date" value="<?= old('expired_date') ?: $key->expired_date ?>">
                        <?php if ($validation->hasError('expired_date')) : ?>
                            <small id="help-expired_date" class="text-danger"><?= $validation->getError('expired_date') ?></small>
                        <?php endif; ?>
                    </div>
                    <div class="col-lg-12 mb-3">
                        <label for="devices" class="form-label">Devices <span class="bg-danger text-white px-1 rounded maxDev"><?= $key_info->total ?>/<?= $key->max_devices ?></span> <small class="text-muted">(Separately with enter)</small></label>
                        <textarea class="form-control" name="devices" id="devices" rows="<?= ($key_info->total > $key->max_devices) ? 3 : $key_info->total ?>"><?= old('devices') ?: ($key_info->total ? $key_info->devices : '') ?></textarea>
                        <?php if ($validation->hasError('devices')) : ?>
                            <small id="help-devices" class="text-danger"><?= $validation->getError('devices') ?></small>
                        <?php endif; ?>
                    </div>
                    <div class="col-lg-6">
                        <button class="btn btn-outline-dark btnUpdate" disabled>Update User Key</button>
                    </div>
                    <?= form_close() ?>

                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('js') ?>
<script>
    $(document).ready(function() {
        var level = "<?= $user->level ?>";
        if (level != 1) $("#registrator, #expired_date, #devices").attr('disabled', true);
        $("input, select, textarea").change(function() {
            $(".btnUpdate").attr('disabled', false);
        });
    });
    var total = "<?= $key_info->total ?>";
    $("#max_devices").change(function() {
        $(".maxDev").html(total + '/' + $(this).val());
        $("#devices").attr('rows', $(this).val());
    });
</script>
<?= $this->endSection() ?>