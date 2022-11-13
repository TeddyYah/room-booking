<!-- Begin Page Content -->
<div class="container">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?php echo $title ?></h1>
    </div>

    <div class="card col-md-6" style="margin-bottom: 100px">
        <div class="card-body">
            <form action="<?= base_url('menu/updateSubMenu/' . $menu->id_sub_menu)  ?>" method="post">
                <input type="hidden" name="id__sub_menu" value="<?= $menu->id_sub_menu ?>">
                <div class="form-group">
                    <label>Title</label>
                    <input type="text" class="form-control" id="title" name="title" value="<?= $menu->title ?>">
                    <div class="form-text text-danger"><?= form_error('title');  ?></div>
                </div>
                <div class="form-group">
                    <label>Menu</label>
                    <select name="id_menu" id="id_menu" class="form-control">
                        <option value="<?=  $menu->id_menu ?>"><?=  $menu->id_menu ?></option>
                        <?php foreach ($edit as $e) : ?>
                        <option value="<?= $e['id_menu']; ?>"><?= $e['menu']; ?></option>
                        <?php endforeach; ?>
                    </select>
                    <div class="form-text text-danger"><?= form_error('id_menu');  ?></div>
                </div>
                <div class="form-group">
                    <label>URL</label>
                    <input type="text" class="form-control" id="url" name="url" value="<?= $menu->url ?>">
                    <div class="form-text text-danger"><?= form_error('url');  ?></div>
                </div>
                <div class="form-group">
                    <label>Icon</label>
                    <input type="text" class="form-control" id="icon" name="icon" value="<?= $menu->icon ?>">
                    <div class="form-text text-danger"><?= form_error('icon');  ?></div>
                </div>
                <div class="form-group">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="1" name="is_active" id="is_active"
                            checked>
                        <label class="form-check-label" for="is_active">
                            Active?
                        </label>
                    </div>
                </div>
                <button type="submit" name="edit" class="btn btn-success">Edit</button>
                <a href="<?= base_url('menu/submenu'); ?>" class="btn btn-primary ml-2">Kembali</a>
            </form>

        </div>
    </div>

</div>
<!-- /.container-fluid -->