<?= $this->extend('Layout/Starter') ?>

<?= $this->section('content') ?>
<div class="row">
    <div class="col-lg-12">
        <div class="alert alert-primary" role="alert">
            
        </div>
        <div class="card shadow-sm">
           
<div class="card-header text-white"style="background: linear-gradient(0.9turn, #0DFF00, #4000FF, #00FFEE);">
                
  <a class="btn btn-outline-light btn-sm" href="<?= site_url('keys/generate') ?>"><i class="bi bi-person-plus"></i> Generate Keys</a>
           
           <a class="btn btn-outline-light btn-sm" href="<?= site_url('admin/user/alter') ?>"><i class="bi bi-file-person"></i>Delete Users</a>
           
            </div>
            <div class="card-body">
                <!-- <?php if ($user_list) : ?> -->

                <div class="table-responsive">
                    <table id="datatable" class="table table-bordered table-hover text-center" style="width:100%">
                        <thead>
                            <tr>
                                <th scope="row">#</th>
                                <th>Username</th>
                                <th>Fullname</th>
                                <th>Level</th>
                                <th>Saldo</th>
                                <th>Status</th>
                                <th>Uplink</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                    </table>
                </div>
                <!-- <?php endif; ?> -->

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
        var table = $('#datatable').DataTable({
            processing: true,
            serverSide: true,
            order: [
                [0, "desc"]
            ],
            ajax: "<?= site_url('admin/api/users') ?>",
            columns: [{
                    data: 'id',
                },
                {
                    data: 'username',
                },
                {
                    data: 'fullname',
                    render: function(data, type, row, meta) {
                        return (row.fullname ? row.fullname : '~');
                    }
                },
                {
                    data: 'level',
                },
                {
                    data: 'saldo',
                    render: function(data, type, row, meta) {
                        var textc = (row.level === 'Admin' ? 'primary' : 'dark');
                        var saldo = (row.level === 'Admin' ? '&mstpos;' : row.saldo);
                        return `<span class="badge text-${textc}">${saldo}</span>`;
                    }
                },
                {
                    data: 'status',
                    name: 'status',
                    render: function(data, type, row, meta) {
                        var act = `<span class="text-success">Active</span>`;
                        var ban = `<span class="text-danger">Banned</span>`;
                        return (row.status == 1 ? act : ban);
                    }
                },
                {
                    data: 'uplink',
                },
                {
                    data: null,
                    render: function(data, type, row, meta) {
              return `<a href="${window.location.origin}/admin/user/${row.id}" class="text-white btn btn-"style="background: linear-gradient(0.9turn, #FF00FF88, #25383C, #307D7E);" btn-sm">EDIT</a>`;
                    }
                }
            ]
        });
    });
</script>

<?= $this->endSection() ?>