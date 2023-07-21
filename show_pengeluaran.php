<?php
//include('dbconnected.php');
include('koneksi.php');

// Function untuk mengambil jumlah pengeluaran dari suatu sumber
function getJumlahPengeluaran($koneksi, $id_sumber) {
    $query = mysqli_query($koneksi, "SELECT SUM(jumlah) as total FROM pengeluaran WHERE id_sumber = '$id_sumber'");
    $result = mysqli_fetch_assoc($query);
    return $result['total'] ?: 0;
}

// Mendapatkan data sumber dari database
$sumberData = mysqli_query($koneksi, "SELECT * FROM sumber");

// Array kode warna yang berbeda
$array_warna = array("bg-danger", "bg-warning", "bg-info", "bg-primary", "bg-success");

$i = 0; // Index untuk kode warna

while ($sumber = mysqli_fetch_assoc($sumberData)) {
    $id_sumber = $sumber['id_sumber'];
    $nama_sumber = $sumber['nama'];

    // Mendapatkan jumlah pengeluaran dari sumber berdasarkan id_sumber
    $jumlah_pengeluaran = getJumlahPengeluaran($koneksi, $id_sumber);

    // Format jumlah pengeluaran menjadi format mata uang
    $formatted_jumlah_pengeluaran = number_format($jumlah_pengeluaran, 2, ',', '.');

    // Menghitung jumlah sumber dalam tabel pengeluaran
    $jumlah_sumber = mysqli_query($koneksi, "SELECT id_sumber FROM pengeluaran WHERE id_sumber = '$id_sumber'");
    $sumber_text = mysqli_num_rows($jumlah_sumber);
    $progress_width = $sumber_text * 10;

    // Tampilkan data sumber dengan kode warna berbeda
    echo '
        <h4 class="small font-weight-bold">' . $nama_sumber . '<span class="float-right">Rp. ' . $formatted_jumlah_pengeluaran . '</span></h4>
        <div class="progress mb-4">
            <div class="' . $array_warna[$i] . '" role="progressbar" style="width:' . $progress_width . '%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">' . $sumber_text . ' Kali</div>
        </div>
    ';

    $i++; // Pindah ke kode warna berikutnya
}
?>