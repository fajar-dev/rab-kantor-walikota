<?php
include "../../db/koneksi.php";

$id=$_GET['id'];   

$hapus = mysqli_query($koneksi, "DELETE FROM tbl_anggaran where id='$id'");
if($hapus) {
    echo "<script>
    alert('Berhasil Menghapus Anggaran');
    document.location.href = '../event.php';
    </script>";   
}else {
    echo "<script>
    alert('Gagal Menghapus Anggaran');
    document.location.href = '../event.php';
    </script>";   
}

?>