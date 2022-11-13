<div class="container">
    <div class="row mt-3">
        <div class="col-md-10">

            <h4 class="mb-4 text-dark"><?= $title  ?></h4>
            <div class="card">
                <div class="card-body">
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
                                <!-- <td width="80px" class="pb-3">Status</td>
                                <td width="20px" class="pb-3">:</td>
                                <td width="200px" class="pb-3"><?= $booking->status_pj;  ?></td>
                            </tr> -->
                                <!-- <tr>
                                <td width="80px" class="pb-3">No induk</td>
                                <td width="20px" class="pb-3">:</td>
                                <td width="200px" class="pb-3"><?= $booking->no_induk_pj;  ?></td>
                            </tr> -->
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
                                    <?php else : ?>
                                    <span class="badge badge-success">
                                        <?= $booking->status_bo_pj; ?>
                                    </span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                            <tr>
                                <td width="80px" class="pb-3">Jumlah Booking</td>
                                <td width="20px" class="pb-3">:</td>
                                <td width="200px" class="pb-3"><?= $booking->jumlah_booking;  ?></td>
                            </tr>
                        </table>

                        <?php if ($booking->status_bo_pj == 'Booking') : ?>
                        <a href="<?= base_url('admin/takeVideo/' . $booking->id_ps)  ?>"
                            class="btn btn-primary acc-button">
                            Accept
                        </a>
                        <a href="<?= base_url('admin/declineBooking/' . $booking->id_ps)  ?>"
                            class="btn btn-outline-danger dec-button">
                            Cancel
                        </a>
                        <?php endif; ?>

                        <?php if ($booking->status_bo_pj == 'Take Video') : ?>
                        <a href="<?= base_url('admin/acceptBooking/' . $booking->id_ps.'/'.$booking->id_user)  ?>"
                            class="btn btn-primary acc-button" data-bs-toggle="tooltip" data-bs-placement="top"
                            title="Done">
                            <i class="fas fa-check"> Done Take</i>
                        </a>
                        <a href="<?= base_url('admin/editBooking/' . $booking->id_ps)  ?>" class="btn btn-warning ml-2"
                            data-bs-toggle="tooltip" data-bs-placement="top" title="Edit">
                            <i class="fas fa-edit"> Edit</i>
                        </a>
                        <a href="<?= base_url('admin/declineBooking/' . $booking->id_ps)  ?>"
                            class="btn btn-danger dec-button ml-2" data-bs-toggle="tooltip" data-bs-placement="top"
                            title="Cancel">
                            <i class="fas fa-times"> Cancel</i>
                        </a>
                        <?php endif; ?>

                        <?php 
                        date_default_timezone_set('Asia/Jakarta');
                        $date = date('Y-m-d');
                        ?>
                        <?php if ($booking->status_bo_pj == 'Done Take') : ?>
                        <a href="<?= base_url('admin/allDataBooking'); ?>" class="btn btn-info ml-2">Kembali</a>
                        <?php elseif ($booking->status_bo_pj == 'Booking') : ?>
                        <a href="<?= base_url('admin/waitingBooking'); ?>" class="btn btn-info ml-2">Kembali</a>
                        <?php elseif ($booking->tanggal_pj == $date) : ?>
                        <a href="<?= base_url('admin/todayBooking'); ?>" class="btn btn-info ml-2">Kembali</a>
                        <?php endif; ?>
                    </center>
                </div>
            </div>

        </div>
    </div>
</div>