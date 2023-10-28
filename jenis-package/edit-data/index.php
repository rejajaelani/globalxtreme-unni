<?php
include "../../assets/template/header-2.php";

$type = 2;

// Periksa apakah ID jenis package yang akan di-edit disediakan
if (isset($_GET['id'])) {
  $jenisId = $_GET['id'];

  // Query database untuk mendapatkan data jenis package berdasarkan ID
  $sql = "SELECT * FROM jenis WHERE Id = $jenisId";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $jenisName = $row['Nama_jenis'];
  } else {
    echo "Data tidak ditemukan.";
    exit;
  }
} else {
  echo "ID jenis package tidak diberikan.";
  exit;
}
?>

<body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper">

    <!-- Preloader -->
    <!-- <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
  </div> -->

    <?php include "../../assets/template/navbar.php" ?>

    <?php include "../../assets/template/sidebar-2.php" ?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-12">
              <h1 class="m-0">Edit Jenis Package</h1>
            </div><!-- /.col -->
            <div class="col-12">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Data Master</a></li>
                <li class="breadcrumb-item active">Edit Data</li>
              </ol>
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->

      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-header">
                  <h5><i class="fas fa-user-plus"></i> Edit Jenis Package</h5>
                </div>
                <div class="card-body">
                  <form action="../../controller/edit-jenis.php" method="post">
                    <!-- Input tersembunyi untuk menyimpan ID jenis package -->
                    <input type="hidden" name="id" value="<?= $jenisId; ?>">

                    <div class="form-group">
                      <label for="name">Nama Jenis Package</label>
                      <input type="text" class="form-control" id="name" name="name" value="<?= $jenisName; ?>" placeholder="Nama..." required>
                    </div>
                    <button class="btn bg-custom-lgreen" style="color: #FFFF !important;">Update Data</button>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /.container-fluid -->
      </section>
      <!-- /.content -->

    </div>
    <!-- /.content-wrapper -->

    <?php include "../../assets/template/footer-2.php" ?>

    <!-- Script Here -->
    <script>

    </script>
    <!-- /.Script -->

    <?php include "../../assets/template/footer-end-2.php" ?>