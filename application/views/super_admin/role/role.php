<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <div class="row">
        <div class="col-lg-6">
            <?= form_error('menu', '<div class="alert alert-danger" role="alert">', '</div>'); ?>

            <?= $this->session->flashdata('message'); ?>

            <a href="" class="btn btn-primary mb-3" data-toggle="modal" data-target="#newRoleModal">Add New Role</a>

            <div class="table-responsive">
                <table class="table table-striped table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Role</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        <?php foreach ($role as $r) : ?>
                        <tr>
                            <th scope="row"><?= $i; ?></th>
                            <td><?= $r['nama_role']; ?></td>
                            <td>
                                <a href="<?= base_url('super_admin/roleaccess/' . $r['id_role'])  ?>"
                                    class="btn btn-sm btn-success" data-bs-toggle="tooltip" data-bs-placement="top"
                                    title="Access">
                                    <i class="fas fa-check-square"> Access</i>
                                </a>
                                <a href="<?= base_url('super_admin/editRole/' . $r['id_role'])  ?>"
                                    class="btn btn-sm btn-warning" data-bs-toggle="tooltip" data-bs-placement="top"
                                    title="Edit">
                                    <i class="fas fa-edit"> Edit</i>
                                </a>
                                <?php if($r['id_role'] != 1) : ?>
                                <a href="<?= base_url('super_admin/deleteRole/' . $r['id_role']) ?>"
                                    class="btn btn-sm btn-danger delete-btn" data-bs-toggle="tooltip"
                                    data-bs-placement="top" title="Delete">
                                    <i class="fas fa-trash"> Delete</i>
                                    <?php endif; ?>
                                </a>
                            </td>
                        </tr>
                        <?php $i++; ?>
                        <?php endforeach; ?>
                    </tbody>
                </table>

            </div>
        </div>
    </div>



</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<!-- Modal -->

<!-- Modal -->
<div class="modal fade" id="newRoleModal" tabindex="-1" role="dialog" aria-labelledby="newRoleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newRoleModalLabel">Add New Role</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('super_admin/role/'); ?>" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" class="form-control" id="nama_role" name="nama_role" placeholder="Role name">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add</button>
                </div>
            </form>
        </div>
    </div>
</div>