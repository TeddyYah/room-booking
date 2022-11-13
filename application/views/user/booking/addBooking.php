<!-- Begin Page Content -->
<div class="container">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?php echo $title ?></h1>
    </div>

    <div class="card col-md-10" style="margin-bottom: 100px">
        <div class="card-body">
            <div class="alert alert-warning alert-dismissible fade show mb-3" role="alert">
                <strong>Note :
                    <br>1. Harap ikuti syarat dan ketentuan MRS sebelum melakukan pemesanan!
                    <br>2. Karena isi dari formulir ini akan terhapus secara otomatis dan akan me-refresh isi halaman ke
                    keadaan semula!
                </strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form action="<?= base_url('user/addBooking') ?>" method="post">
                <div class="form-group">
                    <label>Nama</label>
                    <input type="text" name="nama_pj" class="form-control" value="<?= $user->fullname ?>"
                        readonly></input>
                    <div class="form-text text-danger"><?= form_error('nama_pj');  ?></div>
                </div>

                <!-- <div class="form-group">
                    <label>Status</label>
                    <input type="text" name="status_pj" class="form-control" value="<?= $user->status_user ?>"
                        readonly></input>
                </div> -->

                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email_pj" class="form-control" value="<?= $user->email_pj ?>"
                        readonly></input>
                </div>

                <!-- type="hidden" untuk menyembunyikan input -->
                <div class="form-group">
                    <label>Jumlah Reservasi</label>
                    <input type="number" name="jumlah_booking" class="form-control" value="<?= $user->jumlah_booking ?>"
                        readonly></input>
                </div>

                <div class="form-group">
                    <label>Tanggal</label>
                    <input type="date" name="tanggal_pj" class="form-control" id="datetimepicker1"
                        value="<?= set_value('tanggal_pj') ?>"></input>
                    <div class="form-text text-danger"><?= form_error('tanggal_pj');  ?></div>
                </div>

                <div class="row">
                    <div class="form-group col-md-6">
                        <label>Dari Jam</label>
                        <input type="time" name="dari" class="form-control" value="<?= set_value('dari') ?>"></input>
                        <div class="form-text text-danger"><?= form_error('dari') ?></div>
                    </div>
                    <div class="form-group col-md-6">
                        <label>Sampai jam</label>
                        <input type="time" name="sampai" class="form-control"
                            value="<?= set_value('sampai') ?>"></input>
                        <div class="form-text text-danger"><?= form_error('sampai') ?></div>
                    </div>
                </div>

                <div class="form-group">
                    <label>Judul</label>
                    <textarea type="text" name="judul_pj" class="form-control"><?= set_value('judul_pj') ?></textarea>
                    <div class="form-text text-danger"><?= form_error('judul_pj');  ?></div>
                </div>

                <div class="form-group">
                    <label>Keperluan</label>
                    <textarea type="text" name="keperluan_pj"
                        class="form-control"><?= set_value('keperluan_pj') ?></textarea>
                    <div class="form-text text-danger"><?= form_error('keperluan_pj');  ?></div>
                </div>

                <!-- <div class="form-group" hidden>
                    <label>Kondisi</label>
                    <input type="text" name="status_bo_pj" class="form-control"></input>
                    
                </div> -->

                <button type="submit" name="tambah" class="btn btn-success"> Submit</button>
                <a href="<?= base_url('user/viewBooking'); ?>" class="btn btn-primary ml-2">Kembali</a>
            </form>
        </div>
    </div>

</div>
<!-- /.container-fluid -->