<?php
require 'cek-sesi.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Laporan Keuangan</title>

    <!-- Custom fonts for this template -->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <!-- Custom styles for this template -->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

</head>

<body id="page-top">

    <?php 
require 'koneksi.php';
require 'sidebar.php'; ?>

    <!-- Main Content -->
    <div id="content">

        <?php require 'navbar.php'; ?>

        <!-- Begin Page Content -->
        <div class="container-fluid">

            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Laporan Keuangan Santri</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Nama</th>
                                    <th>Jumlah Transaksi Keluar</th>
                                    <th>Jumlah Transaksi Masuk</th>
                                    <th>Jumlah Sisa uang</th>
                                    <th>Download</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>Nama</th>
                                    <th>Jumlah Transaksi Keluar</th>
                                    <th>Jumlah Transaksi Masuk</th>
                                    <th>Jumlah Sisa uang</th>
                                    <th>Download</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                <?php 
                                 $query = mysqli_query($koneksi, "SELECT santri.nama, SUM(pengeluaran.jumlah) AS jumlah_keluar, SUM(pemasukan.jumlah) AS jumlah_masuk, santri.saldo FROM santri LEFT JOIN pengeluaran ON santri.id_santri = pengeluaran.id_santri LEFT JOIN pemasukan ON santri.id_santri = pemasukan.id_santri GROUP BY santri.nama");
                                 while ($data = mysqli_fetch_assoc($query)) {
                                    
                                    $nama = $data['nama'];
                                    $jumlah_keluar = $data['jumlah_keluar'];
                                    $jumlah_masuk = $data['jumlah_masuk'];
                                    $saldo = $data['saldo'];
?>
                                <tr>
                                    <td><?php echo $nama; ?></td>
                                    <td>Rp. <?php echo number_format($jumlah_keluar, 2, ',', '.'); ?></td>
                                    <td>Rp. <?php echo number_format($jumlah_masuk, 2, ',', '.'); ?></td>
                                    <td>Rp. <?php echo number_format($saldo, 2, ',', '.'); ?></td>
                                    <td>
                                        <!-- Button untuk modal -->
                                        <a href="export-laporan.php?nama=<?php echo urlencode($nama); ?>&jumlah_keluar=<?php echo urlencode($jumlah_keluar); ?>&jumlah_masuk=<?php echo urlencode($jumlah_masuk); ?>&saldo=<?php echo urlencode($saldo); ?>"
                                            type="button" class="btn btn-primary btn-md"><i
                                                class="fa fa-download"></i></a>
                                    </td>
                                </tr>
                                <?php
}
?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- End of Main Content -->

    </div>
    <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <?php require 'logout-modal.php';?>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/datatables-demo.js"></script>

</body>

</html>