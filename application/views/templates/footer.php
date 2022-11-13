<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>

<!-- Footer -->
<footer class="sticky-footer bg-white">
    <div class="container my-auto">
        <div class="copyright text-center my-auto">
            <span>Copyright &copy; Everything doing with ❤️ <?= date('Y'); ?></span>
        </div>
    </div>
</footer>
<!-- End of Footer -->



</div>
<!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <a class="btn btn-primary" href="<?= base_url('auth/logout') ?>">Logout</a>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap core JavaScript-->
<script src="<?php echo base_url() ?>/assets/vendor/jquery/jquery.min.js"></script>
<script src="<?php echo base_url() ?>/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="<?php echo base_url() ?>/assets/vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="<?php echo base_url() ?>/assets/js/sb-admin-2.min.js"></script>

<!-- Page level plugins -->
<script src="<?php echo base_url() ?>/assets/vendor/chart.js/Chart.min.js"></script>
<script src="<?php echo base_url() ?>/assets/vendor/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url() ?>/assets/vendor/datatables/dataTables.bootstrap4.min.js"></script>

<!-- Page level custom scripts -->
<script src="<?php echo base_url() ?>/assets/js/demo/chart-area-demo.js"></script>
<script src="<?php echo base_url() ?>/assets/js/demo/chart-pie-demo.js"></script>
<script src="<?php echo base_url() ?>/assets/js/demo/datatables-demo.js"></script>

<!-- Date Time Pickers -->
<script src="<?php echo base_url() ?>/assets/js/jquery.datetimepicker.full.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
<script>
jQuery.datetimepicker.setLocale('moment');
$('#picker').datetimepicker({
    timepicker: false,
    datepicker: true,
    format: 'Y-m-d',
    weeks: true
});
$('#toggle').on('click', function() {
    $('#picker').datetimepicker('toggle')
})
</script>

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

<script type="text/javascript">
$(document).ready(function() {
    setInterval(function() {
        $.ajax({
            url: "<?=base_url()?>admin/notifikasi",
            type: "POST",
            dataType: "json", //datatype lainnya: html, text
            data: {},
            success: function(data) {
                $("#notif_count").html(data.notif_count);
            }
        });
    }, 2000);
})
</script>

<script type="text/javascript">
$(document).ready(function() {
    setInterval(function() {
        $.ajax({
            url: "<?=base_url()?>admin/notifSudahDibaca",
            type: "POST",
            dataType: "json", //datatype lainnya: html, text
            data: {},
            success: function(data) {
                $("#all_notif").html(data.all_notif);
            }
        });
    }, 2000);
})
</script>


<script>
var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
    return new bootstrap.Tooltip(tooltipTriggerEl)
})
</script>

<script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>

<?php if ($this->session->flashdata('add-success')) : ?>
<script>
swal.fire({
    icon: "success",
    title: "Success !",
    text: "Add data success !",
    showConfirmButton: false,
    timer: 1500
})
</script>
<?php endif; ?>

<?php if ($this->session->flashdata('update-success')) : ?>
<script>
swal.fire({
    icon: "success",
    title: "Success !",
    text: "Update data success !",
    showConfirmButton: false,
    timer: 1500
})
</script>
<?php endif; ?>

<?php if ($this->session->flashdata('booking-success')) : ?>
<script>
swal.fire({
    icon: "success",
    title: "Success !",
    text: "Booking ruangan success!, harap menunggu persetujuan Admin",
    showConfirmButton: true,
})
</script>
<?php endif; ?>

<?php if ($this->session->flashdata('booking-failed')) : ?>
<script>
swal.fire({
    icon: "error",
    title: "Failed !",
    text: "Waktu sudah dipilih, silahkan pilih waktu lain!",
    showConfirmButton: true,
})
</script>
<?php endif; ?>

<?php if ($this->session->flashdata('booking-failed1')) : ?>
<script>
swal.fire({
    icon: "error",
    title: "Failed !",
    text: "Waktu sudah dipilih, silahkan pilih waktu lain!",
    showConfirmButton: true,
})
</script>
<?php endif; ?>

<?php if ($this->session->flashdata('booking-failed2')) : ?>
<script>
swal.fire({
    icon: "error",
    title: "Failed !",
    text: "Jam yang anda pilih sudah lewat, harap pilih jam saat ini kedepan!",
    showConfirmButton: true,
})
</script>
<?php endif; ?>

<?php if ($this->session->flashdata('booking-failed3')) : ?>
<script>
swal.fire({
    icon: "error",
    title: "Failed !",
    text: "Jam selesai tidak boleh lebih kecil dari jam mulai!",
    showConfirmButton: true,
})
</script>
<?php endif; ?>

<?php if ($this->session->flashdata('booking-failed4')) : ?>
<script>
swal.fire({
    icon: "error",
    title: "Failed !",
    text: "Minimal booking 10 menit!",
    showConfirmButton: true,
})
</script>
<?php endif; ?>

<?php if ($this->session->flashdata('booking-failed5')) : ?>
<script>
swal.fire({
    icon: "error",
    title: "Failed !",
    text: "Maksimal booking 30 menit!",
    showConfirmButton: true,
})
</script>
<?php endif; ?>

