<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <?php if ($user->id_role == 1) : ?>
            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center"
                href="<?= base_url('super_admin') ?>">
                <div class="sidebar-brand-icon">
                    <i class="fas fa-building"></i>
                </div>
                <div class="sidebar-brand-text mx-3">Booking Room</div>
            </a>

            <?php elseif ($user->id_role == 2) : ?>
            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= base_url('admin') ?>">
                <div class="sidebar-brand-icon">
                    <i class="fas fa-building"></i>
                </div>
                <div class="sidebar-brand-text mx-3">Booking Room</div>
            </a>

            <?php elseif ($user->id_role == 3) : ?>
            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= base_url('user') ?>">
                <div class="sidebar-brand-icon">
                    <i class="fas fa-video"></i>
                </div>
                <div class="sidebar-brand-text mx-3">Booking Room</div>
            </a>

            <?php elseif ($user->id_role == 4) : ?>
            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= base_url('client') ?>">
                <div class="sidebar-brand-icon">
                    <i class="fas fa-video"></i>
                </div>
                <div class="sidebar-brand-text mx-3">Booking Room</div>
            </a>
            <?php endif; ?>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- QUERY MENU -->
            <?php 
            $role_id = $this->session->userdata('id_role');
            // var_dump($role_id);
            // die;
            $queryMenu = "SELECT `user_menu`.`id_menu`, `menu`
                            FROM `user_menu` JOIN `user_access_menu`
                              ON `user_menu`.`id_menu` = `user_access_menu`.`id_menu`
                           WHERE `user_access_menu`.`id_role` = $role_id
                        ORDER BY `user_access_menu`.`id_menu` ASC
                        ";
            $menu = $this->db->query($queryMenu)->result_array();

            // var_dump($menu);
            // die;
            ?>

            <!-- LOOPING MENU -->
            <?php foreach ($menu as $m) : ?>
            <div class="sidebar-heading">
                <?= $m['menu']; ?>
            </div>

            <!-- SIAPKAN SUB-MENU SESUAI MENU -->
            <?php 
            $menuId = $m['id_menu'];
            $querySubMenu = "SELECT *
                               FROM `user_sub_menu` JOIN `user_menu` 
                                 ON `user_sub_menu`.`id_menu` = `user_menu`.`id_menu`
                              WHERE `user_sub_menu`.`id_menu` = $menuId
                                AND `user_sub_menu`.`is_active` = 1
                                ORDER BY `user_sub_menu`.`id_sub_menu` ASC
                        ";
            $subMenu = $this->db->query($querySubMenu)->result_array();
            ?>

            <?php foreach ($subMenu as $sm) : ?>
            <?php if ($title == $sm['title']) : ?>
            <li class="nav-item active">
                <?php else : ?>
            <li class="nav-item">
                <?php endif; ?>
                <a class="nav-link pb-0" href="<?= base_url($sm['url']); ?>">
                    <i class="<?= $sm['icon']; ?>"></i>
                    <span><?= $sm['title']; ?></span></a>
            </li>
            <?php endforeach; ?>

            <hr class="sidebar-divider mt-3">

            <?php endforeach; ?>

            <!-- Nav Item - Charts -->
            <li class="nav-item  <?= ($title == 'My Profile') ? 'active' : '' ?>">
                <a class="nav-link" href="<?= base_url('profile') ?>">
                    <i class="fas fa-fw fa-user"></i>
                    <span>My Profile</span></a>
            </li>

            <!-- Nav Item - Tables -->
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url('auth/logout') ?>">
                    <i class="fas fa-fw fa-sign-out-alt"></i>
                    <span>Logout</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->



        <!-- Start of Topbar -->
        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Search -->

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <?php
                        $notif_count = $this->Notif_model->getAllNewNotif();
                        // $notif1 = $this->db->get_where('data_pemesanan', ['is_read' => 0])->result_array();
                        $notif = $this->Notif_model->getNotifBaru();
                        // $notif_count = count($notif1);
                        // var_dump( $notif);
                        // die;
                        ?>
                        <!-- Nav Item - Alerts -->

                        <li class="nav-item dropdown no-arrow mx-1">

                            <?php if($user->id_role <= 2): ?>
                            <a class="nav-link dropdown-toggle" id="alertsDropdown" role="button" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-bell fa-fw"></i>
                                <!-- jika pengen pakai jQuery id="notif_count"-->
                                <?php if($notif_count == 0): ?>
                                <span class="badge badge-danger badge-counter"></span>
                                <?php else: ?>
                                <span class="badge badge-danger badge-counter"><?= $notif_count ?></span>
                                <?php endif; ?>
                            </a>
                            <!-- Dropdown - Alerts -->
                            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="alertsDropdown">
                                <h6 class="dropdown-header">
                                    Notifikasi
                                </h6>
                                <h6 class="dropdown-header">
                                    <a href="<?= base_url('admin/notifAllReads') ?>"
                                        onclick="return confirm('Tandai semua sudah dibaca?')"
                                        class="text-white ml-auto">Tandai sudah dibaca
                                        semua</a>
                                </h6>
                                <?php foreach($notif as $nt)  : ?>
                                <?php if($nt['is_read'] == 0): ?>
                                <a class="dropdown-item d-flex align-items-center"
                                    href="<?= base_url('admin/DetailBooking/') . $nt['id_ps'] ?>">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-primary">
                                            <i class="fas fa-file-alt text-white"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="small text-bold-500"><?= $nt['date_created'] ?></div>
                                        <span class="font-weight-bold">
                                            <?= 
                                            $nt['nama_pj'] . ': ' . $nt['status_bo_pj'] . ' Room pada ' . 
                                            longdate_indo(date('Y-m-d', strtotime($nt['tanggal_pj']))) . 
                                            ". " . date('H:i', strtotime($nt['dari_pj'])) . ' s/d ' . 
                                            date('H:i', strtotime($nt['sampai_pj'])) . '.'
                                            ?>
                                        </span>
                                    </div>
                                </a>
                                <?php elseif($nt['is_read'] == 1): ?>
                                <a class="dropdown-item d-flex align-items-center"
                                    href="<?= base_url('admin/DetailBooking/') . $nt['id_ps'] ?>">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-primary">
                                            <i class="fas fa-file-alt text-white"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="small text-gray-500"><?= $nt['date_created'] ?></div>
                                        <span class="font-weight-gray">
                                            <?= 
                                            $nt['nama_pj'] . ': ' . $nt['status_bo_pj'] . ' Room pada '  . 
                                            longdate_indo(date('Y-m-d', strtotime($nt['tanggal_pj']))) . 
                                            ". " . date('H:i', strtotime($nt['dari_pj'])) . ' s/d ' . 
                                            date('H:i', strtotime($nt['sampai_pj'])) . '.'
                                            ?>
                                        </span>
                                    </div>
                                </a>
                                <?php endif; ?>
                                <?php endforeach; ?>
                                <a class="dropdown-item text-center small text-gray-500"
                                    href="<?= base_url('admin/waitingBooking') ?>">Show All
                                    Alerts</a>
                            </div>

                            <?php endif; ?>



                        </li>

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?= $user->fullname ?></span>

                                <?php if (!$user->image) : ?>
                                <img src="https://ui-avatars.com/api/?size=128&name=<?= $user->fullname ?>"
                                    class="img-profile rounded-circle" alt="yeh" />
                                <?php elseif(empty($user->password) ) : ?>
                                <img src="<?= $this->session->userdata('image') . $user->image ?>"
                                    class="img-profile rounded-circle" alt="yeh" />
                                <?php else : ?>
                                <img src="<?= base_url('assets/img/profile/') . $user->image ?>"
                                    class="img-profile rounded-circle" alt="yeh">
                                <?php endif; ?>
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="<?= base_url('profile') ?>">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="<?= base_url('auth/logout') ?>" data-toggle="modal"
                                    data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>
                    </ul>
                </nav>
                <!-- End of Topbar -->