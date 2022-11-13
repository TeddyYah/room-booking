<!-- Begin Page Content -->
<div class="container">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?php echo $title ?></h1>
    </div>

    <div class="card col-md-6" style="margin-bottom: 100px">
        <div class="card-body">
            <form action="<?= base_url('super_admin/updateRole/' . $role->id_role)  ?>" method="post">
                <input type="hidden" name="id_role" value="<?= $role->id_role ?>">
                <div class="form-group">
                    <label>Role</label>
                    <input type="text" name="nama_role" class="form-control" value="<?=$role->nama_role ?>"></input>
                    <div class="form-text text-danger"><?= form_error('nama_role');  ?></div>
                </div>
                <button type="submit" name="edit" class="btn btn-success">Edit</button>
                <a href="<?= base_url('super_admin/role/'); ?>" class="btn btn-primary ml-2">Kembali</a>
            </form>

        </div>
    </div>

</div>
<!-- /.container-fluid -->