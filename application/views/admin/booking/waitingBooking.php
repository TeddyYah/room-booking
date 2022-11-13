<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?php echo $title ?></h1>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">

            <div class="card-body">
                <div class="alert alert-warning alert-dismissible fade show mb-3" role="alert">
                    <strong>Note : Harap klik accept untuk menerima booking dan klik decline untuk menolak
                        booking</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="table-responsive">

                    <table class="table table-striped table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr class="text-center">
                                <th>No</th>
                                <th>Nama</th>
                                <!-- <th>Status</th> -->
                                <th>Email</th>
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
                                <td><?= $p->nama_pj; ?></td>
                                <td><?= $p->email_pj; ?></td>
                                <!-- <td><?= $p->status_pj ?></td> -->
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
                                    <?php elseif ($p->status_bo_pj == 'Expired') : ?>
                                    <span class="badge badge-danger text-dark">
                                        <?= $p->status_bo_pj; ?>
                                    </span>
                                    <?php elseif ($p->status_bo_pj == 'Cancel') : ?>
                                    <span class="badge badge-danger">
                                        <?= $p->status_bo_pj; ?>
                                    </span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <a href="<?= base_url('admin/detailBooking/') . $p->id_ps ?>"
                                        class="btn btn-sm btn-info" data-bs-toggle="tooltip" data-bs-placement="top"
                                        title="Detail">
                                        <i class="fas fa-info-circle"></i>
                                    </a>
                                    <?php if ($p->status_bo_pj == 'Booking') : ?>
                                    <a href="<?= base_url('admin/takeVideo/' . $p->id_ps)  ?>"
                                        class="btn btn-sm btn-primary acc-button">
                                        Accept
                                    </a>
                                    <a href="<?= base_url('admin/declineBooking/' . $p->id_ps)  ?>"
                                        class="btn btn-sm btn-outline-danger dec-button">
                                        Cancel
                                    </a>
                                    <?php endif; ?>

                                    <?php if ($p->status_bo_pj == 'Take Video') : ?>
                                    <a href="<?= base_url('admin/acceptBooking/' . $p->id_ps.'/'.$p->id_user)  ?>"
                                        class="btn btn-sm btn-primary acc-button" data-bs-toggle="tooltip"
                                        data-bs-placement="top" title="Done">
                                        <i class="fas fa-check"></i>
                                    </a>
                                    <a href="<?= base_url('admin/editBooking/' . $p->id_ps)  ?>"
                                        class="btn btn-sm btn-warning" data-bs-toggle="tooltip" data-bs-placement="top"
                                        title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="<?= base_url('admin/declineBooking/' . $p->id_ps)  ?>"
                                        class="btn btn-sm btn-danger dec-button" data-bs-toggle="tooltip"
                                        data-bs-placement="top" title="Cancel">
                                        <i class="fas fa-times"></i>
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