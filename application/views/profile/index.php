<div class="container">
    <div class="row mt-3">
        <div class="col-md-10">

            <h4 class="mb-4 text-dark"><?= $title  ?></h4>
            <div class="card">
                <?= $this->session->flashdata('message'); ?>
                <div class="card-body">
                    <center>
                        <?php
                        // var_dump($this->session->userdata('image') . $user->image);
                        // die;
                        ?>
                        <?php if (!$user->image) : ?>
                        <img src="https://ui-avatars.com/api/?size=128&name=<?= $user->fullname ?>"
                            class="img-thumbnail mb-3 rounded-circle" />
                        <?php elseif(empty($user->password)) : ?>
                        <img src="<?= $this->session->userdata('image') . $user->image ?>" width="128"
                            class="img-thumbnail mb-3 rounded-circle" />
                        <?php else : ?>
                        <img src="<?= base_url('assets/img/profile/') . $user->image ?>"
                            class="img-thumbnail mb-3 rounded-circle kagami">
                        <?php endif; ?>
                        <table>
                            <tr>
                                <td width="80px" class="pb-3">Fullname</td>
                                <td width="20px" class="pb-3">:</td>
                                <td width="200px" class="pb-3"><?= $user->fullname;  ?></td>
                            </tr>
                            <tr>
                                <td width="80px" class="pb-3">Username</td>
                                <td width="20px" class="pb-3">:</td>
                                <td width="200px" class="pb-3"><?= $user->username;  ?></td>
                            </tr>
                            <tr>
                                <td width="150px" class="pb-3">Bergabung pada</td>
                                <td width="20px" class="pb-3">:</td>
                                <td width="200px" class="pb-3">
                                    <?= date('d-M-Y', strtotime($user->created_at)) ?>
                                </td>
                            </tr>
                        </table>
                        <?php if($this->session->userdata('id_role') != 3) : ?>
                        <a href="<?= base_url('user/edit_Profile') ?>" class="btn btn-primary mt-3">Edit
                            Profile</a>
                        <?php endif; ?>
                        <!-- <a href="<?= base_url('profile/editPassword/' . $user->id_user) ?>" class="btn btn-info btn-sm mt-3 ml-2">Change Password</a> -->
                    </center>
                </div>
            </div>

        </div>
    </div>
</div>