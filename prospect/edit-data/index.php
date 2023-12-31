<?php include "../../assets/template/header-2.php" ?>

<?php
$id = $_GET['id'];
$id = mysqli_real_escape_string($conn, $id);

$type = 2;

$sql = "SELECT ps.*, nl.Probability FROM prospect ps JOIN new_lead nl ON ps.Id_newlead = nl.Id WHERE ps.Id = '$id'";
$result = mysqli_query($conn, $sql);

if (!$result) {
    echo "Sql Salah: " . mysqli_error($conn);
} else {
    if ($row = mysqli_fetch_assoc($result)) {
        $id_lead = $row["Id_newlead"];
        $customer_type = $row["Prospect_type_cust"];
        $notes_customer_type = $row["Note_type_cust"];
        $first_name = $row["Givenname"];
        $last_name = $row["Surname"];
        $fullname = $first_name . " " . $last_name;
        $gender = $row["Gender"];
        $religion = $row["Religion"];
        $birthday = $row["Birthday"];
        $hometown = $row["Hometown"];
        $current_address = $row["Curaddress"];
        $current_city = $row["Curcity"];
        $area = $row["Area"];
        $nationality = $row["Nationality"];
        $type_general = $row["Type"];
        $mobile_phone = $row["Mobile"];
        $id_card_no = $row["Id_card_no"];
        $passport_no = $row["Passport_no"];
        $street_name = $row["Streetname"];
        $building_name = $row["Building_name"];
        $building_number = $row["No"];
        $building_type = $row["Building_type"];
        $property_owner_type = $row["Property_ownership_type"];
        // $latitude = $row["latitude"];
        // $longitude = $row["longitude"];
        $location_nickname = $row["Location"];
        $package_id = $row["Id_packages"];
        $id_pengguna = $row["Id_pengguna"];
        $sales_rep = $row["sales_representativ"];
        $lead_tele = $row["Lead_telemarketing"];
        $general_notes_all = $row["General_note"];
    } else {
        echo "Data tidak ditemukan.";
    }
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
                            <h1 class="m-0">Edit Data Prospect</h1>
                        </div><!-- /.col -->
                        <div class="col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">Data Master</li>
                                <li class="breadcrumb-item"><a href="../">Data Prospect</a></li>
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
                            <form action="../../controller/edit-prospect.php" method="post" enctype="multipart/form-data">
                                <input type="hidden" name="id-pengguna" id="id-pengguna" value="<?= $idIs_login ?>" required>
                                <input type="hidden" name="id-prospect-edit" id="id-prospect-edit" value="<?= $row['Id'] ?>" required>
                                <div class="card">
                                    <div class="card-header border-0">
                                        <h5 class="m-0"><i class="fas fa-users"></i> Lead</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="form-group">
                                            <select class="form-control" id="id_lead" name="id_lead" required>
                                                <option value="">-- Select Lead --</option>
                                                <?php
                                                // Query SQL untuk mengambil data pengguna
                                                $sql2 = "SELECT * FROM new_lead";
                                                $result2 = $conn->query($sql2);

                                                if ($result2->num_rows > 0) {
                                                    while ($row2 = $result2->fetch_assoc()) {
                                                ?>
                                                        <option value="<?= $row2['Id'] ?>" <?= ($row2['Id'] == $id_lead) ? 'selected' : ''; ?>><?= $row2['Fullname'] ?></option>
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
                                <div class="card">
                                    <div class="card-header border-0">
                                        <h5 class="m-0"><i class="fas fa-list-alt"></i> Customer Type</h5>
                                    </div>
                                    <div class="card-body">
                                        <label for="customer-type">Prospect Type Customer</label>
                                        <div class="form-group">
                                            <select class="form-control" id="customer-type" name="customer-type" required>
                                                <option value="">-- Select Customer Type --</option>
                                                <option <?= ($row['Prospect_type_cust'] == 'Residential') ? 'selected' : ''; ?>>Residential</option>
                                                <option <?= ($row['Prospect_type_cust'] == 'Company') ? 'selected' : ''; ?>>Company</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="notes-customer-type">Notes</label>
                                            <textarea class="form-control" id="notes-customer-type" name="notes-customer-type" rows="3" required><?= $notes_customer_type ?></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header border-0">
                                        <h5 class="m-0"><i class="fas fa-user"></i> General</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-lg-4 col-md-6 col-sm-12">
                                                <div class="form-group">
                                                    <label for="first-name">Given Name</label>
                                                    <input type="text" class="form-control" id="first-name" name="first-name" value="<?= $first_name ?>" placeholder="First Name..." required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="last-name">Surname</label>
                                                    <input type="text" class="form-control" id="last-name" name="last-name" value="<?= $last_name ?>" placeholder="Last Name..." required>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-6 col-sm-12">
                                                <div class="form-group">
                                                    <label for="gender">Gender</label>
                                                    <select class="form-control" id="gender" name="gender" required>
                                                        <option <?= ($row['Gender'] == 'Male') ? 'selected' : ''; ?>>Male</option>
                                                        <option <?= ($row['Gender'] == 'Female') ? 'selected' : ''; ?>>Female</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="religion">Religion</label>
                                                    <input type="text" class="form-control" id="religion" name="religion" placeholder="-" value="<?= $row['Religion'] ?>" required>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-6 col-sm-12">
                                                <div class="form-group">
                                                    <label for="birthday">Birthday</label>
                                                    <input type="date" class="form-control" id="birthday" name="birthday" value="<?= $row['Birthday'] ?>" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-4 col-md-6 col-sm-12">
                                                <div class="form-group">
                                                    <label for="hometown">Hometown</label>
                                                    <input type="text" class="form-control" id="hometown" name="hometown" placeholder="Hometown..." value="<?= $row['Hometown'] ?>" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="current-address">Current Address</label>
                                                    <input type="text" class="form-control" id="current-address" name="current-address" placeholder="Current Address..." value="<?= $row['Curaddress'] ?>" required>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-6 col-sm-12">
                                                <div class="form-group">
                                                    <label for="current-city">Current City</label>
                                                    <input type="text" class="form-control" id="current-city" name="current-city" placeholder="Current City..." value="<?= $row['Curcity'] ?>" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="area">Area</label>
                                                    <input type="text" class="form-control" id="area" name="area" placeholder="Area..." value="<?= $row['Area'] ?>" required>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-6 col-sm-12">
                                                <div class="form-group">
                                                    <label for="nationality">Nationality</label>
                                                    <?php
                                                    // Panggil API
                                                    $apiUrl = "https://restcountries.com/v3.1/all?fields=name";
                                                    $response = file_get_contents($apiUrl);

                                                    if ($response === false) {
                                                        die("Gagal mengambil data dari API.");
                                                    }

                                                    // Parse respons JSON
                                                    $data = json_decode($response);

                                                    if ($data === null) {
                                                        die("Gagal menguraikan data JSON.");
                                                    }

                                                    // Ambil semua nama umum (common name) dari data
                                                    $commonNames = [];
                                                    foreach ($data as $country) {
                                                        $commonNames[] = $country->name->common;
                                                    }

                                                    // Urutkan nama umum sesuai abjad
                                                    sort($commonNames);

                                                    // Buat input select dengan nama umum yang sudah diurutkan
                                                    echo '<select class="form-control" id="nationality" name="nationality" required>';
                                                    echo '<option value="">-- Select Nationality --</option>';
                                                    foreach ($commonNames as $name) { ?>
                                                        <option <?= ($row['Nationality'] == $name) ? 'selected' : ''; ?>><?= $name ?></option>
                                                    <?php
                                                    }
                                                    echo '</select>';
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-4 col-md-6 col-sm-12">
                                                <div class="form-group">
                                                    <label for="type-general">Type</label>
                                                    <select class="form-control" id="type-general" name="type-general" required>
                                                        <option value="">-- Select Type --</option>
                                                        <option <?= ($row['Type'] == 'Residential') ? 'selected' : ''; ?>>Residential</option>
                                                        <option <?= ($row['Type'] == 'Company') ? 'selected' : ''; ?>>Company</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header border-0">
                                        <h5 class="m-0"><i class="fas fa-id-card"></i> Contact Information</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-lg-4 col-md-6 col-sm-12">
                                                <div class="form-group">
                                                    <label for="mobile-phone">Mobile</label>
                                                    <input type="text" class="form-control" id="mobile-phone" name="mobile-phone" placeholder="Mobile Phone Number..." value="<?= $row['Mobile'] ?>" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="home-phone">Home</label>
                                                    <input type="text" class="form-control" id="home-phone" name="home-phone" placeholder="Home Phone Number..." value="<?= $row['home_number'] ?>" required>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-6 col-sm-12">
                                                <div class="form-group">
                                                    <label for="id-card-no">Id Card No.</label>
                                                    <input type="number" class="form-control" id="id-card-no" name="id-card-no" placeholder="No Id Card..." value="<?= $row['Id_card_no'] ?>">
                                                </div>
                                                <div class="form-group">
                                                    <label for="id-card-foto">Id Card Photo</label>
                                                    <input type="file" class="form-control-file border rounded p-1" id="id-card-foto" name="id-card-foto">
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-6 col-sm-12">
                                                <div class="form-group">
                                                    <label for="passport-no">Passport No.</label>
                                                    <input type="number" class="form-control" id="passport-no" name="passport-no" placeholder="No Id Card..." value="<?= $row['Passport_no'] ?>">
                                                </div>
                                                <div class="form-group">
                                                    <label for="passport-foto">Passport Photo</label>
                                                    <input type="file" class="form-control-file border rounded p-1" id="passport-foto" name="passport-foto">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <h3 class="mt-2">Service Location</h3>
                                <div class="card">
                                    <div class="card-header border-0">
                                        <h5 class="m-0"><i class="fas fa-home"></i> General</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-lg-4 col-md-6 col-sm-12">
                                                <div class="form-group">
                                                    <label for="street-name">Street Name</label>
                                                    <input type="text" class="form-control" id="street-name" name="street-name" placeholder="Street Name..." value="<?= $row['Streetname'] ?>" required>
                                                </div>
                                                <div class="row">
                                                    <div class="col-8">
                                                        <div class="form-group">
                                                            <label for="building-name">Building Name</label>
                                                            <input type="text" class="form-control" id="building-name" name="building-name" placeholder="Building Name..." value="<?= $row['Building_name'] ?>" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-4">
                                                        <div class="form-group">
                                                            <label for="building-number">No.</label>
                                                            <input type="number" class="form-control" id="building-number" name="building-number" placeholder="No..." value="<?= $row['No'] ?>" required>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-6 col-sm-12">
                                                <div class="form-group">
                                                    <label for="building-type">Building Type</label>
                                                    <select class="form-control" id="building-type" name="building-type" required>
                                                        <option value="">-- Select Building Type --</option>
                                                        <option <?= ($row['Building_type'] == 'House') ? 'selected' : ''; ?>>House</option>
                                                        <option <?= ($row['Building_type'] == 'Office House') ? 'selected' : ''; ?>>Office House</option>
                                                        <option <?= ($row['Building_type'] == 'Villa') ? 'selected' : ''; ?>>Villa</option>
                                                        <option <?= ($row['Building_type'] == 'Workplace') ? 'selected' : ''; ?>>Workplace</option>
                                                        <option <?= ($row['Building_type'] == 'Office') ? 'selected' : ''; ?>>Office</option>
                                                        <option <?= ($row['Building_type'] == 'Hotel') ? 'selected' : ''; ?>>Hotel</option>
                                                        <option <?= ($row['Building_type'] == 'Factory') ? 'selected' : ''; ?>>Factory</option>
                                                        <option <?= ($row['Building_type'] == 'Others') ? 'selected' : ''; ?>>Others</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="property-owner-type">Property Owner Type</label>
                                                    <select class="form-control" id="property-owner-type" name="property-owner-type" required>
                                                        <option value="">-- Select Property Owner Type --</option>
                                                        <option <?= ($row['Property_ownership_type'] == 'Sole Owner') ? 'selected' : ''; ?>>Sole Owner</option>
                                                        <option <?= ($row['Property_ownership_type'] == 'Rent Tenancy') ? 'selected' : ''; ?>>Rent Tenancy</option>
                                                        <option <?= ($row['Property_ownership_type'] == 'Joint Tenancy') ? 'selected' : ''; ?>>Joint Tenancy</option>
                                                        <option <?= ($row['Property_ownership_type'] == 'Community') ? 'selected' : ''; ?>>Community</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-6 col-sm-12">
                                                <div class="row">
                                                    <div class="col-6">
                                                        <div class="form-group">
                                                            <label for="latitude">Latitude</label>
                                                            <input type="text" class="form-control" id="latitude" name="latitude" placeholder="Latitude..." value="<?= $row['latitude'] ?>" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="form-group">
                                                            <label for="longitude">Longitude</label>
                                                            <input type="text" class="form-control" id="longitude" name="longitude" placeholder="Longitude..." value="<?= $row['longitude'] ?>" required>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header border-0">
                                        <h5 class="m-0"><i class="fas fa-map-marker"></i> Location</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="location-nickname">Location Nickname</label>
                                            <input type="text" class="form-control" id="location-nickname" name="location-nickname" aria-describedby="nicknameHelp" placeholder="Nickname..." value="<?= $row['Location'] ?>" required>
                                            <small id="nicknameHelp" class="form-text text-muted"><strong>Location Nickname</strong> is a familiar name to be use by customers to refer to their specific service location. Leave empty if it's not provided</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header border-0">
                                        <h5 class="m-0"><i class="fas fa-cube"></i> Package</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="package-id">Package</label>
                                            <select class="form-control" id="package-id" name="package-id" required>
                                                <option value="">-- Select Package --</option>
                                                <?php
                                                $sql2 = "SELECT * FROM packages";
                                                $result2 = $conn->query($sql2);

                                                if ($result2->num_rows > 0) {
                                                    while ($row2 = $result2->fetch_assoc()) {
                                                ?>
                                                        <option value="<?= $row2['Id'] ?>" <?= ($row2['Id'] == $row['Id_packages']) ? 'selected' : ''; ?>><?= $row2['Nama_Packages'] ?></option>
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
                                <div class="card">
                                    <div class="card-header border-0">
                                        <h5 class="m-0"><i class="fas fa-code-branch"></i> Network</h5>
                                    </div>
                                    <div class="card-body">
                                        <p class="text-secondary">Group Name : -</p>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header border-0">
                                        <h5 class="m-0"><i class="fas fa-child"></i> Representativ</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-lg-6 col-sm-12">
                                                <div class="form-group">
                                                    <label for="sales-rep">Sales Representativ</label>
                                                    <select class="form-control" id="sales-rep" name="sales-rep" required <?= ($levelIs_login == 3) ? "readonly" : "" ?>>
                                                        <option value="">-- Select Name --</option>
                                                        <?php
                                                        // Query SQL untuk mengambil data pengguna
                                                        $sql2 = "SELECT * FROM pengguna";
                                                        $result2 = $conn->query($sql2);

                                                        if ($result2->num_rows > 0) {
                                                            while ($row2 = $result2->fetch_assoc()) {
                                                        ?>
                                                                <option value="<?= $row2['Id'] ?>" <?= ($row2['Id'] == $row['sales_representativ']) ? 'selected' : ''; ?>><?= $row2['Nama'] ?></option>
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
                                            <div class="col-lg-6 col-sm-12">
                                                <div class="form-group">
                                                    <label for="lead-tele">Lead Telemarketing</label>
                                                    <select class="form-control" id="lead-tele" name="lead-tele" required>
                                                        <option value="">-- Select Name --</option>
                                                        <?php
                                                        // Query SQL untuk mengambil data pengguna
                                                        $sql2 = "SELECT * FROM pengguna";
                                                        $result2 = $conn->query($sql2);

                                                        if ($result2->num_rows > 0) {
                                                            while ($row2 = $result2->fetch_assoc()) {
                                                        ?>
                                                                <option value="<?= $row2['Id'] ?>" <?= ($row2['Id'] == $row['Lead_telemarketing']) ? 'selected' : ''; ?>><?= $row2['Nama'] ?></option>
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
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header border-0">
                                        <h5 class="m-0"><i class="fas fa-sticky-note"></i> General Notes</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="general-notes-all">Notes</label>
                                            <textarea class="form-control" id="general-notes-all" name="general-notes-all" rows="5" required><?= $row['General_note'] ?></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <a href="../" class="btn btn-secondary ml-2 mr-2">Cancel</a>
                                    <button class="btn bg-custom-lgreen" style="color: #FFFF !important;">Save Changes</button>
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