<?php if ($this->session->flashdata('booking-failed6')) : ?>
<script>
swal.fire({
    icon: "error",
    title: "Failed !",
    text: "Jam istirahat, Pilih di jam yang lain!",
    showConfirmButton: true,
})
</script>
<?php endif; ?>

<?php if ($this->session->flashdata('booking-failed7')) : ?>
<script>
swal.fire({
    icon: "error",
    title: "Failed !",
    text: "Silahkan booking sesuai Jam operasional MRS!",
    showConfirmButton: true,
})
</script>
<?php endif; ?>

<?php if ($this->session->flashdata('booking-failed8')) : ?>
<script>
swal.fire({
    icon: "error",
    title: "Failed !",
    text: "Tanggal yang anda pilih sudah lewat, silahkan pesan ulang",
    showConfirmButton: true,
})
</script>
<?php endif; ?>

<?php if ($this->session->flashdata('booking-failed9')) : ?>
<script>
swal.fire({
    icon: "error",
    title: "Failed !",
    text: "Tanggal selesai tidak boleh lebih kecil dari Tanggal mulai!",
    showConfirmButton: true,
})
</script>
<?php endif; ?>

<?php if ($this->session->flashdata('booking-failed10')) : ?>
<script>
swal.fire({
    icon: "error",
    title: "Failed !",
    text: "Tanggal yang anda pilih sudah lewat, silahkan pesan ulang",
    showConfirmButton: true,
})
</script>
<?php endif; ?>

<?php if ($this->session->flashdata('update-booking-success')) : ?>
<script>
swal.fire({
    icon: "success",
    title: "Success !",
    text: "Update booking success !",
    showConfirmButton: false,
    timer: 1500
})
</script>
<?php endif; ?>

<script>
$('.cancel-button').on('click', function(e) {

    e.preventDefault();
    const href = $(this).attr('href');

    Swal.fire({
        title: 'Apakah anda yakin ?',
        text: "Ingin cancel reservasi ?",
        icon: 'warning',
        showCancelButton: true,
        cancelButtonText: 'No',
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes'
    }).then((result) => {
        if (result.isConfirmed) {
            document.location.href = href;
            Swal.fire({
                title: 'Canceled!',
                text: "Berhasil cancel reservasi.",
                icon: 'success',
            })
        }
    })
})
</script>

<script>
$('.delete-btn').on('click', function(e) {

    e.preventDefault();
    const href = $(this).attr('href');

    Swal.fire({
        title: 'Apakah anda yakin ?',
        text: "Ingin menghapus data ?",
        icon: 'warning',
        showCancelButton: true,
        cancelButtonText: 'No',
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes'
    }).then((result) => {
        if (result.isConfirmed) {
            document.location.href = href;
            Swal.fire({
                title: 'Success!',
                text: "Data berhasil dihapus",
                icon: 'success',
            })
        }
    })
})
</script>

<script>
$('.acc-button').on('click', function(e) {

    e.preventDefault();
    const href = $(this).attr('href');

    Swal.fire({
        title: 'Apakah anda yakin ?',
        text: "Ingin Acc Reservasi ?",
        icon: 'warning',
        showCancelButton: true,
        cancelButtonText: 'No',
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes'
    }).then((result) => {
        if (result.isConfirmed) {
            document.location.href = href;
            Swal.fire({
                title: 'Success!',
                text: "Berhasil Acc Reservasi.",
                icon: 'success',
                confirmButtonText: 'No'
            })
        }
    })
})
</script>

<script>
$('.dec-button').on('click', function(e) {

    e.preventDefault();
    const href = $(this).attr('href');

    Swal.fire({
        title: 'Apakah anda yakin ?',
        text: "Ingin cancel reservasi ?",
        icon: 'warning',
        showCancelButton: true,
        cancelButtonText: 'No',
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes'
    }).then((result) => {
        if (result.isConfirmed) {
            document.location.href = href;
            Swal.fire({
                title: 'Success!',
                text: "Berhasil cancel reservasi.",
                icon: 'success',
                confirmButtonText: 'No'
            })
        }
    })
})
</script>

<script>
$('.acc-button').on('click', function(e) {

    e.preventDefault();
    const href = $(this).attr('href');

    Swal.fire({
        title: 'Apakah anda yakin ?',
        text: "Ingin Acc Reservasi ?",
        icon: 'warning',
        showCancelButton: true,
        cancelButtonText: 'No',
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes'
    }).then((result) => {
        if (result.isConfirmed) {
            document.location.href = href;
            Swal.fire({
                title: 'Success!',
                text: "Berhasil Acc Reservasi.",
                icon: 'success',
                confirmButtonText: 'No'
            })
        }
    })
})
</script>

<script>
// JQUERY untuk checkox role
$('.custom-file-input').on('change', function() {
    let fileName = $(this).val().split('\\').pop();
    $(this).next('.custom-file-label').addClass("selected").html(fileName);
});

$('.form-check-input').on('click', function() {
    const menuId = $(this).data('menu');
    const roleId = $(this).data('role');

    $.ajax({
        url: "<?= base_url('super_admin/changeaccess'); ?>",
        type: 'post',
        data: {
            menuId: menuId,
            roleId: roleId
        },
        success: function() {
            document.location.href = "<?= base_url('super_admin/roleaccess/'); ?>" + roleId;
        }
    });

});
</script>

</body>

</html>