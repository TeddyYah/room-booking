<div class="container">
    <div class="row mt-3">
        <div class="col-md-10">

            <h4 class="mb-4 text-dark"><?= $title  ?></h4>
            <div class="card">
                <div class="card-body">
                    <?php if ($booking->status_bo_pj == 'Booking') : ?>
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <strong>Mohon menunggu persetujuan dari Admin..</strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <?php endif; ?>

                    <center>
                        <table>
                            <tr>
                                <td width="80px" class="pb-3">Nama</td>
                                <td width="20px" class="pb-3">:</td>
                                <td width="200px" class="pb-3"><?= $booking->nama_pj;  ?></td>
                            </tr>
                            <tr>
                                <td width="80px" class="pb-3">Email</td>
                                <td width="20px" class="pb-3">:</td>
                                <td width="200px" class="pb-3"><?= $booking->email_pj;  ?></td>
                            </tr>
                            <tr>
                                <td width="80px" class="pb-3">Tanggal</td>
                                <td width="20px" class="pb-3">:</td>
                                <td width="200px" class="pb-3">
                                    <?= date('d-M-Y', strtotime($booking->tanggal_pj))  ?>
                                </td>
                            </tr>
                            <tr>
                                <td width="80px" class="pb-3">Jam</td>
                                <td width="20px" class="pb-3">:</td>
                                <td width="200px" class="pb-3">
                                    <?= $booking->dari_pj . ' s/d ' . $booking->sampai_pj ?>
                                </td>
                            </tr>
                            <tr>
                                <td width="80px" class="pb-3">Judul</td>
                                <td width="20px" class="pb-3">:</td>
                                <td width="200px" class="pb-3"><?= $booking->judul_pj;  ?></td>
                            </tr>
                            <tr>
                                <td width="80px" class="pb-3">Keperluan</td>
                                <td width="20px" class="pb-3">:</td>
                                <td width="200px" class="pb-3"><?= $booking->keperluan_pj;  ?></td>
                            </tr>
                            <tr>
                                <td width="80px" class="pb-3">Status</td>
                                <td width="20px" class="pb-3">:</td>
                                <td width="200px" class="pb-3">
                                    <?php if ($booking->status_bo_pj == 'Booking') : ?>
                                    <span class="badge badge-primary text-white">
                                        <?= $booking->status_bo_pj; ?>
                                    </span>
                                    <?php elseif ($booking->status_bo_pj == 'Take Video') : ?>
                                    <span class="badge badge-warning text-dark">
                                        <?= $booking->status_bo_pj; ?>
                                    </span>
                                    <?php elseif ($booking->status_bo_pj == 'Cancel') : ?>
                                    <span class="badge badge-danger">
                                        <?= $booking->status_bo_pj; ?>
                                    </span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        </table>
                        <a href="<?= base_url('user/historyBooking'); ?>" class="btn btn-sm btn-primary">Kembali</a>
                    </center>
                </div>
            </div>

        </div>
    </div>
</div>