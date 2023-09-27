<?php include "../../assets/template/header-2.php" ?>

<?php
// Periksa apakah parameter ID dari data yang akan diubah telah dikirimkan
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Query SQL untuk mengambil data dari tabel new_lead berdasarkan ID
    $selectSql = "SELECT * FROM new_lead WHERE Id = ?";
    $selectStmt = $conn->prepare($selectSql);

    if ($selectStmt) {
        $selectStmt->bind_param("i", $id);
        $selectStmt->execute();
        $result = $selectStmt->get_result();
        $row = $result->fetch_assoc();
        $selectStmt->close();
    } else {
        echo "Terjadi kesalahan dalam persiapan pernyataan SQL: " . mysqli_error($conn);
    }
} else {
    // Tidak ada parameter ID, maka beri nilai default atau tindakan lain sesuai kebutuhan
    // Contoh:
    echo "Parameter ID tidak ditemukan.";
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
                            <h1 class="m-0">Edit Data Pengguna</h1>
                        </div><!-- /.col -->
                        <div class="col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">Data Master</li>
                                <li class="breadcrumb-item"><a href="../">New Lead</a></li>
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
                            <form action="../../controller/edit-new-lead.php" method="post">
                                <input type="hidden" name="id_pengguna" id="id_pengguna" value="<?= $row['id_pengguna'] ?>">
                                <input type="hidden" name="id_new_lead" id="id_new_lead" value="<?= $row['Id'] ?>">
                                <div class="card">
                                    <div class="card-header text-center border-0">
                                        <h5 class="mt-3">Contact Information</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="form-group row">
                                            <label for="fullname" class="col-sm-2 col-form-label">Full Name</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="fullname" name="fullname" value="<?= $row['Fullname'] ?>">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="address" class="col-sm-2 col-form-label">Address</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="address" name="address" value="<?= $row['Address'] ?>">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="phonenumber" class="col-sm-2 col-form-label">Phone Number</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="phonenumber" name="phonenumber" value="<?= $row['Phonenumber'] ?>">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="email" class="col-sm-2 col-form-label">Email</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="email" name="email" value="<?= $row['Email'] ?>">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header text-center border-0">
                                        <h5 class="mt-3">Company Information</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="form-group row">
                                            <label for="companyname" class="col-sm-2 col-form-label">Company Name</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="companyname" name="companyname" value="<?= $row['Companyname'] ?>">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="companyaddress" class="col-sm-2 col-form-label">Company Address</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="companyaddress" name="companyaddress" value="<?= $row['Companyaddress'] ?>">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="companyphonenumber" class="col-sm-2 col-form-label">Company Phone Number</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="companyphonenumber" name="companyphonenumber" value="<?= $row['Companyphonenumber'] ?>">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="companyemail" class="col-sm-2 col-form-label">Company Email</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="companyemail" name="companyemail" value="<?= $row['Companyemail'] ?>">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header text-center border-0">
                                        <h5 class="mt-3">Other Information</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="form-group row">
                                            <label for="status" class="col-sm-2 col-form-label">Status</label>
                                            <div class="col-sm-10">
                                                <select class="form-control" id="status" name="status">
                                                    <option style="display: none;">-- Select Status --</option>
                                                    <option <?php echo $row['Status'] == "Active" ? "selected" : ""; ?>>Active</option>
                                                    <option <?php echo $row['Status'] == "Non-Active" ? "selected" : ""; ?>>Non-Active</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="probability" class="col-sm-2 col-form-label">Probability</label>
                                            <div class="col-sm-10">
                                                <select class="form-control" id="probability" name="probability">
                                                    <option style="display: none;">-- Select Probability --</option>
                                                    <option <?php echo $row['Probability'] == "Confirmed" ? "selected" : ""; ?>>Confirmed</option>
                                                    <option <?php echo $row['Probability'] == "Pending" ? "selected" : ""; ?>>Pending</option>
                                                    <option <?php echo $row['Probability'] == "Cancel" ? "selected" : ""; ?>>Cancel</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="source" class="col-sm-2 col-form-label">Source</label>
                                            <div class="col-sm-10">
                                                <select class="form-control" id="source" name="source">
                                                    <option style="display: none;">-- Select Source --</option>
                                                    <option <?php echo $row['source'] == "Inbound-Walk in" ? "selected" : ""; ?>>Inbound-Walk in</option>
                                                    <option <?php echo $row['source'] == "Inbound-Call" ? "selected" : ""; ?>>Inbound-Call</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="media" class="col-sm-2 col-form-label">Media</label>
                                            <div class="col-sm-10">
                                                <select class="form-control" id="media" name="media">
                                                    <option style="display: none;">-- Select Media --</option>
                                                    <option <?php echo $row['media'] == "Walk in" ? "selected" : ""; ?>>Walk in</option>
                                                    <option <?php echo $row['media'] == "Call" ? "selected" : ""; ?>>Call</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <a href="../" class="btn btn-secondary ml-2 mr-2">Cancel</a>
                                    <button class="btn bg-custom-lgreen" style="color: #FFFF !important;">Update Changes</button>
                                </div>
                            </form>
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