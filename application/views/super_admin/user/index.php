<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?php echo $title ?></h1>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="card-body">
                <a class="btn btn-sm btn-primary mb-3" href="<?= base_url('super_admin/addUser"'); ?>"">
						<i class=" fas fa-plus mr-2"></i>Add User Account
                </a>

                <div class="table-responsive">
                    <table class="table table-striped table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr class="text-center">
                                <th>No</th>
                                <th>Fullname</th>
                                <th>Username</th>
                                <th>Role</th>
                                <th>Date Created</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1;
                            foreach ($member as $m) : ?>
                            <tr class="text-center">
                                <td><?= $no++ ?></td>
                                <td><?= $m->fullname ?></td>
                                <td><?= $m->username ?></td>
                                <td><?= $m->nama_role?></td>
                                <td width="120px">
                                    <?= date('d-M-Y', strtotime($m->created_at)) ?>
                                </td>
                                <td>
                                    <a href="<?= base_url('super_admin/detailUser/') . $m->id_user ?>"
                                        class="btn btn-sm btn-info" data-bs-toggle="tooltip" data-bs-placement="top"
                                        title="Detail">
                                        <i class="fas fa-info-circle"></i>
                                    </a>
                                    <a href="<?= base_url('super_admin/editUser/') . $m->id_user ?>"
                                        class="btn btn-sm btn-warning" data-bs-toggle="tooltip" data-bs-placement="top"
                                        title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <!-- <a href="<?= base_url('super_admin/deleteUser/' . $m->id_user)  ?>" class="btn btn-sm btn-danger delete-btn" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete">
                                            <i class="fas fa-trash"></i>
                                        </a> -->
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->