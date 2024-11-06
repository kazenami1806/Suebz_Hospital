<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Gambar - Admin</title>
        <link href="../css/styles.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>

        <!-- DataTables -->
        <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
        <script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
        <link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/jquery.dataTables.min.css" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css" />
        <link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/dataTables.bootstrap5.min.css" />
    </head>
    <body>
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <!-- Sidebar Toggle-->
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i
                    class="fas fa-bars"></i></button>
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="../dashboard.php">Sueb Hospital Admin</a>
            <!-- Navbar-->
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <a class="nav-link" href="../dashboard.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Dashboard
                            </a>
                            <div class="sb-sidenav-menu-heading">Interface</div>
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts"
                                aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                                Media
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="../../admin/media/gambar.php">Gambar</a>
                                    <a class="nav-link" href="../../admin/media/video.php">Video</a>
                                </nav>
                            </div>
                            <a class="nav-link" href="../ulasan.php">
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
                        <h1 class="mt-4">Video</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="../dashboard.php">Dashboard</a></li>
                            <li class="breadcrumb-item active">Video</li>
                        </ol>
                        <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-table me-1"></i>
                            Data Video
                        </div>
                        <div class="card-body">
                            <table id="video" class="table table-bordered hover">
                                <button type="button" class="btn btn-success" style="margin-bottom: 20px;" onclick="window.location.href = '../media/proses/add_video.php'" >Tambah Video</button>
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Video</th>
                                        <th>Notes</th>
                                        <th>Video</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                    include '../../config/koneksi.php';
                                    $data = mysqli_query($conn, "select * from video");
                                    $no = 1;
                                    while ($row = mysqli_fetch_assoc($data)) {
                                        echo "<tr>
                                                <td>$no</td>
                                                <td>" . $row['name_vid'] . "</td>
                                                <td>" . $row['notes_v'] . "</td>
                                                <td><video src='../../img/video/" . $row['vid'] . "' width=25%></td>
                                                
                                                <td>
                                                    <button class='btn btn-primary' onclick=\"location.href='../media/proses/edit_video.php?id_video=" . $row['id_video'] . "'\">Edit</button>
                                                    <button class='btn btn-danger' onclick=\"confirmDelete(" . $row['id_video'] . ")\">Delete</button>
                                                </td>
                                            </tr>";
                                        $no++;
                                    }
                                ?>

                                </tbody>
                            </table>
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
                window.location.href = "../index.php";
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

            // Function to confirm delete before actually deleting the image
            function confirmDelete(id_video) {
                if (confirm("Apakah Anda yakin ingin menghapus video ini?")) {
                    // If user confirms, redirect to delete image script
                    redirectToDelete(id_video);
                }
            }

            // Function to redirect to delete image script
            function redirectToDelete(id_video) {
                window.location.href = "../media/proses/m_delete_video.php?id_video=" + id_video;
            }
        </script>

        <script>
            new DataTable('#video', {
                columnDefs: [
                    { className: 'dt-center', width: 20, targets: 0 },
                    { className: 'dt-center', width: 500, targets: 4 },
                    { className: 'dt-center', width: 500, targets: 3 }
                ],
            });
        </script>

        </script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="../js/scripts.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
        <script src="../js/datatables-simple-demo.js"></script>
    </body>
</html>