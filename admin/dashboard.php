<?php
session_start();


// Mengambil data foto profil dan nama lengkap dari database
$host = 'localhost';
$dbUsername = 'root';
$dbPassword = '';
$dbName = 'sueb_hospital';

$conn = new mysqli($host, $dbUsername, $dbPassword, $dbName);

if ($conn->connect_error) {
    die('Koneksi ke database gagal: ' . $conn->connect_error);
}

$email = $_SESSION['email'];

$query = "SELECT foto_profil FROM admin WHERE email = '$email'";
$result = $conn->query($query);
    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $fotoProfil = $row['foto_profil'];
}

$query = "SELECT nama FROM admin WHERE email = '$email'";
    $result = $conn->query($query);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $nama = $row['nama'];
    }

$query = "SELECT id FROM admin WHERE email = '$email'";
    $result = $conn->query($query);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $id = $row['id'];
    }

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Dashboard - Admin</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <!-- Sidebar Toggle-->
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>    
        <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="dashboard.php">Sueb Hospital Admin</a>
            <!-- Navbar-->
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <a class="nav-link" href="dashboard.php">
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
                                    <a class="nav-link" href="../admin/media/gambar.php">Gambar</a>
                                    <a class="nav-link" href="../admin/media/video.php">Video</a>
                                </nav>
                            </div>
                            <a class="nav-link" href="ulasan.php">
                                <div class="sb-nav-link-icon" href="ulasan.php"><i class="fas fa-book-open"></i></div>
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
                        <h1 class="mt-4">Dashboard</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                    
                    <div class="card mb-4">
                        <div class="card-body" style="display: flex; flex-direction: column; align-items: center; position: relative;">
                            <div class="profile-picture" style="text-align: center; padding: 50px;">
                                <img src="../img/<?php echo $fotoProfil ?>" alt="Profile Picture" style="object-fit: cover; width: 200px; height: 200px; border-radius: 50%;">
                                <h2 style="margin-bottom: 10px;">Selamat Datang, <?php echo $nama; ?>!</h2>
                                <p><?php echo $email; ?></p>
                            </div>
                            <!-- Buttons in the top-right corner -->
                            <div style="position: absolute; top: 10px; right: 10px;">
                                <a href="edit_dash.php?id=<?php echo $id ?>"> <button class='btn btn-primary'>Edit Profil</button> </a>
                                <a href="m_logout.php"> <button class='btn btn-danger'>Log Out</button> </a>
                            </div> 
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
                window.location.href = "./index.php";
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
        <script src="js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/chart-area-demo.js"></script>
        <script src="assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
        <script src="js/datatables-simple-demo.js"></script>
    </body>
</html>
