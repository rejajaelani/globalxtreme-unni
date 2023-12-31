<?php
session_start();

include "../controller/KoneksiController.php"; // Pastikan Anda memasukkan file yang benar

include "../assets/delMsg.php";

$type = 1;

$sql = "SELECT * FROM pengguna WHERE is_login = " . $_SESSION['login_status'];

$result = mysqli_query($conn, $sql);

if (!$result) {
    // Query tidak berhasil
    die("Error: " . mysqli_error($conn));
}

if (mysqli_num_rows($result) == 0) {
    // Pengguna tidak memiliki akses yang valid, arahkan kembali ke halaman login atau halaman lain yang sesuai
    header("Location: ../");
    exit; // Pastikan untuk menghentikan eksekusi kode setelah pengalihan
} else {
    $row = mysqli_fetch_assoc($result);
    $email = $row['Email'];
    $name = $row['Nama'];
    $idIs_login = $row['Id'];
    $foto = $row['Foto'];
    $levelIs_login = $row['Level'];
}

// Inisialisasi variabel SQL
$sql = "SELECT * FROM new_lead";

// Inisialisasi variabel pencarian
$where = array();
if ($levelIs_login == 3) {
    $sales_src = $idIs_login;
} else {
    $sales_src = isset($_GET['sales-src']) ? $_GET['sales-src'] : '';
}
$status = isset($_GET['status']) ? $_GET['status'] : '';
$probability = isset($_GET['probability']) ? $_GET['probability'] : '';
$source = isset($_GET['source']) ? $_GET['source'] : '';
$media = isset($_GET['media']) ? $_GET['media'] : '';

if (!empty($sales_src)) {
    $where[] = "id_pengguna = " . $sales_src;
}

if (!empty($status)) {
    $where[] = "Status = '" . $status . "'";
}

if (!empty($probability)) {
    $where[] = "Probability LIKE '%" . $probability . "%'";
}

if (!empty($source)) {
    $where[] = "source LIKE '%" . $source . "%'";
}

if (!empty($media)) {
    $where[] = "media LIKE '%" . $media . "%'";
}

// Gabungkan semua kondisi pencarian
if (!empty($where)) {
    $sql .= " WHERE " . implode(" AND ", $where);
}

$result = mysqli_query($conn, $sql);

