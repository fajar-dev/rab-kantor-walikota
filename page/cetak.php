<?php 
session_start();
if(!isset($_SESSION['username'])) {
    header("Location: ../login.php");
    die();
}
require '../db/koneksi.php';

$id = intval($_GET['id']);
$query  = mysqli_query($koneksi, "SELECT * FROM tbl_event WHERE id = $id");
$hasil = mysqli_fetch_array($query);
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Cetak Rincian Anggaran</title>

    <!-- Custom fonts for this template-->
    <link href="../assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../assets/css/sb-admin-2.min.css" rel="stylesheet">
    

</head>
<script>

  window.print()
</script>

<body id="page-top">

    <!-- Page Wrapper -->
    <div >
        <!-- End of Sidebar -->
        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->

                
                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <center>
                    <h2>
      Rincian Anggaran 
      <br>
      <?php echo htmlentities($hasil['nama_event']) ?>, <?php echo htmlentities($hasil['lokasi']) ?>
    </h2>
</center>
    

                                                    
                          
                                        <table class="table" id="dataTable" width="100%" cellspacing="0" style="font-size: 12px; border-color:black;">
                                            <thead>
                                                <tr>
                                                    <th>NO</th>
                                                    <th>ID Anggaran</th>
                                                    <th>Keterangan</th>
                                                    <th>Tanggal</th>
                                                    <th>Nominal</th>
                                                    <th>Satuan</th>
                                                    <th>Jumlah Total</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                    <?php 
                                                        $no = 1;
                                                        $sql = mysqli_query($koneksi, "SELECT * FROM tbl_anggaran WHERE id_event=$id ");
                                                        while ($data = mysqli_fetch_assoc($sql)) {
                                                    ?>
                                                <tr>
                                                    <td><?php echo $no++ ?></td>
                                                    <td><?php echo htmlentities($data['id']); ?></td>
                                                    <td><?php echo htmlentities($data['keterangan']); ?></td>
                                                    <td><?php echo htmlentities($data['tgl']); ?></td>
                                                    <td>Rp. <?php echo number_format($data['nominal']);  ?></td>
                                                    <td><?php echo htmlentities($data['satuan']);?></td>
                                                    <td>Rp. <?php echo number_format(($data['nominal'])*($data['satuan']));  ?></td>
                                                    
                                                </tr>
                                                    <?php 
                                                        ini_set("display_errors","Off");
                                                        } 
                                                    ?>   
                                            </tbody>
                                        </table>

                                        <div class="text-right">
                                          <h4>Total Anggaran</h4>
                                        <?php
                                                            $sql = mysqli_query($koneksi, "SELECT * FROM tbl_anggaran WHERE id_event=$id");
                                                            while ($data = mysqli_fetch_assoc($sql)) {
                                                                $get_data[] = $data['total'];
                                                            };

                                                            $total_data = array_sum($get_data);

                                                            echo '<sup>Rp </sup>'.number_format($total_data);
                                                        ?>
                                        </div>
                                                      </div>
                                




    <!-- Bootstrap core JavaScript-->
    <script src="../assets/vendor/jquery/jquery.min.js"></script>
    <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="../assets/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="../assets/js/sb-admin-2.min.js"></script>

</body>

</html>