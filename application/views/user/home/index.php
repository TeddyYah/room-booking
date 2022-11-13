    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800"><?php echo $title ?></h1>
        </div>

        <!-- Content Row -->
        <div class="row">

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-4 col-md-4 mb-4">
                <div class="card border-left-warning shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-sm font-weight-bold text-danger text-uppercase mb-1">
                                    Waiting
                                </div>
                                <div class="row no-gutters align-items-center">
                                    <div class="col-auto">
                                        <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">
                                            <?= $waiting ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-calendar-check fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-4 col-md-4 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-sm font-weight-bold text-primary text-uppercase mb-1">
                                    Done Take</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    <?= $done ?>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-users fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-4 col-md-4 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-sm font-weight-bold text-success text-uppercase mb-1">
                                    On Take Video</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    <?php if (!$take) : ?>
                                    <?= "-" ?>
                                    <?php else : ?>
                                    <?php foreach ($take as $t) : ?>
                                    <?= $t->nama_pj ?></br>
                                    <?= $t->dari_pj . ' s/d ' . $t->sampai_pj?>
                                    <?php endforeach; ?>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-user-cog fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Content Row -->
        <!-- Begin Page Content -->
        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <div class="card-body">
                        <h5 class="card-title"><strong>Jadwal Booking Today</strong></h5>
                        <div class="alert alert-warning alert-dismissible fade show mb-3" role="alert">
                            <strong>
                                Jam Operasional : 08:00-12:00 dan 13:00-16:00
                                <br>
                                Jam Istirahat : 12:00-13:00
                                <br><br>
                                Syarat waktu Take Video :
                                <br>
                                1. Min. 10 menit
                                <br>
                                2. Max. 30 menit
                                <br>
                                Jika anda ingin melakukan booking ulang, silahkan hapus data booking pada menu <a
                                    href="<?= base_url('user/HistoryBooking') ?>">history booking</a>
                            </strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div>
                            <a class="btn btn-sm btn-primary mb-3" href="<?= base_url('user/addBooking"'); ?>"">
						<i class=" fas fa-plus mr-2"></i>Booking Ruangan</a>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered" id="dataTable" width="100%"
                                cellspacing="0">
                                <thead>
                                    <tr class="text-center">
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Tanggal</th>
                                        <th>Jam</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr class="text-center">
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Tanggal</th>
                                        <th>Jam</th>
                                        <th>Status</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    <?php $no = 1; foreach ($pesanan as $p) : ?>
                                    <tr class="text-center">
                                        <td><?= $no++ ?></td>
                                        <td><?= $p->nama_pj; ?></td>
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
                                            <?php elseif ($p->status_bo_pj == 'Done Take') : ?>
                                            <span class="badge badge-success">
                                                <?= $p->status_bo_pj; ?>
                                            </span>
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

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- End of Main Content -->