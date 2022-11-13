<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?= $title ?></h1>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="card-body">

                <div class="card-group">
                    <div class="col-md-4 mb-4">
                        <div class="card text-center">
                            <div class="card-header bg-primary text-white">
                                RANK 2
                            </div>
                            <?php foreach ($rank2 as $r2): ?>
                            <div class="card-body bg-danger text-white">
                                <?php if (!$r2->image) : ?>
                                <img src="https://ui-avatars.com/api/?size=128"
                                    class="img-thumbnail mb-3 rounded-circle" width="64px">
                                <?php elseif(empty($r2->password)) : ?>
                                <img src="<?= $this->session->userdata('image') . $r2->image ?>"
                                    class="img-thumbnail mb-3 rounded-circle" width="64px">
                                <?php else : ?>
                                <img src="<?= base_url('assets/img/profile/') . $r2->image ?>"
                                    class="img-thumbnail mb-3 rounded-circle" width="64px">
                                <?php endif; ?>
                                <h5 class="card-title"><?= $r2->fullname;  ?></h5>
                            </div>
                            <div class="card-footer bg-primary text-white">
                                <?= $r2->jumlah_booking . " Take Video"; ?>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <div class="col-md-4 mb-4">
                        <div class="card text-center">
                            <div class="card-header bg-primary text-white">
                                RANK 1
                            </div>
                            <?php foreach ($rank1 as $r1): ?>
                            <div class="card-body bg-warning text-dark">
                                <?php if (!$r1->image) : ?>
                                <img src="https://ui-avatars.com/api/?size=128"
                                    class="img-thumbnail mb-3 rounded-circle" width="64px">
                                <?php elseif(empty($r1->password)) : ?>
                                <img src="<?= $this->session->userdata('image') . $r1->image ?>"
                                    class="img-thumbnail mb-3 rounded-circle" width="64px">
                                <?php else : ?>
                                <img src="<?= base_url('assets/img/profile/') . $r1->image ?>"
                                    class="img-thumbnail mb-3 rounded-circle" width="64px">
                                <?php endif; ?>
                                <h5 class="card-title"><?= $r1->fullname ; ?></h5>
                            </div>
                            <div class="card-footer bg-primary text-white">
                                <?= $r1->jumlah_booking . " Take Video"; ?>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <div class="col-md-4 mb-4">
                        <div class="card text-center">
                            <div class="card-header bg-primary text-white">
                                RANK 3
                            </div>
                            <?php foreach ($rank3 as $r3): ?>
                            <div class="card-body bg-dark text-white">
                                <?php if (!$r3->image) : ?>
                                <img src="https://ui-avatars.com/api/?size=128"
                                    class="img-thumbnail mb-3 rounded-circle" width="64px">
                                <?php elseif(empty($r3->password)) : ?>
                                <img src="<?= $this->session->userdata('image') . $r3->image ?>"
                                    class="img-thumbnail mb-3 rounded-circle" width="64px">
                                <?php else : ?>
                                <img src="<?= base_url('assets/img/profile/') . $r3->image ?>"
                                    class="img-thumbnail mb-3 rounded-circle" width="64px">
                                <?php endif; ?>
                                <h5 class="card-title"><?= $r3->fullname ; ?></h5>
                            </div>
                            <div class="card-footer bg-primary text-white">
                                <?= $r3->jumlah_booking . " Take Video"; ?>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th class="text-center">Rank</th>
                                <!-- <th>id</th> -->
                                <th>Nama</th>
                                <th>Reservasi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            // var_dump($ranked); die; 
                            $no = 4; 
							foreach ($rank as $p) : ?>
                            <tr>
                                <td class="text-center"><?= $no++ ?></td>
                                <!-- <td><?= $p->id_user; ?></td> -->
                                <?php if (!$p->image) : ?>
                                <td><img src="https://ui-avatars.com/api/?size=128" class="rounded-circle mr-2"
                                        width="32px"> <?= $p->fullname ?></td>
                                <?php elseif(empty($p->password)) : ?>
                                <td><img src="<?= $this->session->userdata('image') . $p->image ?>"
                                        class="rounded-circle mr-2" width="32px"> <?= $p->fullname; ?></td>
                                <?php else : ?>
                                <td><img src="<?= base_url('assets/img/profile/') . $p->image ?>"
                                        class="rounded-circle mr-2" width="32px"> <?= $p->fullname; ?></td>
                                <?php endif; ?>

                                <!-- <td><img src="<?= base_url('assets/img/profile/') . $p->image ?>"
                                class="rounded-circle" width="32px"> <?= $p->fullname; ?></td> -->
                                <td>
                                    <?= $p->jumlah_booking . " Take Video"; ?>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->