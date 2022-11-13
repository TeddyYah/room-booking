<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?php echo $title ?></h1>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <?= $this->session->flashdata('msg') ?>
            <div class="card-body">
                <a href="<?= base_url('notif/diBacaSemua') ?>" onclick="return confirm('Tandai semua sudah dibaca?')"
                    class="btn btn-primary mb-3">Tandai sudah
                    dibaca semua</a>
                <a href="<?= base_url('notif/hapusNotif') ?>" onclick="return confirm('Yakin hapus semua notif?')"
                    class="btn btn-danger mb-3">Hapus semua notif</a>
                <div class="table-responsive">

                    <table class="table table-striped table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr class="text-center">
                                <th>No</th>
                                <th width="150px">Tanggal</th>
                                <th>Pesan</th>
                                <th width="150px">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1;
								foreach ($bell as $b) : ?>
                            <tr class="text-center">
                                <td><?= $no++ ?></td>
                                <td><?= $b['tanggal_nt']; ?></td>
                                <td><?= $b['pesan_nt'] ?></td>
                                <td>
                                    <?php if($b['is_read'] == 0): ?>
                                    <a href="<?= base_url('notif/sudahDibaca/' . $b['id_nt']) ?>"
                                        class="btn btn-sm btn-info">Tandai
                                        sudah dibaca</a>
                                    <?php else: ?>
                                    <button type="button" class="btn btn-sm btn-danger" disabled>sudah dibaca</button>
                                    <?php endif; ?>
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