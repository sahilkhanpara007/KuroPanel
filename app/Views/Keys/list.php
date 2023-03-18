<?= $this->extend('Layout/Starter') ?>

<?= $this->section('content') ?>

<style>
div.scrollmenu {
  background-color: transparent;
  overflow: auto;
  white-space: nowrap;
}

div.scrollmenu a {
  display: inline-block;
  color: white;
  text-align: center;
 
  text-decoration: none;
}

div.scrollmenu a:hover {
  background-color: transparent;
}
</style>
<div class="row">
    <div class="col-lg-12">
        <div class="alert alert-person" role="alert">
            
        </div>
        <div class="card shadow-sm">
           
            <div class="card-header bg-dark text-white h6 p-3"style="background: linear-gradient(0.9turn,    #15FF00, #001EFF, #05b022);">
                    <?php if ($user->level == 1) : ?>
                    <div class="scrollmenu">
           <a id="deletek" class="btn btn-outline-light btn-sm" onclick="deletekeys('/keys/alter')"><i class="bi bi-trash-fill"></i> KEYS</a>
           <a id="deletekk" class="btn btn-outline-light btn-sm" onclick="deletekeys('/keys/alterunused')"><i class="bi bi-trash-fill"></i> UNUSED KEYS</a>
           <a id="deletekkk" class="btn btn-outline-light btn-sm" onclick="deletekeys('/keys/alterused')"><i class="bi bi-trash-fill"></i> USED KEYS</a>
           
                      <?php endif; ?>
           <a class="btn btn-outline-light btn-sm" href="<?= site_url('keys/download/used') ?>"><i class="bi bi-cloud-arrow-down"></i> USED KEY(s)</a>
           <a class="btn btn-outline-light btn-sm" href="<?= site_url('keys/download/unused') ?>"><i class="bi bi-cloud-arrow-down"></i> UNUSED KEY(s)</a>
            <a class="btn btn-outline-light btn-sm" href="<?= site_url('keys/download/all') ?>"><i class="bi bi-cloud-arrow-down-fill"></i> ALL KEY(s)</a>
           </div>
            </div>
            <br>

<div class="row justify-content-center">
    <div class="row">
        <div class="col-lg-12">
            <?= $this->include('Layout/msgStatus') ?>
        </div>
        <div class="col-lg-12">
            <div class="card shadow-sm text-light">
                <div class="card-header"style="background: linear-gradient(0.9turn, #15FF00, #001EFF, #05b022);" text-white">
                    <div class="row">
                        <div class="col pt-1">
                            Keys Registered
                        </div>
                        <div class="col text-end">
                            <a class="btn btn-outline-light btn-sm" href="<?= site_url('keys/generate') ?>"><i class="bi bi-person-plus"></i> KEY</a>
            <button class="btn btn-secondary btn-sm ms-1" id="blur-out" data-bs-toggle="tooltip" data-bs-placement="top" title="Eye Protect"><i class="bi bi-eye-slash"></i></button>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <?php if ($keylist) : ?>
                        <div class="table-responsive">
                            <table id="datatable" class="table table-bordered table-hover text-center" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Game</th>
                                        <th>User Keys</th>
                                        <th>Devices</th>
                                        <th>Duration</th>
                                        <th>Expired</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    <?php else : ?>
                        <p class="text-center">Nothing keys to show</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('css') ?>
<?= link_tag("https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap5.min.css") ?>

<?= $this->endSection() ?>

<?= $this->section('js') ?>
<?= script_tag("https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js") ?>

