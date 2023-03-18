<?= $this->extend('Layout/Starter') ?>

<?= $this->section('content') ?>
<div class="row justify-content-center pt-3">
    <div class="col-lg-8">
        <?= $this->include('Layout/msgStatus') ?>
    </div>
    <div class="col-lg-8 mb-3">
        <div class="card mb-5">
                      <div class="card-header p-3 h5 text-white"style="background: linear-gradient(0.9turn, #0DFF00, #4000FF, #00FFEE);">
             Account Information
  </div>
                    <div href="<?= site_url('keys') ?>"><i class="bi bi-people"<</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <?= form_open() ?>
           
                <input type="hidden" name="user_id" value="<?= $target->id_users ?>">
                <div class="row">
                    <div class="col-md-6 mb-2">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" name="username" id="username" class="form-control" placeholder="" aria-describedby="help-username" value="<?= old('username') ?: $target->username ?>">
                        <?php if ($validation->hasError('username')) : ?>
                            <small id="help-username" class="form-text text-danger"><?= $validation->getError('username') ?></small>
                        <?php endif; ?>
                    </div>
                    <div class="col-md-6 mb-2">
                        <label for="fullname" class="form-label">Fullname</label>
                        <input type="text" name="fullname" id="fullname" class="form-control" placeholder="" aria-describedby="help-fullname" value="<?= old('fullname') ?: $target->fullname ?>">
                        <?php if ($validation->hasError('fullname')) : ?>
                            <small id="help-fullname" class="form-text text-danger"><?= $validation->getError('fullname') ?></small>
                        <?php endif; ?>
                    </div>
                    <div class="col-md-6 mb-2">
                        <label for="level" class="form-label">Roles</label>
                        <?php $sel_level = ['' => '&mdash; Select Roles &mdash;', '1' => 'Admin', '2' => 'Reseller',]; ?>
                        <?= form_dropdown(['class' => 'form-select', 'name' => 'level', 'id' => 'level'], $sel_level, $target->level) ?>
                    </div>
                    <div class="col-md-6 mb-2">
                        <label for="status" class="form-label">Status</label>
                        <?php $sel_status = ['' => '&mdash; Select Status &mdash;', '0' => 'Banned/Block', '1' => 'Active',]; ?>
                        <?= form_dropdown(['class' => 'form-select', 'name' => 'status', 'id' => 'status'], $sel_status, $target->status) ?>
                    </div>
                    <div class="col-md-6 mb-2">
                        <label for="saldo" class="form-label">Saldo</label>
                        <input type="number" name="saldo" id="saldo" class="form-control" placeholder="" aria-describedby="help-saldo" value="<?= old('saldo') ?: $target->saldo ?>">
                        <?php if ($validation->hasError('saldo')) : ?>
                            <small id="help-saldo" class="form-text text-danger"><?= $validation->getError('saldo') ?></small>
                        <?php endif; ?>
                    </div>
                    <div class="col-md-6 mb-2">
                        <label for="uplink" class="form-label">Uplink</label>
                        <input type="text" name="uplink" id="uplink" class="form-control" placeholder="" aria-describedby="help-uplink" value="<?= old('uplink') ?: $target->uplink ?>">
                        <?php if ($validation->hasError('uplink')) : ?>
                            <small id="help-uplink" class="form-text text-danger"><?= $validation->getError('uplink') ?></small>
                        <?php endif; ?>
                    </div>
                    <div class="col-md-12 mt-2">
                        <button type="submit" class="text-white btn btn-outline-dark"            <div class="card-header p-3 h5 text-white"style="background: linear-gradient(0.9turn, #0DFF00, #4000FF, #00FFEE);">Update Account Information</button>
                    </div>
                </div>
                <?= form_close() ?>

            </div>
        </div>

        <p class="text-muted text-center">
            <a href="<?= site_url('admin/manage-users') ?>" class="py-1 px-2 bg-white text-muted"><small><i class="bi bi-arrow-left"></i> Back to Manage users</small></a>
        </p>
    </div>
</div>
<?= $this->endSection() ?>