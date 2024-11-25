<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <title>Faster Kube</title>
         <style>
        .loader-container {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(255, 255, 255, 0.9); /* Couleur de fond semi-transparente */
            z-index: 9999; /* Assure que le loader soit au-dessus de tout le contenu */
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .loader-container video {
            max-width: 100%;
            max-height: 100%;
        }

        .content-container {
            display: none; /* Contenu principal masqué initialement */
        }

        .container {
            margin-top: 50px;
        }

        .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0px 0px 20px 0px rgba(0, 0, 0, 0.1);
        }

        .card-body {
            padding: 30px;
        }

        .form-group label {
            font-weight: bold;
            color: #333;
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
            transition: background-color 0.3s ease, border-color 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }

    </style>
    
    

</head>

<body id="page-top">
    <!-- Loader -->
    <div class="loader-container">
        <video autoplay loop muted>
            <source src="https://cdnl.iconscout.com/lottie/premium/thumb/cloud-hosting-8485691-6680385.mp4"
                type="video/mp4">
            Your browser does not support the video tag.
        </video>
    </div>
    <!-- Page Wrapper -->
    <div id="wrapper">


        <!-- Sidebar -->
        <?php
            include('sidebar.php');
        ?>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <?php
                    include('navbar.php');
                ?>
                <!-- End of Topbar -->
                
                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <!-- Content Row -->
                    <div class="row">

                        <?php
                            include('head.php');
                        ?>
                            
                        <!-- Content Row -->

                        <div class="container">
                            <div class="row justify-content-center">
                                <div class="col-md-6">
                                    <div class="card">
                                        <div class="card-body">
                                            <form action="deploy.php" method="post" enctype="multipart/form-data">
                                                <div class="form-group">
                                                    <label for="fileToUpload">Sélectionnez les fichiers YAML :</label>
                                                    <input type="file" class="form-control-file"
                                                        name="fileToUpload[]" id="fileToUpload" multiple
                                                        accept=".yaml, .yml">
                                                </div>
                                                <div class="text-center">
                                                    <button type="submit" class="btn btn-primary">Déployer
                                                        YAML</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Content Row -->
                        <div class="row">

                            <!-- Content Column -->
                            <div class="col-lg-6 mb-4">
                            </div>

                            <div class="col-lg-6 mb-4">
                            </div>
                        </div>

                    </div>
                    <!-- /.container-fluid -->

                </div>
                <!-- End of Main Content -->

                <!-- Footer -->
                <?php
                    include('footer.php');
                ?>
                <!-- End of Footer -->
            </div>
            <!-- End of Content Wrapper -->
        </div>
        <!-- End of Page Wrapper -->
        <!-- Scroll to Top Button-->
        <a class="scroll-to-top rounded" href="#page-top">
            <i class="fas fa-angle-up"></i>
        </a>
        <!-- Bootstrap core JavaScript-->
        <script src="vendor/jquery/jquery.min.js"></script>
        <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

        <!-- Core plugin JavaScript-->
        <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

        <!-- Custom scripts for all pages-->
        <script src="js/sb-admin-2.min.js"></script>

        <!-- Page level plugins -->
        <script src="vendor/chart.js/Chart.min.js"></script>

        <!-- Page level custom scripts -->
        <script src="js/demo/chart-area-demo.js"></script>
        <script src="js/demo/chart-pie-demo.js"></script>

        <!-- Page level plugins -->
        <script src="vendor/datatables/jquery.dataTables.min.js"></script>
        <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

        <!-- Page level custom scripts -->
        <script src="js/demo/datatables-demo.js"></script>
        <script>
            // Masquer le loader après 3 secondes et afficher le contenu principal
            setTimeout(function() {
                document.querySelector('.loader-container').style.display = 'none';
                document.querySelector('.content-container').style.display = 'block';
            }, 500);
        </script>


</body>

</html>