<?= script_tag("https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap5.min.js") ?>
<script>
    $(document).ready(function() {
            var level = "<?= $user->level ?>";
        if (level != 1) $("#deletek").attr('disabled', true);
    
        var table = $('#datatable').DataTable({
            processing: true,
            serverSide: true,
            order: [
                [0, "desc"]
            ],
            ajax: "<?= site_url('keys/api') ?>",
            columns: [{
                    data: 'id',
                    name: 'id_keys'
                },
                {
                    data: 'game',
                },
                {
                    data: 'user_key',
                    render: function(data, type, row, meta) {
                        var is_valid = (row.status == 'Active') ? "text-success" : "text-danger";
                        return `<span class="${is_valid} keyBlur key-sensi">${(row.user_key ? row.user_key : '&mdash;')}</span> `;
                    }
                },
                {
                    data: 'devices',
                    render: function(data, type, row, meta) {
                        var totalDevice = (row.devices ? row.devices : 0);
                        return `<span id="devMax-${row.user_key}">${totalDevice}/${row.max_devices}</span>`;
                    }
                },
                {
                    data: 'duration',
                    render: function(data, type, row, meta) {
                        return row.duration;
                    }
                },
                {
                    data: 'expired',
                    name: 'expired_date',
                    render: function(data, type, row, meta) {
                        return row.expired ? `<span class="badge text-dark">${row.expired}</span>` : '(not started yet)';
                    }
                },
                {
                    data: null,
                    render: function(data, type, row, meta) {
                        var btnReset = `<button class="btn btn-outline-danger btn-sm" style="background: linear-gradient(0.9turn,#15FF00, #001EFF, #05b022); max-width: 80rem;" onclick="resetUserKey('${row.user_key}')"
                        data-bs-toggle="tooltip" data-bs-placement="left" title="Reset key?"><i class="bi bi-bootstrap-reboot"></i></button>`;
                        var btnEdits = `<a href="${window.location.origin}/keys/${row.id}" class="btn btn-outline-light btn-sm"style="background: linear-gradient(0.9turn, #15FF00, #001EFF, #05b022); max-width: 80rem;"
                        data-bs-toggle="tooltip" data-bs-placement="left" title="Edit key information?"><i class="bi bi-person"></i></a>`;
                        return `<div class="d-grid gap-2 d-md-block">${btnReset} ${btnEdits}</div>`;
                    }
                }
            ]
        });

        $("#blur-out").click(function() {
            if ($(".keyBlur").hasClass("key-sensi")) {
                $(".keyBlur").removeClass("key-sensi");
                $("#blur-out").html(`<i class="bi bi-eye"></i>`);
            } else {
                $(".keyBlur").addClass("key-sensi");
                $("#blur-out").html(`<i class="bi bi-eye-slash"></i>`);
            }
        });
    });

    function resetUserKey(keys) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#ced630',
            cancelButtonColor: '#3633dd',
            confirmButtonText: 'Yes, reset'
        }).then((result) => {
            if (result.isConfirmed) {
                Toast.fire({
                    icon: 'info',
                    title: 'Please wait...'
                })

                var base_url = window.location.origin;
                var api_url = `${base_url}/keys/reset`;
                $.getJSON(api_url, {
                        userkey: keys,
                        reset: 1
                    },
                    function(data, textStatus, jqXHR) {
                        if (textStatus == 'success') {
                            if (data.registered) {
                                if (data.reset) {
                                    $(`#devMax-${keys}`).html(`0/${data.devices_max}`);
                                    Swal.fire(
                                        'Reset!',
                                        'Your device key has been reset.',
                                        'success'
                                    )
                                } else {
                                    Swal.fire(
                                        'Failed!',
                                        data.devices_total ? "You don't have any access to this user." : "User key devices already reset.",
                                        data.devices_total ? 'error' : 'warning'
                                    )
                                }
                            } else {
                                Swal.fire(
                                    'Failed!',
                                    "User key no longer exists.",
                                    'error'
                                )
                            }
                        }
                    }
                );
            }
        });
    }
    function deletekeys(gaga) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#ff0000',
            cancelButtonColor: '#3633dd',
            confirmButtonText: 'Yes, delete'
        }).then((result) => {
            if (result.isConfirmed) {
            var host = window.location.protocol + "//" + window.location.host;
window.location = (host.concat(gaga));
                Toast.fire({
                    icon: 'info',
                    title: 'Please wait...'
                })
setTimeout(success, 3000)
            }
        });
    }
    function success(){
                                        Swal.fire(
                                        'Reset!',
                                        'Your device key has been reset.',
                                        'success'
                                    )
    }
</script>

<?= $this->endSection() ?>