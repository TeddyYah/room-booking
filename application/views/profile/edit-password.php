<!-- Begin Page Content -->
<div class="container">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?= $title ?></h1>
    </div>

    <div class="card col-md-10" style="margin-bottom: 100px">
        <div class="card-body">
            <form action="<?= base_url('profile/updatePassword/' . $member->id_user)  ?>" method="post">
                <input type="hidden" name="id_user" value="<?= $member->id_user ?>">
                <div class="form-group">
                    <label>Old Password</label>
                    <input type="password" name="username" class="form-control" value="<?= set_value('old_password') ?>"></input>
                    <div class="form-text text-danger"><?= form_error('old_password'); ?></div>
                </div>
                <div class="form-group">
                    <label>New Password</label>
                    <input type="password" name="new_password" class="form-control" value="<?= set_value('new_password') ?>"></input>
                    <div class="form-text text-danger"><?= form_error('new_password');  ?></div>
                </div>
                <div class="form-group">
                    <label>Repeat New Password</label>
                    <input type="password" name="repeat_password" class="form-control" value="<?= set_value('repeat_password') ?>"></input>
                    <div class="form-text text-danger"><?= form_error('repeat_password');  ?></div>
                </div>
                <button type="submit" class="btn btn-success">Change Password</button>
                <a href="<?= base_url('profile'); ?>" class="btn btn-primary ml-2">Kembali</a>
            </form>

        </div>
    </div>

</div>
<!-- /.container-fluid -->