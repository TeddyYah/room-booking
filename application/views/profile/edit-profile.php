<!-- Begin Page Content -->
<div class="container">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?= $title ?></h1>
    </div>

    <div class="card col-md-10" style="margin-bottom: 100px">
        <div class="card-body">
            <form action="<?= base_url('profile/updateProfile/' . $member->id_user)  ?>" method="post">
                <input type="hidden" name="id_user" value="<?= $member->id_user ?>">
                <div class="form-group">
                    <label>Username</label>
                    <input type="text" name="username" class="form-control" value="<?= $member->username ?>" readonly></input>
                    <div class="form-text text-danger"><?= form_error('username');  ?></div>
                </div>
                <div class="form-group">
                    <label>Fullname</label>
                    <input type="text" name="fullname" class="form-control" value="<?= $member->fullname ?>"></input>
                    <div class="form-text text-danger"><?= form_error('fullname');  ?></div>
                </div>
                <button type="submit" class="btn btn-success">Edit</button>
                <a href="<?= base_url('profile'); ?>" class="btn btn-primary ml-2">Kembali</a>
            </form>

        </div>
    </div>

</div>
<!-- /.container-fluid -->