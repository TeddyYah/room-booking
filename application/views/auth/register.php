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
    <style>
    .register {
        margin-top: 100px !important;
    }
    </style>

    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="<?= base_url('assets/img/image.png') ?>">

</head>

<body class="bg-gradient-primary">

    <div class="container">

        <div class="card o-hidden border-0 col-lg-8 m-auto shadow-lg my-5 register">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg-10 m-auto">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Register Account</h1>
                            </div>
                            <form class="user" method="post" action="<?= base_url('auth/register') ?>">
                                <div class="form-group">
                                    <input type="text" name="fullname" class="form-control form-control-user"
                                        placeholder="Fullname" value="<?= set_value('fullname') ?>">
                                    <?= form_error('fullname', '<small class="text-danger pl-3">', '</small>') ?>
                                </div>
                                <div class="form-group">
                                    <input type="email" name="email_pj" class="form-control form-control-user"
                                        placeholder="Email" value="<?= set_value('email_pj') ?>">
                                    <?= form_error('email_pj', '<small class="text-danger pl-3">', '</small>') ?>
                                </div>
                                <div class="form-group">
                                    <input type="text" name="username" class="form-control form-control-user"
                                        placeholder="Usename" value="<?= set_value('username') ?>">
                                    <?= form_error('username', '<small class="text-danger pl-3">', '</small>') ?>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0 input-group">
                                        <input id="pass" type="password" name="password"
                                            class="form-control form-control-user" placeholder="Password"
                                            value="<?= set_value('password') ?>">

                                        <div class="input-group-append">
                                            <span id="mybutton" class="input-group-text form-control form-control-user"
                                                onclick="show()"><i class="fas fa-eye"> </i></span>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 input-group">
                                        <input id="pass1" type="password" name="repeat_password"
                                            class="form-control form-control-user" placeholder="Repeat Password"
                                            value="<?= set_value('repeat_password') ?>">

                                        <div class="input-group-append">
                                            <span id="mybutton2" class="input-group-text form-control form-control-user"
                                                onclick="show2()"><i class="fas fa-eye"> </i></span>
                                        </div>
                                    </div>
                                    <?= form_error('password', '<small class="text-danger col-sm-6 mb-3 ml-3 mt-1 mb-sm-0">', '</small>') ?>
                                    <?= form_error('repeat_password', '<small class="text-danger col-sm-5 mt-1">', '</small>') ?>
                                </div>
                                <!-- <div class="form-group mt-2">
                                    <select name="status_user" id="status_user" class="form-control ">
                                        <option value="">--Pilih Status--</option>
                                        <option value="Mahasiswa">Mahasiswa</option>
                                        <option value="Dosen">Dosen</option>
                                    </select>
                                    <?= form_error('status_user', '<small class="text-danger">', '</small>') ?>
                                </div> -->
                                <button type="submit" class="btn btn-block btn-primary mt-4">Register</button>
                            </form>
                            <div class="text-center mt-4">
                                <a class="small" href="<?= base_url('auth/forgotpassword'); ?>">Forgot Password?</a>
                            </div>
                            <div class="text-center">
                                <p class="small">
                                    Already have an account?
                                    <a href="<?= base_url('auth') ?>">Login!</a>
                                </p>
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

    <script type="text/javascript">
    function show() {
        var x = document.getElementById('pass').type;

        if (x == 'password') {
            document.getElementById('pass').type = 'text';
            document.getElementById('mybutton').innerHTML = '<i class="fas fa-eye-slash"></i>';
        } else {
            document.getElementById('pass').type = 'password';
            document.getElementById('mybutton').innerHTML = '<i class="fas fa-eye"></i>';
        }
    }
    </script>

    <script type="text/javascript">
    function show2() {
        var x = document.getElementById('pass1').type;

        if (x == 'password') {
            document.getElementById('pass1').type = 'text';
            document.getElementById('mybutton2').innerHTML = '<i class="fas fa-eye-slash"></i>';
        } else {
            document.getElementById('pass1').type = 'password';
            document.getElementById('mybutton2').innerHTML = '<i class="fas fa-eye"></i>';
        }
    }
    </script>

</body>

</html>