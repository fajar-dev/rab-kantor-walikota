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

    <title>Rincian Anggaran</title>

    <!-- Custom fonts for this template-->
    <link href="../assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../assets/css/sb-admin-2.min.css" rel="stylesheet">
    

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

       <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-file-alt"></i>
                </div>
                <div class="sidebar-brand-text mx-3">Smart PK</div>
            </a>

            
            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                interface
            </div>

            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href="index.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="tambah-event.php">
                    <i class="fas fa-fw fa-plus-circle"></i>
                    <span>Tambah Event</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="event.php">
                    <i class="fas fa-fw fa-book"></i>
                    <span>Daftar event</span>
                </a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->
        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo ucwords($_SESSION['nama']); ?> </span>
                                <img class="img-profile rounded-circle"
                                    src="../assets/img/undraw_profile.svg">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-4 text-gray-800">Rincian Anggaran</h1>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <div class="row justify-content-lg-between">
                                        <div class="col-lg-6">
                                            <h6 class="m-0 pt-lg-2 font-weight-bold text-primary">Detail Anggaran <?php echo htmlentities($hasil['nama_event']) ?>, <?php echo htmlentities($hasil['lokasi']) ?></h6>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="row justify-content-end">
                                                <a href="tambah-anggaran.php?id=<?php echo $id; ?>" class="btn btn-info btn-icon-split ml-2 mr-2">
                                                    <span class="icon text-white-50">
                                                        <i class="fas fa-plus-circle" aria-hidden="true"></i>
                                                    </span>
                                                    <span class="text">Tambah Rincian</span>
                                                </a>    
                                                <a href="cetak.php?id=<?php echo $id; ?>" class="btn btn-primary btn-icon-split ml-2 mr-2">
                                                    <span class="icon text-white-50">
                                                        <i class="fas fa-print" aria-hidden="true"></i>
                                                    </span>
                                                    <span class="text">Cetak Rincian</span>
                                                </a>                                            
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12" style="text-align:right;">
                                        <h5>Total</h5>
                                        <h1>
                                                    <?php
                                                            $sql = mysqli_query($koneksi, "SELECT * FROM tbl_anggaran WHERE id_event=$id");
                                                            while ($data = mysqli_fetch_assoc($sql)) {
                                                                $get_data[] = $data['total'];
                                                            };

                                                            $total_data = array_sum($get_data);

                                                            echo '<sup>Rp </sup>'.number_format($total_data);
                                                        ?>
                                        </h1>
                                    </div>
                                </div>
                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" style="font-size: 12px;;">
                                            <thead>
                                                <tr>
                                                    <th>NO</th>
                                                    <th>ID Anggaran</th>
                                                    <th>Keterangan</th>
                                                    <th>Tanggal</th>
                                                    <th>Nominal</th>
                                                    <th>Satuan</th>
                                                    <th>Jumlah Total</th>
                                                    <th>Aksi</th>
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
                                                    <td>  
                                                        <a href="include/hapus-anggaran.php?id=<?php echo htmlentities($data['id']); ?>" class="btn btn-danger btn-icon-split btn-del">
                                                            <span class="icon text-white-50">
                                                                <i class="fas fa-trash" aria-hidden="true"></i>
                                                            </span>
                                                            <span class="text">Hapus</span>
                                                        </a>
                                                    </td>
                                                </tr>
                                                    <?php 
                                                        ini_set("display_errors","Off");
                                                        } 
                                                    ?>   
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; 2020</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="../logout.php">Logout</a>
                </div>
            </div>
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