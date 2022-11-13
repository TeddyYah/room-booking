<!-- Begin Page Content -->
<div class="container">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?= $title ?></h1>
    </div>

    <div class="card col-md-10" style="margin-bottom: 100px">
        <div class="card-body">
            <form action="<?= base_url('super_admin/addUser') ?>" method="post">
                <div class="form-group">
                    <label>Fullname</label>
                    <input type="text" name="fullname" class="form-control"
                        value="<?= set_value('fullname') ?>"></input>
                    <div class="form-text text-danger"><?= form_error('fullname');  ?></div>
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email_pj" class="form-control"
                        value="<?= set_value('email_pj') ?>"></input>
                    <div class="form-text text-danger"><?= form_error('email_pj');  ?></div>
                </div>
                <div class="form-group">
                    <label>Username</label>
                    <input type="text" name="username" class="form-control"
                        value="<?= set_value('username') ?>"></input>
                    <div class="form-text text-danger"><?= form_error('username');  ?></div>
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password" class="form-control form-password"
                        value="<?= set_value('password') ?>"></input>
                    <input type="checkbox" class="form-checkbox mt-2 ml-2"> Show password </br>
                    <div class="form-text text-danger"><?= form_error('password');  ?></div>
                </div>
                <div class="form-group">
                    <label>Repeat Password</label>
                    <input type="password" name="repeat_password" class="form-control form-password"
                        value="<?= set_value('repeat_password') ?>"></input>
                    <input type="checkbox" class="form-checkbox mt-2 ml-2"> Show password </br>
                    <div class="form-text text-danger"><?= form_error('repeat_password');  ?></div>
                </div>
                <div class="form-group">
                    <label>Role</label>
                    <select name="role" class="form-control" id="role">
                        <option value="">-- Pilih Role --</option>
                        <option value="1" <?= set_select('id_role', 1) ?>>Super Admin</option>
                        <option value="2" <?= set_select('id_role', 2) ?>>Admin</option>
                        <option value="3" <?= set_select('id_role', 3) ?>>User</option>
                        <option value="4" <?= set_select('id_role', 4) ?>>Client</option>
                    </select>
                    <div class="form-text text-danger"><?= form_error('role');  ?></div>
                </div>

                <!-- <div class="form-group">
                    <label>Role</label>
                    <  name="status_user" id="status_user" class="form-control ">
                        <option value="">-- Pilih Status --</option>
                        <option value="Admin">Admin</option>
                        <option value="Mahasiswa">Mahasiswa</option>
                        <option value="Dosen">Dosen</option>
                    </>
                    <?= form_error('status_user', '<small class="text-danger">', '</small>') ?>
                </div> -->
                <button type="submit" name="tambah" class="btn btn-success"> Submit</button>
                <a href="<?= base_url('super_admin'); ?>" class="btn btn-primary ml-2">Kembali</a>
            </form>
        </div>
    </div>

</div>

<script type="text/javascript">
// tampilkan password
$(document).ready(function() {
    $('.form-checkbox').click(function() {
        if ($(this).is(':checked')) {
            $('.form-password').attr('type', 'text');
        } else {
            $('.form-password').attr('type', 'password');
        }
    });
});
</script>
<!-- /.container-fluid -->