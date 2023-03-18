<?= $this->extend('Layout/Starter') ?>

<?= $this->section('content') ?>
<div class="row">
    <div class="col-lg-12">
        <?= $this->include('Layout/msgStatus') ?>
    </div>
    <div class="col-lg-4 mb-3">
        <div class="card">
                   <div class="card-header p-3 h6 text-white"style="background: linear-gradient(0.9turn, #0DFF00, #4000FF, #00FFEE);">
                Generate</a>
            </div>
            <div class="card-body">
                <?= form_open() ?>

                <div class="form-group mb-3">
                    <label for="set_saldo">You can set with multiple saldo</label>
                    <div class="input-group mt-2">
                        <span class="input-group-text"><i class="bi bi-currency-dollar"></i></span>
                        <input type="number" class="form-control" name="set_saldo" id="set_saldo" minlength="1" maxlength="11" value="5">
                    </div>
                    <?php if ($validation->hasError('set_saldo')) : ?>
                        <small id="help-saldo" class="text-danger"><?= $validation->getError('set_saldo') ?></small>
                    <?php endif; ?>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-outline-dark">Create Code</button>
                </div>
                <?= form_close() ?>
            </div>
        </div>
    </div>
    <div class="col-lg-8">
        <?php if ($code) : ?>
            <div class="card">
            <div class="card-header p-3 h6 bg-success text-white"style="background: linear-gradient(0.9turn, #0DFF00, #4000FF, #00FFEE);">
                    History Generate </a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover text-center" style="width:100%">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Referral hashed</th>
                                    <th>Saldo</th>
                                    <th>Used by</th>
                                    <th>Create by</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($code as $c) : ?>
                                    <tr>
                                        <td><?= $c->id_reff ?></td>
                                        <td><?= substr($c->code, 1, 15) ?></td>
                                        <td>$<?= $c->set_saldo ?></td>
                                        <td><?= $c->used_by ?: '&mdash;' ?></td>
                                        <td><?= $c->created_by ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>
<?= $this->endSection() ?>