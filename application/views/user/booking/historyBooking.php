<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?= $title ." : $user->fullname "?></h1>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr class="text-center">
                                <th>No</th>
                                <th>Tanggal</th>
                                <th>Jam</th>
                                <th>Status</th>
                                <th width="150px">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1;
								foreach ($booking as $p) : ?>
                            <tr class="text-center">
                                <td><?= $no++ ?></td>
                                <td width="120px">
                                    <?= date('d-M-Y', strtotime($p->tanggal_pj)) ?>
                                </td>
                                <td class="text-center">
                                    <?= $p->dari_pj . ' s/d ' . $p->sampai_pj ?>
                                </td>
                                <td>
                                    <?php if ($p->status_bo_pj == 'Booking') : ?>
                                    <span class="badge badge-primary text-white">
                                        <?= $p->status_bo_pj; ?>
                                    </span>
                                    <?php elseif ($p->status_bo_pj == 'Take Video') : ?>
                                    <span class="badge badge-warning text-dark">
                                        <?= $p->status_bo_pj; ?>
                                    </span>
                                    <?php else : ?>
                                    <span class="badge badge-success">
                                        <?= $p->status_bo_pj; ?>
                                    </span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <a href="<?= base_url('user/detailBooking/') . $p->id_ps ?>"
                                        class="btn btn-sm btn-info" data-bs-toggle="tooltip" data-bs-placement="top"
                                        title="Detail">
                                        <i class="fas fa-info-circle"></i>
                                    </a>
                                    <?php if ($p->status_bo_pj == 'Booking') : ?>
                                    <a href="<?= base_url('user/editBooking/' . $p->id_ps)  ?>"
                                        class="btn btn-sm btn-primary"> Edit
                                    </a>
                                    <a href="<?= base_url('user/cancelBooking/' . $p->id_ps)  ?>"
                                        class="btn btn-sm btn-outline-danger cancel-button"> Cancel
                                    </a>
                                    <?php endif; ?>
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