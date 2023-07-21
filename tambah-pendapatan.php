<?php
//include('dbconnected.php');
include('koneksi.php');

$tgl_pemasukan = $_GET['tgl_pemasukan'];
$jumlah = $_GET['jumlah'];
$id_santri = $_GET['id_santri'];

$query = mysqli_query($koneksi, "INSERT INTO pemasukan (id_santri, tgl_pemasukan, jumlah) VALUES ('$id_santri','$tgl_pemasukan', '$jumlah')");

if ($query) {
    // Update saldo santri
    $querySaldo = mysqli_query($koneksi, "SELECT saldo FROM santri WHERE id_santri = '$id_santri'");
    $saldo = mysqli_fetch_assoc($querySaldo)['saldo'];
    $saldo += $jumlah;
    $queryUpdateSaldo = mysqli_query($koneksi, "UPDATE santri SET saldo = '$saldo' WHERE id_santri = '$id_santri'");

    if ($queryUpdateSaldo) {
        // Redirect ke halaman pemasukan
        header("location: pendapatan.php");
        exit();
    } else {
        echo "ERROR, data gagal diupdate" . mysqli_error($koneksi);
    }
} else {
    echo "ERROR, data gagal disimpan" . mysqli_error($koneksi);
}

?>