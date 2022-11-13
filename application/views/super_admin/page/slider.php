<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?php echo $title ?></h1>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <?= $this->session->flashdata('message'); ?>
            <div class="card-body">
                <a class="btn btn-sm btn-primary mb-3" href="<?= base_url('super_admin/addSlider"'); ?>">
                    <i class=" fas fa-plus mr-2"></i>Add Image
                </a>

                <div class="table-responsive">
                    <table class="table table-striped table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr class="text-center">
                                <th>No</th>
                                <th>Nama</th>
                                <th>Gambar</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1;
							foreach ($page as $p) : ?>
                            <tr class="text-center">
                                <td><?= $no++ ?></td>
                                <td><?= $p['nama']; ?></td>
                                <td><img src="<?= base_url('assets/img/') . $p['image'] ?>" class="img-thumbnail yagami"
                                        alt="..."></td>
                                <td>
                                    <a href="<?= base_url('super_admin/editSlider/') . $p['id'] ?>"
                                        class="btn btn-sm btn-info">Edit
                                        <i class='bx bxs-info-square bx-burst-hover'></i>
                                    </a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->