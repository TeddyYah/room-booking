<!-- Begin Page Content -->
<div class="container">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?= $title ?></h1>
    </div>

    <div class="card col-md-10" style="margin-bottom: 100px">
        <div class="card-body">
            <?= form_open_multipart('super_admin/addSlider');?>
            <!-- <form action="<?= base_url('super_admin/addSlider') ?>" method="post"> -->
            <div class="form-group">
                <label>Nama</label>
                <input type="text" name="nama" class="form-control" required></input>
            </div>
            <div class="form-group">
                <label>Image</label>
                <input type="file" name="image" class="form-control-file" required>
            </div>

            <button type="submit" name="tambah" class="btn btn-success"> Submit</button>
            <a href="<?= base_url('super_admin/pageHome/Slider'); ?>" class="btn btn-primary ml-2">Kembali</a>
            </form>
        </div>
    </div>

</div>
<!-- /.container-fluid -->