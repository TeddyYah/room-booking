<!-- Begin Page Content -->
<div class="container">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?= $title ?></h1>
    </div>

    <div class="card col-md-10" style="margin-bottom: 100px">
        <div class="card-body">
            <form action="<?= base_url('super_admin/updateUser/' . $member->id_user)  ?>" method="post">
                <input type="hidden" name="id_ps" value="<?= $member->id_user ?>">
                <div class="form-group">
                    <label>Fullname</label>
                    <input type="text" name="fullname" class="form-control" value="<?= $member->fullname ?>"></input>
                    <div class="form-text text-danger"><?= form_error('fullname');  ?></div>
                </div>
                <div class="form-group">
                    <label>Role</label>
                    <select name="id_role" class="form-control" id="id_role">
                        <option value="">-- Pilih Role --</option>
                        <option value="2" <?= set_select('id_role', 2) ?>>Admin</option>
                        <option value="3" <?= set_select('id_role', 3) ?>>User</option>
                        <option value="4" <?= set_select('id_role', 4) ?>>Client</option>
                    </select>
                    <div class="form-text text-danger"><?= form_error('id_role');  ?></div>
                </div>

                <button type="submit" class="btn btn-success"> Submit</button>
                <a href="<?= base_url('super_admin'); ?>" class="btn btn-primary ml-2">Kembali</a>
            </form>

        </div>
    </div>

</div>
<!-- /.container-fluid -->