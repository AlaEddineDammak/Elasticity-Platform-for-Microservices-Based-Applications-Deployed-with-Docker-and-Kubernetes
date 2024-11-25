<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Faster Kube</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

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
            <source src="https://cdnl.iconscout.com/lottie/premium/thumb/cloud-monitoring-8252552-6614332.mp4"
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
                    <div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Deployments List</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <div id="dataTable_wrapper" class="dataTables_wrapper dt-bootstrap4">
                <div class="row">
                    <div class="col-sm-12">
                        <table class="table table-bordered dataTable" id="dataTable" width="100%" cellspacing="0" role="grid" aria-describedby="dataTable_info" style="width: 100%;">
                            <thead>
                                <tr role="row">
                                    <th class="sorting sorting_asc" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending">Name</th>
                                    <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="Ready: activate to sort column ascending">Ready</th>
                                    <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="Up-to-date: activate to sort column ascending">Up-to-date</th>
                                    <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="Available: activate to sort column ascending">Available</th>
                                    <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="Age: activate to sort column ascending">Age</th>
                                    <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="Actions: activate to sort column ascending">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                // Commande kubectl pour obtenir les déploiements au format JSON
                                $command = "sudo -u aladin_257 kubectl get deployments --namespace=default -o json";

                                // Exécution de la commande et récupération de la sortie
                                exec($command, $output);

                                // Convertir la sortie JSON en tableau associatif PHP
                                $data = json_decode(implode("\n", $output), true);

                                // Parcourir les déploiements
                                foreach ($data['items'] as $deployment) {
                                    $name = $deployment['metadata']['name'];
                                    $ready = $deployment['status']['replicas'] . "/" . $deployment['status']['replicas'];
                                    $upToDate = $deployment['status']['updatedReplicas'];
                                    $available = $deployment['status']['availableReplicas'];
                                    $creationTimestamp = strtotime($deployment['metadata']['creationTimestamp']);
                                    $age = humanTiming($creationTimestamp); // Fonction pour convertir le timestamp en format humain

                                    // Afficher les données du déploiement dans une ligne du tableau HTML
                                    echo '<tr>
                                            <td>' . $name . '</td>
                                            <td>' . $ready . '</td>
                                            <td>' . $upToDate . '</td>
                                            <td>' . $available . '</td>
                                            <td>' . $age . '</td>
                                            <td>
                                            <button class="btn btn-danger delete-btn" data-name="' . $name . '">Delete</button>
                                            </td>
                                        </tr>';
                                }

                                // Fonction pour convertir le timestamp en format humain (jours, heures, minutes)
                                function humanTiming($time)
                                {
                                    $time = time() - $time; // to get the time since that moment
                                    $time = ($time < 1) ? 1 : $time;
                                    $tokens = array(
                                        31536000 => 'year',
                                        2592000 => 'month',
                                        604800 => 'week',
                                        86400 => 'day',
                                        3600 => 'hour',
                                        60 => 'minute',
                                        1 => 'second'
                                    );

                                    foreach ($tokens as $unit => $text) {
                                        if ($time < $unit) continue;
                                        $numberOfUnits = floor($time / $unit);
                                        return $numberOfUnits . ' ' . $text . (($numberOfUnits > 1) ? 's' : '');
                                    }
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
        $(document).ready(function() {
            $('.delete-btn').click(function() {
                var deploymentName = $(this).data('name');
                if (confirm('Are you sure you want to delete deployment ' + deploymentName + '?')) {
                    $.ajax({
                        type: 'POST',
                        url: 'delete_deployment.php',
                        data: { 
                            delete_deployment: true, 
                            deployment_name: deploymentName 
                        },
                        success: function(response) {
                            if (response === 'success') {
                                alert('Deployment ' + deploymentName + ' deleted successfully.');
                                location.reload(); // Refresh the page after successful deletion
                            } else {
                                alert('Failed to delete deployment ' + deploymentName + '. Please try again later.');
                            }
                        }
                    });
                }
            });
        });
    </script>
    <script>
            // Masquer le loader après 3 secondes et afficher le contenu principal
            setTimeout(function() {
                document.querySelector('.loader-container').style.display = 'none';
                document.querySelector('.content-container').style.display = 'block';
            }, 500);
        </script>


</body>

</html>

 