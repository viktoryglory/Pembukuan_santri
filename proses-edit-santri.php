<?php
//include('dbconnected.php');
include('koneksi.php');

$id = $_GET['id_santri'];
$nama = $_GET['nama'];
$alamat = $_GET['alamat'];
$kelas = $_GET['kelas'];
$kontak_wali = $_GET['kontak_wali'];
$email = $_GET['email'];

//query update
$query = mysqli_query($koneksi,"UPDATE santri SET nama='$nama' , alamat='$alamat', kelas='$kelas', kontak_wali='$kontak_wali', email='$email' WHERE id_santri='$id' ");

if ($query) {
 # credirect ke page index
 header("location:santri.php"); 
}
else{
 echo "ERROR, data gagal diupdate".  mysqli_error($koneksi);
}

//mysql_close($host);
?>