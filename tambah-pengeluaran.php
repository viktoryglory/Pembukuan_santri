<?php
include('koneksi.php');

if (isset($_GET['tgl_pengeluaran']) && isset($_GET['jumlah']) && isset($_GET['id_santri']) && isset($_GET['sumber'])) {
    $tgl_pengeluaran = $_GET['tgl_pengeluaran'];
    $jumlah = $_GET['jumlah'];
    $id_santri = $_GET['id_santri'];
    $id_sumber = $_GET['sumber'];

    // Query INSERT ke tabel pengeluaran
    $query = mysqli_query($koneksi, "INSERT INTO pengeluaran (tgl_pengeluaran, jumlah, id_santri, id_sumber) 
            VALUES ('$tgl_pengeluaran', '$jumlah', '$id_santri', '$id_sumber')");

    if ($query) {
        // Update saldo santri
        $querySaldo = mysqli_query($koneksi, "SELECT saldo FROM santri WHERE id_santri = '$id_santri'");
        $saldo = mysqli_fetch_assoc($querySaldo)['saldo'];
        $saldo -= $jumlah;
        $queryUpdateSaldo = mysqli_query($koneksi, "UPDATE santri SET saldo = '$saldo' WHERE id_santri = '$id_santri'");

        if ($queryUpdateSaldo) {
            // Redirect ke halaman pengeluaran
            header("location: pengeluaran.php");
            exit();
        } else {
            echo "ERROR, data gagal diupdate" . mysqli_error($koneksi);
        }
    } else {
        echo "ERROR, data gagal disimpan" . mysqli_error($koneksi);
    }
}
?>