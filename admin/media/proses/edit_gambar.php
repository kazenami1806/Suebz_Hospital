<?php
include("../../../config/koneksi.php");

$id_gambar = $_GET["id_gambar"];
$query = "SELECT * FROM gambar WHERE id_gambar = '$id_gambar'";
$result = $conn->query($query);

if ($result->num_rows == 1) {
    $gambar = $result->fetch_assoc();
}

$conn->close();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Gambar - Admin</title>
    <link rel="stylesheet" href="../../css/styles.css" />
    <!-- DataTables -->
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/jquery.dataTables.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/dataTables.bootstrap5.min.css" />

    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</head>

<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <!-- Sidebar Toggle-->
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
        <!-- Navbar Brand-->
        <a class="navbar-brand ps-3" href="../../dashboard.php">Sueb Hospital Admin</a>
        <!-- Navbar-->
    </nav>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">
                        <a class="nav-link" href="../../dashboard.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Dashboard
                        </a>
                        <div class="sb-sidenav-menu-heading">Interface</div>
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                            <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                            Media
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="../gambar.php">Gambar</a>
                                <a class="nav-link" href="../video.php">Video</a>
                            </nav>
                        </div>
                        <a class="nav-link" href="../../ulasan.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                            Ulasan
                        </a>
                    </div>
                </div>
                <div class="sb-sidenav-footer">
                    <div class="small">Logged in as:</div>
                    ADMIN
                </div>
            </nav>
        </div>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">Edit Gambar</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item"><a href="../../dashboard.php">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="../gambar.php">Gambar</a></li>
                        <li class="breadcrumb-item active">Edit Gambar</li>
                    </ol>
                    <div class="card mb-4">
                        <div class="card-body">
                            <form method="POST" action="m_edit_gambar.php?id_gambar=<?php echo $id_gambar; ?>" enctype="multipart/form-data">
                                <div class="mb-2">
                                    <label for="name_img" class="form-label">Nama Gambar :</label>
                                    <input type="text" class="form-control" id="name_img" name="name_img" value="<?php echo isset($gambar['name_img']) ? $gambar['name_img'] : ''; ?>" required>
                                </div>
                                <div class="mb-2">
                                    <label for="notes" class="form-label">Keterangan Gambar :</label>
                                    <input type="text" class="form-control" id="notes" name="notes" value="<?php echo isset($gambar['notes']) ? $gambar['notes'] : ''; ?>" required>
                                </div>
                                <div class="mb-1">
                                    <label for="img" class="form-label">Gambar :</label>
                                    <br><img src="../../../img/slideshow/<?php echo isset($gambar['img']) ? $gambar['img'] : ''; ?>" width=30% style="margin-bottom: 10px;">
                                </div>
                                <div class="mb-4">
                                    <label for="img" class="form-label">Ganti Gambar :
                                        <div id="passwordHelpBlock" class="form-text">
                                            *Format gambar landscape.
                                        </div></label>
                                    <input class="form-control" type="file" id="img" name="img">
                                </div>

                                <button type="button" class="btn btn-danger" onclick="window.location.href = '../gambar.php'">Close</button>
                                <button type="submit" class="btn btn-success">Edit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </main>
            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid px-4">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">Copyright &copy; SUEB Hospital 2023</div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <script>
            // Function to show session expired alert
            function showSessionExpiredAlert() {
                alert("Sesi admin telah habis. Anda akan diarahkan ke halaman login.");
            }

            // Function to reset session timer when user interacts with the page
            function resetSessionTimer() {
                clearTimeout(sessionTimeout);
                sessionTimeout = setTimeout(function() {
                    showSessionExpiredAlert();
                    redirectToLogin();
                }, 3600000); // 3600000 ms = 1 hour
            }

            // Function to redirect to login page
            function redirectToLogin() {
                window.location.href = "../../index.php";
            }

            // Set session timer when the page loads
            var sessionTimeout = setTimeout(function() {
                showSessionExpiredAlert();
                redirectToLogin();
            }, 3600000); // 3600000 ms = 1 hour

            // Add event listeners to reset session timer when user interacts with the page
            window.addEventListener("click", resetSessionTimer);
            window.addEventListener("mousemove", resetSessionTimer);
            window.addEventListener("keypress", resetSessionTimer);
        </script> 
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="../../js/scripts.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
    <script src="../../js/datatables-simple-demo.js"></script>
</body>

</html>