if (!$result) {
    // Query tidak berhasil
    die("Error: " . mysqli_error($conn));
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AdminLTE 3 | Dashboard</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../assets/plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../assets/dist/css/adminlte.min.css">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="../css/style-custom-component.css">
    <!-- Bootstrap Data Table -->
    <link rel="stylesheet" href="../assets/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/dataTables.bootstrap4.min.css">
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <!-- Preloader -->
        <!-- <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
  </div> -->

        <?php include "../assets/template/navbar.php" ?>

        <?php include "../assets/template/sidebar.php" ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <?php
                        if (!empty($_SESSION['msg'])) {
                        ?>
                            <div class="col-12">
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <strong>Message!</strong> <?= $_SESSION['msg']['key'] ?>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            </div>
                        <?php } ?>
                        <?php
                        if (!empty($_SESSION['msg-w'])) {
                        ?>
                            <div class="col-12">
                                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                    <strong>Message!</strong> <?= $_SESSION['msg-w']['key'] ?>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            </div>
                        <?php } ?>
                        <?php
                        if (!empty($_SESSION['msg-f'])) {
                        ?>
                            <div class="col-12">
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <strong>Message!</strong> <?= $_SESSION['msg-f']['key'] ?>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            </div>
                        <?php } ?>
                        <div class="col-12">
                            <h1 class="m-0">Data New Lead</h1>
                        </div><!-- /.col -->
                        <div class="col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">Data Customer</li>
                                <li class="breadcrumb-item active">New Lead</li>
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
                                <div class="card-header bg-white border-0">
                                    <!-- Fillter New Lead -->
                                    <div class="fillter-new-lead">
                                        <form method="GET" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                                            <div class=" row">
                                                <div class="col-12">
                                                    <div class="form-group" style="<?= ($levelIs_login == 3) ? 'display: none' : ''; ?>">
                                                        <label for="sales-src">Search By Sales</label>
                                                        <select class="form-control" id="sales-src" name="sales-src">
                                                            <option value="">-- Select Sales --</option>
                                                            <?php
                                                            // Query SQL untuk mengambil data pengguna
                                                            $sql2 = "SELECT * FROM pengguna";
                                                            $result2 = $conn->query($sql2);

                                                            if ($result2->num_rows > 0) {
                                                                while ($row2 = $result2->fetch_assoc()) {
                                                            ?>
                                                                    <option value="<?= $row2['Id'] ?>" <?= ($sales_src == $row2['Id']) ? 'selected' : ''; ?>><?= $row2['Nama'] ?></option>
                                                            <?php
                                                                }
                                                            } else {
                                                                echo "Parameter ID tidak ditemukan.";
                                                                exit;
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-2">
                                                    <div class="form-group">
                                                        <label for="status">Status</label>
                                                        <select class="form-control" id="status" name="status">
                                                            <option value="">-- Select Status --</option>
                                                            <option value="Scheduled" <?= ($status == 'Scheduled') ? 'selected' : ''; ?>>Scheduled</option>
                                                            <option value="Consideration" <?= ($status == 'Consideration') ? 'selected' : ''; ?>>Consideration</option>
                                                            <option value="Junk" <?= ($status == 'Junk') ? 'selected' : ''; ?>>Junk</option>
                                                            <option value="FCB - Future Call Back" <?= ($status == 'FCB - Future Call Back') ? 'selected' : ''; ?>>FCB - Future Call Back</option>
                                                            <option value="Qualified" <?= ($status == 'Qualified') ? 'selected' : ''; ?>>Qualified</option>
                                                            <option value="NI - Not Interested" <?= ($status == 'NI - Not Interested') ? 'selected' : ''; ?>>NI - Not Interested</option>
                                                            <option value="Out Cover" <?= ($status == 'Out Cover') ? 'selected' : ''; ?>>Out Cover</option>
                                                            <option value="Not Response" <?= ($status == 'Not Response') ? 'selected' : ''; ?>>Not Response</option>
                                                            <option value="Pending" <?= ($status == 'Pending') ? 'selected' : ''; ?>>Pending</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-2">
                                                    <div class="form-group">
                                                        <label for="probability">Probability</label>
                                                        <select class="form-control" id="probability" name="probability">
                                                            <option value="">-- Select Probability --</option>
                                                            <option value="Converted" <?= ($probability == 'Converted') ? 'selected' : ''; ?>>Converted</option>
                                                            <option value="Pending" <?= ($probability == 'Pending') ? 'selected' : ''; ?>>Pending</option>
                                                            <option value="Cancel" <?= ($probability == 'Cancel') ? 'selected' : ''; ?>>Cancel</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-2">
                                                    <div class="form-group">
                                                        <label for="source">Source</label>
                                                        <select class="form-control" id="source" name="source">
                                                            <option value="">-- Select Source --</option>
                                                            <option value="Outbound" <?= ($source == 'Outbound') ? 'selected' : ''; ?>>Outbound</option>
                                                            <option value="Inbound - Tawk To" <?= ($source == 'Inbound - Tawk To') ? 'selected' : ''; ?>>Inbound - Tawk To</option>
                                                            <option value="Inbound - WA Center" <?= ($source == 'Inbound - WA Center') ? 'selected' : ''; ?>>Inbound - WA Center</option>
                                                            <option value="Inbound - Call" <?= ($source == 'Inbound - Call') ? 'selected' : ''; ?>>Inbound - Call</option>
                                                            <option value="Inbound - Walk in" <?= ($source == 'Inbound - Walk in') ? 'selected' : ''; ?>>Inbound - Walk in</option>
                                                            <option value="Customer Support" <?= ($source == 'Customer Support') ? 'selected' : ''; ?>>Customer Support</option>
                                                            <option value="Sales" <?= ($source == 'Sales') ? 'selected' : ''; ?>>Sales</option>
                                                            <option value="Other" <?= ($source == 'Other') ? 'selected' : ''; ?>>Other</option>

                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-2">
                                                    <div class="form-group">
                                                        <label for="media">Media</label>
                                                        <select class="form-control" id="media" name="media">
                                                            <option value="">-- Select Media --</option>
                                                            <option value="Outbound" <?= ($media == 'Outbound') ? 'selected' : ''; ?>>Outbound</option>
                                                            <option value="WA Center" <?= ($media == 'WA Center') ? 'selected' : ''; ?>>WA Center</option>
                                                            <option value="Call" <?= ($media == 'Call') ? 'selected' : ''; ?>>Call</option>
                                                            <option value="Website" <?= ($media == 'Website') ? 'selected' : ''; ?>>Website</option>
                                                            <option value="Email" <?= ($media == 'Email') ? 'selected' : ''; ?>>Email</option>
                                                            <option value="Walk In" <?= ($media == 'Walk In') ? 'selected' : ''; ?>>Walk In</option>
                                                            <option value="Sales" <?= ($media == 'Sales') ? 'selected' : ''; ?>>Sales</option>
                                                            <option value="Other" <?= ($media == 'Other') ? 'selected' : ''; ?>>Other</option>
                                                            <option value="Digital Platform" <?= ($media == 'Digital Platform') ? 'selected' : ''; ?>>Digital Platform</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-2" style="display: flex;align-items: center;">
                                                    <button class="btn btn-primary"><i class="fas fa-search"></i> Search</button>
                                                    <a href="./" class="btn btn-secondary ml-2"><i class="fas fa-sync-alt"></i></a>
                                                </div>
                                                <div class="col-2" style="display: flex;align-items: center;">
                                                    <a href="tambah-data/" class="btn bg-custom-lgreen" style="color: #FFFF !important;"><i class="fas fa-users"></i> Tambah</a>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <!-- /.Fillter New Lead -->
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <table id="example1" class="table table-bordered table-striped" style="font-size: 12px !important;">
                                        <thead>
                                            <tr>
                                                <th>Lead</th>
                                                <th>Primary Contact</th>
                                                <th>Status</th>
                                                <th>Probabilty</th>
                                                <th>Source</th>
                                                <th>Media</th>
                                                <th>Last Update</th>
                                                <th>Asigned To</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            if ($result->num_rows > 0) {
                                                $no = 1; // Inisialisasi nomor baris
                                                // Output data pengguna ke dalam tabel
                                                while ($row = $result->fetch_assoc()) {
                                                    echo "<tr>";
                                                    echo "<td>" . $row['Fullname'] . "</td>";
                                                    echo "<td>" . $row['Phonenumber'] . "</td>";
                                                    echo "<td>" . $row['Status'] . "</td>";
                                                    if ($row['Probability'] === 'Converted') {
                                                        echo "<td><div class='badge badge-primary'>" . $row['Probability'] . "</div></td>";
                                                    } elseif ($row['Probability'] === 'Pending') {
                                                        echo "<td><div class='badge badge-warning'>" . $row['Probability'] . "</div></td>";
                                                    } elseif ($row['Probability'] === 'Cancel') {
                                                        echo "<td><div class='badge badge-danger'>" . $row['Probability'] . "</div></td>";
                                                    }
                                                    echo "<td>" . $row['source'] . "</td>";
                                                    echo "<td>" . $row['media'] . "</td>";
                                                    echo "<td>" . $row['last_update'] . "</td>";
                                                    if ($row['asigned_to'] == 00) {
                                            ?>
                                                        <td>
                                                            <a href="asigned-to/?id=<?= $row['Id'] ?>" class="btn btn-sm btn-secondary" style="font-size: 10px !important;">
                                                                Asigned To <i class="fas fa-pen"></i>
                                                            </a>
                                                        </td>
                                                        <?php } else {
                                                        $sql2 = "SELECT Nama FROM pengguna WHERE Id = " . $row['asigned_to'];
                                                        $result2 = $conn->query($sql2);

                                                        if ($result2->num_rows > 0) {
                                                            while ($row2 = $result2->fetch_assoc()) {
                                                        ?>
                                                                <td>
                                                                    <a href="asigned-to/?id=<?= $row['Id'] ?>" class="btn btn-sm btn-secondary" style="font-size: 10px !important;">
                                                                        <?= $row2['Nama'] ?> <i class="fas fa-pen"></i>
                                                                    </a>
                                                                </td>
                                                    <?php }
                                                        }
                                                    } ?>
                                                    <td>
                                                        <a href="edit-data/?id=<?= $row['Id'] ?>" class="btn btn-sm btn-primary">
                                                            <i class="fas fa-pen"></i>
                                                        </a>
                                                        <a href="../controller/delete-new-lead.php/?id=<?= $row['Id'] ?>" class="btn btn-sm btn-danger">
                                                            <i class="fas fa-times"></i>
                                                        </a>
                                                        <a href="./detail/?id=<?= $row['Id'] ?>" class="btn btn-sm btn-secondary">
                                                            <i class="fas fa-info"></i>
                                                        </a>
                                                    </td>
                                            <?php
                                                }
                                                $no++; // Tingkatkan nomor baris setiap kali iterasi
                                            } else {
                                                echo "<tr><td colspan='9'>Tidak ada data new lead.</td></tr>";
                                            }

                                            // Tutup koneksi
                                            $conn->close();
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.container-fluid -->
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <footer class="main-footer">
            <strong>&copy; <?php echo date("Y"); ?> <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
            <div class="float-right d-none d-sm-inline-block">
                <b>Version</b> 3.2.0
            </div>
        </footer>
    </div>
    <!-- ./wrapper -->

    <!-- Jquery -->
    <script src="../assets/jQuery.js"></script>
    <!-- Data Table -->
    <script src="../assets/dataTable.min.js"></script>
    <script src="../assets/dataTable.bootstrap4.min.js"></script>
    <!-- Bootstrap JavaScript -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../assets/dist/js/adminlte.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="../assets/dist/js/demo.js"></script>
    <!-- Script Here -->
    <script>
        $(document).ready(function() {
            $("#example1").DataTable();
        });
    </script>

    <!-- /.Script -->
    <?php include "../assets/template/footer-end.php" ?>
</body>

</html>