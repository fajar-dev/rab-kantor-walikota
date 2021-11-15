<?php
include "../../db/koneksi.php";

$id=$_GET['id'];   

$hapus = mysqli_query($koneksi, "DELETE FROM tbl_event where id='$id'");
$hapus2 = mysqli_query($koneksi, "DELETE FROM tbl_anggaran where id_event='$id'");
if($hapus && $hapus2) {
    echo "<script>
    alert('Berhasil Menghapus Event');
    document.location.href = '../event.php';
    </script>";   
}else {
    echo "<script>
    alert('Gagal Menghapus Event');
    document.location.href = '../event.php';
    </script>";   
}

?>