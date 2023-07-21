<?php
// export-laporan.php

// Fungsi untuk mengonversi nilai dari URL yang dienkripsi menjadi data yang sah
function sanitizeData($data)
{
    // Gunakan htmlspecialchars untuk mencegah karakter khusus HTML
    $nama = urldecode(trim(htmlspecialchars(strip_tags($data))));
    
    // Menghilangkan teks "root" dari data
    $nama = str_replace('root', '', $nama);

    return $nama;
}


// Ambil data dari URL dan sanitasi
$nama = sanitizeData($_GET['nama']);
$jumlah_keluar = sanitizeData($_GET['jumlah_keluar']);
$jumlah_masuk = sanitizeData($_GET['jumlah_masuk']);
$saldo = sanitizeData($_GET['saldo']);

// Output file PDF dengan nama 'laporan_keuangan.pdf'
require ('koneksi.php');
require_once __DIR__ . ('/vendor/autoload.php');

use Mpdf\Mpdf; // Gunakan namespace yang benar

$mpdf = new Mpdf(); // Inisialisasi kelas Mpdf
$mpdf->SetTitle("Laporan Keuangan Santri Bulan Ini");
$mpdf->WriteHTML("
    <h1>Laporan Keuangan Santri Bulan Ini</h1>
    <p>Berikut merupakan rincian pengeluaran dan pemasukan santri serta saldo yang masih tersedia:</p>
    <table border='1' cellpadding='5' cellspacing='0'>
        <tr>
            <th>Nama</th>
            <th>Jumlah Transaksi Keluar</th>
            <th>Jumlah Transaksi Masuk</th>
            <th>Jumlah Sisa Uang</th>
        </tr>
        <tr>
            <td>{$nama}</td>
            <td>Rp. " . number_format($jumlah_keluar, 2, ',', '.') . "</td>
            <td>Rp. " . number_format($jumlah_masuk, 2, ',', '.') . "</td>
            <td>Rp. " . number_format($saldo, 2, ',', '.') . "</td>
        </tr>
    </table>
");

$mpdf->Output('Laporan_Keuangan_Santri.pdf', \Mpdf\Output\Destination::INLINE);

?>