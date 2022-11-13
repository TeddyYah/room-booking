<!-- Begin Page Content -->
<div class="container">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?php echo $title ?></h1>
    </div>

    <div class="card col-md-10" style="margin-bottom: 100px">
        <div class="card-body">
            <form action="<?= base_url('user/updateBooking/' . $booking->id_ps)  ?>" method="post">
                <input type="hidden" name="id_ps" value="<?= $booking->id_ps ?>">
                <div class="form-group">
                    <label>Nama</label>
                    <input type="text" name="nama_pj" class="form-control" value="<?= $booking->nama_pj ?>"
                        readonly></input>
                    <div class="form-text text-danger"><?= form_error('nama_pj');  ?></div>
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email_pj" class="form-control" value="<?= $booking->email_pj ?>"
                        readonly></input>
                    <div class="form-text text-danger"><?= form_error('email_pj');  ?></div>
                </div>
                <div class="form-group">
                    <label>Tanggal</label>
                    <input type="date" name="tanggal_pj" class="form-control" value="<?= $booking->tanggal_pj ?>"
                        readonly></input>
                    <div class="form-text text-danger"><?= form_error('tanggal_pj');  ?></div>
                </div>
                <div class="row">
                    <div class="form-group col-md-6">
                        <label>Dari Jam</label>
                        <input type="time" name="dari" class="form-control" value="<?= $booking->dari_pj ?>"
                            readonly></input>
                        <div class="form-text text-danger"><?= form_error('dari') ?></div>
                    </div>
                    <div class="form-group col-md-6">
                        <label>Sampai jam</label>
                        <input type="time" name="sampai" class="form-control" value="<?= $booking->sampai_pj ?>"
                            readonly></input>
                        <div class="form-text text-danger"><?= form_error('sampai') ?></div>
                    </div>
                </div>
                <div class="form-group">
                    <label>Judul</label>
                    <textarea type="text" name="judul_pj" id="judul_pj" class="form-control"
                        required><?= $booking->judul_pj ?></textarea>
                    <div class="form-text text-danger"><?= form_error('judul_pj');  ?></div>
                </div>
                <div class="form-group">
                    <label>Keperluan</label>
                    <textarea type="text" name="keperluan_pj" id="keperluan_pj" class="form-control"
                        required><?= $booking->keperluan_pj ?></textarea>
                    <div class="form-text text-danger"><?= form_error('keperluan_pj');  ?></div>
                </div>

                <button type="submit" name="tambah" class="btn btn-success">Edit</button>
                <?php if ($booking->status_bo_pj == 'Take Video') : ?>
                <a href="<?= base_url('admin/waitingBooking'); ?>" class="btn btn-info ml-2">Kembali</a>
                <?php elseif ($booking->tanggal_pj == $date) : ?>
                <a href="<?= base_url('admin/todayBooking'); ?>" class="btn btn-info ml-2">Kembali</a>
                <?php endif; ?>
            </form>

        </div>
    </div>

</div>
<!-- /.container-fluid -->