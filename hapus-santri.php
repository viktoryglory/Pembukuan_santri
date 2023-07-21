<?php
//include('dbconnected.php');
include('koneksi.php');

$id = $_GET['id_santri'];

//query update
$query = mysqli_query($koneksi,"DELETE FROM `santri` WHERE id_santri = '$id'");

if ($query) {
 # credirect ke page index
 header("location:santri.php"); 
}
else{
 echo "ERROR, data gagal diupdate". mysqli_error($koneksi);
}

//mysql_close($host);
?>