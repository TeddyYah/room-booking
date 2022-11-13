<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?= $title ?></title>

    <!-- Custom fonts for this template-->
    <link href="<?= base_url('assets/') ?>vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="<?= base_url('assets/') ?>css/sb-admin-2.min.css" rel="stylesheet">

    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="<?= base_url('assets/img/image.png') ?>">

    <style>
    .login {
        margin-top: 100px !important;
    }
    </style>

</head>

<body class="bg-gradient-primary">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-7 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5 login">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-10 m-auto pb-5">
                                <div class="p-4">
                                    <div class="text-center">
                                        <!-- <img src="<?= base_url('assets/img/image.png') ?>" alt="Room-Booking"
                                            class="img-fluid"> -->
                                        <h2 class="h4 text-gray-900 mb-4 mt-4">Room-Booking</h2>
                                    </div>
                                    <?= $this->session->flashdata('message'); ?>
                                    <?= $this->session->flashdata('email_sent'); ?>
                                    <form class="user" method="post" action="<?= base_url('auth')?>">
                                        <div class="form-group">
                                            <input type="text" name="username" class="form-control form-control-user"
                                                placeholder="Enter Username" value="">
                                            <?= form_error('username', '<small class="text-danger">', '</small>') ?>
                                        </div>
                                        <div class="form-group">
                                            <input type="password" name="password"
                                                class="form-control form-control-user form-password"
                                                placeholder="Input password">

                                            <input type="checkbox" class="form-checkbox mt-2 ml-2"> Show password </br>
                                            <?= form_error('password', '<small class="text-danger ml-2">', '</small>') ?>
                                        </div>
                                        <button type="submit" class="btn btn-block btn-primary">Login</button>
                                        <a href="<?= $url_login ?>" class="btn btn-block btn-danger"><i
                                                class="fab fa-google-plus-g"></i> Login with Google</a>
                                    </form>
                                    <hr>
                                    <div class="text-center">
                                        <a class="small" href="<?= base_url('auth/forgotpassword'); ?>">Forgot
                                            Password?</a>
                                    </div>
                                    <div class="text-center">
                                        <p class="small">
                                            Dont have an account?
                                            <a href="<?= base_url('auth/register') ?>">Create an Account</a>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="<?= base_url('assets/') ?>vendor/jquery/jquery.min.js"></script>
    <script src="<?= base_url('assets/') ?>vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="<?= base_url('assets/') ?>vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="<?= base_url('assets/') ?>js/sb-admin-2.min.js"></script>


    <!-- sweetalert -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    <?php if ($this->session->flashdata('register-success')) : ?>
    <script>
    swal.fire({
        icon: "success",
        title: "Berhasil!",
        text: "Register success!",
        showConfirmButton: false,
        timer: 1700
    })
    </script>
    <?php endif; ?>

    <?php if ($this->session->flashdata('login-failed-1')) : ?>
    <script>
    swal.fire({
        icon: "error",
        title: "Gagal!",
        text: "Login gagal, password salah!",
        showConfirmButton: false,
        timer: 1500
    })
    </script>
    <?php endif; ?>

    <?php if ($this->session->flashdata('login-failed-2')) : ?>
    <script>
    swal.fire({
        icon: "error",
        title: "Gagal!",
        text: "Username atau password salah!",
        showConfirmButton: false,
        timer: 1500
    })
    </script>
    <?php endif; ?>

    <?php if ($this->session->flashdata('login-failed-3')) : ?>
    <script>
    swal.fire({
        icon: "error",
        title: "Gagal!",
        text: "Anda belum memasukan username dan password!",
        showConfirmButton: true
    })
    </script>
    <?php endif; ?>

    <?php if ($this->session->flashdata('logout-success')) : ?>
    <script>
    swal.fire({
        icon: "success",
        title: "Berhasil!",
        text: "Anda berhasil logout!",
        showConfirmButton: false,
        timer: 1500
    })
    </script>
    <?php endif; ?>

    <script type="text/javascript">
    // tampilkan password
    $(document).ready(function() {
        $('.form-checkbox').click(function() {
            if ($(this).is(':checked')) {
                $('.form-password').attr('type', 'text');
            } else {
                $('.form-password').attr('type', 'password');
            }
        });
    });
    </script>


</body>

</html>