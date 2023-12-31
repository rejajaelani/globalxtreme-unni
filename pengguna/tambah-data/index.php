<?php include "../../assets/template/header-2.php" ?>

<?php $type = 2; ?>

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
              <h1 class="m-0">Tambah Data Pengguna</h1>
            </div><!-- /.col -->
            <div class="col-12">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Data Master</a></li>
                <li class="breadcrumb-item active">Tambah Data</li>
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
                  <h5><i class="fas fa-user-plus"></i> Tambah Data Pengguna</h5>
                </div>
                <div class="card-body">
                  <form action="../../controller/input-pengguna.php" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                      <label for="name">Nama</label>
                      <input type="text" class="form-control" id="name" name="name" placeholder="Nama..." required>
                    </div>
                    <div class="form-group">
                      <label for="username">Username</label>
                      <input type="text" class="form-control" id="username" name="username" placeholder="Username..." required>
                    </div>
                    <div class="form-group">
                      <label for="password">Password</label>
                      <input type="password" class="form-control" id="password" name="password" placeholder="Password..." required>
                    </div>
                    <div class="form-group">
                      <label for="email">Email address</label>
                      <input type="email" class="form-control" id="email" name="email" placeholder="Email..." required>
                    </div>
                    <div class="form-group">
                      <label for="level">Level</label>
                      <select class="form-control" id="level" name="level">
                        <option style="display: none;">-- Pilih Level --</option>
                        <option value="1">Admin</option>
                        <option value="2">Super Admin</option>
                        <option value="3">Sales</option>
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="status">Status</label>
                      <select class="form-control" id="status" name="status">
                        <option value="1">Aktif</option>
                        <option value="0">Non-Aktif</option>
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="image">Foto</label>
                      <input type="file" class="form-control-file" id="image" name="image" accept="image/*" required>
                    </div>
                    <button class="btn bg-custom-lgreen" style="color: #FFFF !important;">Simpan Data</button>
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