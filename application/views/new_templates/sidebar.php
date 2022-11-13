<body class="bg-theme bg-theme1">

    <!-- Start wrapper-->
    <div id="wrapper">

        <!--Start sidebar-wrapper-->
        <div id="sidebar-wrapper" data-simplebar="" data-simplebar-auto-hide="true">
            <?php if ($user->id_role == 1) : ?>
            <div class="brand-logo">
                <a href="<?= base_url('admin') ?>">
                    <img src="assets/images/logo-icon.png" class="logo-icon" alt="logo icon">
                    <h5 class="logo-text">Magics Rey Studio </h5>
                </a>
            </div>
            <?php elseif ($user->id_role == 2) : ?>
            <div class="brand-logo">
                <a href="<?= base_url('client') ?>">
                    <img src="assets/images/logo-icon.png" class="logo-icon" alt="logo icon">
                    <h5 class="logo-text">Magics Rey Studio </h5>
                </a>
            </div>
            <?php endif; ?>
            <ul class="sidebar-menu do-nicescrol">
                <!-- <?php if ($user->id_role == 1) : ?>
                <li>
                    <a href="<?= base_url('admin') ?>">
                        <i class="zmdi zmdi-view-dashboard"></i> <span>Booking MRS</span>
                    </a>
                </li>
                <?php elseif ($user->id_role == 2) : ?>
                <li>
                    <a href="<?= base_url('client') ?>">
                        <i class="zmdi zmdi-invert-colors"></i> <span>Magics Rey Studio</span>
                    </a>
                </li>
                <?php endif; ?> -->

                <?php if ($user->id_role == 1) : ?>
                <li class="nav-item <?= ($title == 'Dashboard') ? 'active' : '' ?>">
                    <a class="nav-link" href="<?= base_url('admin') ?>">
                        <i class="zmdi zmdi-format-list-bulleted"></i> <span>Dashboard</span>
                    </a>
                </li>

                <li class="nav-item 
                <?= ($title == 'User Account') ? 'active' : '' ?>
                <?= ($title == 'Add User') ? 'active' : '' ?>
                <?= ($title == 'Edit User') ? 'active' : '' ?>
                <?= ($title == 'Detail User') ? 'active' : '' ?>
                ">
                    <a class="nav-link" href="<?= base_url('admin/viewUser') ?>">
                        <i class="zmdi zmdi-grid"></i> <span>Users Management</span>
                    </a>
                </li>

                <li class="sidebar-header">Data Booking</li>
                <li class="nav-item
                <?= ($title == 'Waiting List Booking') ? 'active' : '' ?>
                <?= ($title == 'Data Booking Room Today') ? 'active' : '' ?>
                <?= ($title == 'All Data Booking') ? 'active' : '' ?>
                <?= ($title == 'Detail Booking') ? 'active' : '' ?>
                ">
                <li>
                    <a href="<?= base_url('admin/viewWaitingList') ?>">
                        <i class="zmdi zmdi-calendar-check"></i> <span> Waiting List Booking</span>
                    </a>
                </li>

                <li>
                    <a href="<?= base_url('admin/viewBookingToday') ?>">
                        <i class="zmdi zmdi-face"></i> <span> Today Data Booking</span>
                    </a>
                </li>

                <li>
                    <a href="<?= base_url('admin/viewAllBooking') ?>">
                        <i class="zmdi zmdi-lock"></i> <span>All Data Booking</span>
                    </a>
                </li>
                </li>

                <?php elseif ($user->id_role == 2) : ?>
                <li class="nav-item <?= ($title == 'Home') ? 'active' : '' ?>">
                    <a cclass="nav-link" href="<?= base_url('client') ?>">
                        <i class="zmdi zmdi-format-list-bulleted"></i> <span>Home</span>
                    </a>
                </li>

                <li class="nav-item <?= ($title == 'Jadwal Booking Today') ? 'active' : '' ?>">
                    <a class="nav-link" href="<?= base_url('client/viewBooking') ?>">
                        <i class="zmdi zmdi-format-list-bulleted"></i> <span>Jadwal Booking</span>
                    </a>
                </li>

                <li class="nav-item
                <?= ($title == 'My History Booking') ? 'active' : '' ?>
                <?= ($title == 'Detail Booking') ? 'active' : '' ?>
                <?= ($title == 'Edit Booking') ? 'active' : '' ?>
                ">
                    <a class="nav-link" href="<?= base_url('client/historyBooking') ?>">
                        <i class="zmdi zmdi-grid"></i> <span>History Booking</span>
                    </a>
                </li>

                <?php endif; ?>

                <li class="nav-item  <?= ($title == 'My Profile') ? 'active' : '' ?>">
                    <a class="nav-link" href="<?= base_url('profile') ?>">
                        <i class="fas fa-fw fa-user"></i>
                        <span>My Profile</span></a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url('auth/logout') ?>">
                        <i class="fas fa-fw fa-sign-out-alt"></i>
                        <span>Logout</span></a>
                </li>
            </ul>

        </div>
        <!--End sidebar-wrapper-->

        <!--Start topbar header-->
        <header class="topbar-nav">
            <nav class="navbar navbar-expand fixed-top">
                <ul class="navbar-nav mr-auto align-items-center">
                    <li class="nav-item">
                        <a class="nav-link toggle-menu" href="javascript:void();">
                            <i class="icon-menu menu-icon"></i>
                        </a>
                    </li>
                </ul>

                <ul class="navbar-nav align-items-center right-nav-link">
                    <li class="nav-item">
                        <a class="nav-link dropdown-toggle dropdown-toggle-nocaret" data-toggle="dropdown" href="#">
                            <span class="user-profile"><img src="https://via.placeholder.com/110x110" class="img-circle"
                                    alt="user avatar"></span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-right">
                            <li class="dropdown-item user-details">
                                <a href="javaScript:void();">
                                    <div class="media">
                                        <div class="avatar"><img class="img-profile rounded-circle"
                                                src="https:/ui-avatars.com/api/?name=<?= $user->fullname ?>"
                                                alt="user avatar"></div>
                                        <div class="media-body">
                                            <h6 class="mt-2 user-title"><?= $user->fullname ?></h6>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li class="dropdown-divider"></li>
                            <li class="dropdown-item"><i class="icon-envelope mr-2"></i> Profile</li>
                            <li class="dropdown-divider"></li>
                            <li class="dropdown-item"><i class="icon-power mr-2"></i><a
                                    href="<?= base_url('auth/logout') ?>"></a> Logout</li>
                        </ul>
                    </li>
                </ul>
            </nav>
        </header>
        <!--End topbar header-->