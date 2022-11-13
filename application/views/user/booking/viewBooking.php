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
                    <form class="form-inline" action="<?= base_url('user/viewBooking/')  ?>" method="post">
                        <div class="form-group mb-2">
                            <label for="tglm">Tanggal Mulai </label>
                            <input type="date" class="form-control ml-2" name="tglm" required>
                        </div>

                        <div class="form-group mb-2 ml-3 ">
                            <label>Tanggal Selesai </label>
                            <input type="date" class="form-control ml-2" name="tgls" required>
                        </div>
                        <button type="submit" name="cek" class="btn btn-success mb-2 ml-auto">
                            <i class=" far fa-eye"></i> Check Schedule</button>
                        <a class="btn btn btn-primary mb-2 ml-2" href="<?= base_url('user/addBooking"'); ?>">
                            <i class=" fas fa-plus mr-2"></i>Add Booking</a>
                    </form>

                    <?php  
                    $tglm = $this->input->post('tglm', TRUE);
                    $tgls = $this->input->post('tgls', TRUE);
                    ?>
                    <div class="alert alert-info">
                        Menampilkan Schedule dari <span class="font-weight-bold"><?= $tglm ?> - <span
                                class="font-weight-bold"><?= $tgls ?>
                    </div>

                </div>
                <div class="table-responsive">
                    <table class="table table-striped table-bordered" id="dataTable" width="100%" cellspacing="0">
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
                                <td><?= $p['nama_pj']; ?></td>
                                <td width="120px">
                                    <?= date('d-M-Y', strtotime($p['tanggal_pj'])) ?>
                                </td>
                                <td class="text-center">
                                    <?= $p['dari_pj'] . ' s/d ' . $p['sampai_pj'] ?>
                                </td>
                                <td>
                                    <?php if ($p['status_bo_pj'] == 'Booking') : ?>
                                    <span class="badge badge-primary text-white">
                                        <?= $p['status_bo_pj']; ?>
                                    </span>
                                    <?php elseif ($p['status_bo_pj'] == 'Take Video') : ?>
                                    <span class="badge badge-warning text-dark">
                                        <?= $p['status_bo_pj']; ?>
                                    </span>
                                    <?php elseif ($p['status_bo_pj'] == 'Done Take') : ?>
                                    <span class="badge badge-success">
                                        <?= $p['status_bo_pj']; ?>
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
</div>
<!-- /.container-fluid -->