<div class="container">
    <div class="row mt-3">
        <div class="col-md-10">

            <h4 class="mb-4 text-dark"><?= $title  ?></h4>
            <div class="card">
                <div class="card-body">
                    <center>
                        <?php if (!$member->image) : ?>
                        <img src="https://ui-avatars.com/api/?size=128&name=<?= $member->fullname ?>"
                            class="img-thumbnail mb-3 rounded-circle" />
                        <?php elseif(empty($member->password)) : ?>
                        <img src="<?= $this->session->userdata('image') . $member->image ?>" width="128"
                            class="img-thumbnail mb-3 rounded-circle" />
                        <?php else : ?>
                        <img src="<?= base_url('assets/img/profile/') . $member->image ?>"
                            class="img-thumbnail mb-3 rounded-circle kagami">
                        <?php endif; ?>
                        <table>
                            <tr>
                                <td width="80px" class="pb-3">Fullname</td>
                                <td width="20px" class="pb-3">:</td>
                                <td width="200px" class="pb-3"><?= $member->fullname;  ?></td>
                            </tr>
                            <tr>
                                <td width="80px" class="pb-3">Username</td>
                                <td width="20px" class="pb-3">:</td>
                                <td width="200px" class="pb-3"><?= $member->username;  ?></td>
                            </tr>
                            <tr>
                                <td width="80px" class="pb-3">Role</td>
                                <td width="20px" class="pb-3">:</td>
                                <td width="200px" class="pb-3">
                                    <?php if ($member->id_role == 1) : ?>
                                    <?= 'Super Admin' ?>
                                    <?php elseif ($member->id_role == 2) : ?>
                                    <?= 'Admin' ?>
                                    <?php elseif ($member->id_role == 3) : ?>
                                    <?= 'User' ?>
                                    <?php elseif ($member->id_role == 4) : ?>
                                    <?= 'Client' ?>
                                    <?php endif; ?>
                                </td>
                            </tr>
                            <tr>
                                <!-- <td width="80px" class="pb-3">Status</td>
                                <td width="20px" class="pb-3">:</td>
                                <td width="200px" class="pb-3"><?= $member->status_user;  ?></td>
                            </tr> -->
                            <tr>
                                <td width="80px" class="pb-3">Created at</td>
                                <td width="20px" class="pb-3">:</td>
                                <td width="200px" class="pb-3">
                                    <?= date('d-M-Y', strtotime($member->created_at)) ?>
                                </td>
                            </tr>
                        </table>

                        <a href="<?= base_url('super_admin'); ?>" class="btn btn-primary">Kembali</a>
                    </center>
                </div>
            </div>

        </div>
    </div>
</div>