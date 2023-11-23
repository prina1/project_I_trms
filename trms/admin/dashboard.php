<?php
// Start a session to handle user login status
session_start();

// Include the database connection file
include('includes/dbconnection.php');

// If the user is not logged in, redirect to the logout page
if (empty($_SESSION['trmsaid'])) {
    header('location: logout.php');
    exit;
}
?>

<!doctype html>
<html class="no-js" lang="en">

<head>
    <title>TRMS Admin Dashboard</title>

    <!-- CSS Stylesheets -->
    <link rel="stylesheet" href="../vendors/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../vendors/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="../vendors/themify-icons/css/themify-icons.css">
    <link rel="stylesheet" href="../vendors/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="../vendors/selectFX/css/cs-skin-elastic.css">
    <link rel="stylesheet" href="../vendors/jqvmap/dist/jqvmap.min.css">
    <link rel="stylesheet" href="../assets/css/style.css">

    <!-- Google Fonts -->
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>
</head>

<body>
    <!-- Include the sidebar -->
    <?php include_once('includes/sidebar.php'); ?>

    <div id="right-panel" class="right-panel">
        <!-- Include the header -->
        <?php include_once('includes/header.php'); ?>

        <!-- Breadcrumbs -->
        <div class="breadcrumbs">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Dashboard</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li class="active">Dashboard</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="content mt-3">
            <!-- Card: Listed Subjects -->
            <a href="manage-subjects.php">
                <div class="col-sm-6 col-lg-6">
                    <div class="card text-white bg-flat-color-4">
                        <div class="card-body pb-0">
                            <?php
                            // Get the count of listed subjects from the database
                            $sql = "SELECT COUNT(ID) AS sublist FROM subjects";
                            $query = $dbh->prepare($sql);
                            $query->execute();
                            $row = $query->fetch();
                            $sublist = $row['sublist'];
                            ?>

                            <h2 class="mb-0">
                                <span class="count"><?php echo htmlentities($sublist); ?></span>
                            </h2>
                            <p class="text-light">Listed Subjects</p>

                            <div class="chart-wrapper px-3" style="height:70px;" height="70">
                                <canvas id="widgetChart4"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </a>

            <!-- Card: Total Registered Teachers -->
            <a href="manage-teacher.php">
                <div class="col-sm-6 col-lg-6">
                    <div class="card text-white bg-flat-color-2">
                        <div class="card-body pb-0">
                            <?php
                            // Get the count of total registered teachers from the database
                            $sql1 = "SELECT COUNT(ID) AS totalteacher FROM teacher";
                            $query1 = $dbh->prepare($sql1);
                            $query1->execute();
                            $row1 = $query1->fetch();
                            $totalteacher = $row1['totalteacher'];
                            ?>

                            <h2 class="mb-0">
                                <span class="count"><?php echo htmlentities($totalteacher); ?></span>
                            </h2>
                            <p class="text-light">Total Registered Teachers</p>

                            <div class="chart-wrapper px-0" style="height:70px;" height="70">
                                <canvas id="widgetChart2"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </a>

            <!-- Card: Registered Teachers (Profile Not Public) -->
            <a href="manage-notpublicprofileteacher.php">
                <div class="col-sm-6 col-lg-6">
                    <div class="card text-white bg-flat-color-3">
                        <div class="card-body pb-0">
                            <?php
                            // Get the count of registered teachers with non-public profiles from the database
                            $sql2 = "SELECT COUNT(ID) AS notPublicTeachers FROM teacher WHERE isPublic IS NULL OR isPublic='0'";
                            $query2 = $dbh->prepare($sql2);
                            $query2->execute();
                            $row2 = $query2->fetch();
                            $notPublicTeachers = $row2['notPublicTeachers'];
                            ?>

                            <h2 class="mb-0">
                                <span class="count"><?php echo htmlentities($notPublicTeachers); ?></span>
                            </h2>
                            <p class="text-light">Registered Teachers (Profile Not Public)</p>

                            <div class="chart-wrapper px-0" style="height:70px;" height="70">
                                <canvas id="widgetChart2"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </a>

            <!-- Card: Registered Teachers (Profile Public) -->
            <a href="manage-publicprofileteacher.php">
                <div class="col-sm-6 col-lg-6">
                    <div class="card text-white bg-flat-color-5">
                        <div class="card-body pb-0">
                            <?php
                            // Get the count of registered teachers with public profiles from the database
                            $sql3 = "SELECT COUNT(ID) AS publicTeachers FROM teacher WHERE isPublic='1'";
                            $query3 = $dbh->prepare($sql3);
                            $query3->execute();
                            $row3 = $query3->fetch();
                            $publicTeachers = $row3['publicTeachers'];
                            ?>

                            <h2 class="mb-0">
                                <span class="count"><?php echo htmlentities($publicTeachers); ?></span>
                            </h2>
                            <p class="text-light">Registered Teachers (Profile Public)</p>

                            <div class="chart-wrapper px-0" style="height:70px;" height="70">
                                <canvas id="widgetChart2"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div> <!-- .content -->
    </div><!-- /#right-panel -->

    <!-- JS Scripts -->
    <script src="../vendors/jquery/dist/jquery.min.js"></script>
    <script src="../vendors/popper.js/dist/umd/popper.min.js"></script>
    <script src="../vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="../assets/js/main.js"></script>
    <script src="../vendors/chart.js/dist/Chart.bundle.min.js"></script>
    <script src="../assets/js/dashboard.js"></script>
    <script src="../assets/js/widgets.js"></script>
    <script src="../vendors/jqvmap/dist/jquery.vmap.min.js"></script>
    <script src="../vendors/jqvmap/examples/js/jquery.vmap.sampledata.js"></script>
    <script src="../vendors/jqvmap/dist/maps/jquery.vmap.world.js"></script>
    <script>
        (function($) {
            "use strict";

            jQuery('#vmap').vectorMap({
                map: 'world_en',
                backgroundColor: null,
                color: '#ffffff',
                hoverOpacity: 0.7,
                selectedColor: '#1de9b6',
                enableZoom: true,
                showTooltip: true,
                values: sample_data,
                scaleColors: ['#1de9b6', '#03a9f5'],
                normalizeFunction: 'polynomial'
            });
        })(jQuery);
    </script>

</body>

</html>

