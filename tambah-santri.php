<?php
//include('dbconnected.php');
include('koneksi.php');

$nama = $_GET['nama'];
$alamat = $_GET['alamat'];
$kelas = $_GET['kelas'];
$kontak_wali = $_GET['kontak_wali'];
$email = $_GET['email'];

//query update
$query = mysqli_query($koneksi,"INSERT INTO `santri` (`id_santri`, `nama`, `alamat`, `kelas`, `kontak_wali`, `email`) VALUES (null, '$nama', '$alamat', '$kelas', '$kontak_wali', '$email')");

if ($query) {
 # credirect ke page index
 header("location:santri.php"); 
}
else{
 echo "ERROR, data gagal diupdate". mysqli_error($koneksi);
}

//mysql_close($host);
?>