<?php
session_start();
if ($_SESSION['user'] != 'lagerpersonal') {
    header("Location:Login.php"); 
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
    <title>Admin Panel-StundensummenLager</title>
    <link href="css/styles.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/1.10.23/css/jquery.dataTables.min.css" rel="stylesheet" crossorigin="anonymous" />
    <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
    <link href="https://cdn.datatables.net/buttons/1.6.5/css/buttons.dataTables.min.css" rel="stylesheet" crossorigin="anonymous" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>
</head>

<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <a class="navbar-brand" href="index.html">Kaysser GmbH</a>
        <button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i class="fas fa-bars"></i></button>

        <!-- Navbar Logout-->
        <div class="d-md-inline-block ml-auto my-md-0"></div>
        <ul class="navbar-nav ml-auto ml-md-0">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="userDropdown" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                    <a class="dropdown-item" href="#">Settings</a>
                    <a class="dropdown-item" href="#">Activity</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="Login.php">Logout</a>
                </div>
            </li>
        </ul>
    </nav>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">
                        <div class="sb-sidenav-menu-heading"><img src="./imges/colored_logo.png" alt="logo" height="50" width="150"></div>

                        <a class="nav-link" href="#">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Stundensummen
                        </a>
                    </div>
                </div>
                <div class="sb-sidenav-footer">
                    <div class="small">Angemeldet als:</div>
                    Lagerpersonal
                </div>
            </nav>
        </div>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid">
                    <div>
                        <h1 class="mt-4">Stundensummen</h1>
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="month-tab" data-toggle="tab" href="#month" role="tab" aria-controls="month" aria-selected="true">Monat</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="week-tab" data-toggle="tab" href="#week" role="tab" aria-controls="week" aria-selected="false">Kalenderwoche</a>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <!-- START: MONTH TABLE-->
                            <div class="tab-pane fade show active" id="month" role="tabpanel" aria-labelledby="month-tab">

                                <div class="card mb-4">
                                    <div class="card-header">
                                        <i class="fas fa-table mr-1"></i>
                                        Tägliche Arbeitsstunden sind pro Monat aussummiert!
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-bordered" id="dataTable1" width="100%" cellspacing="0">
                                                <thead>
                                                    <tr>
                                                        <th>Vorname</th>
                                                        <th>Nachname</th>
                                                        <th>RFID Nummer</th>
                                                        <th>Monat</th>
                                                        <th>Arbeitstunden</th>
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                    <?php

                                                    //login page redirects Lagerpersonal to his StundensummenLager.php with their respective IDs 
                                                    //respective employee_id is added in url by assigning to the variable
                                                    $id = $_GET['employee_id'];

                                                    //URL contains SQL result of Combined tables like Mitarbeiter, Attendance,Timesheet
                                                    $url = 'http://127.0.0.1:8000/attendance/summary/monthly/' . $id;

                                                    $monthly_hours = file_get_contents($url);
                                                    //Array with Objects instead Arrays
                                                    if ($monthly_hours) {
                                                        $monthly_hours = json_decode($monthly_hours, false);
                                                        foreach ($monthly_hours as $monthly_hour) {
                                                            echo "<tr>";
                                                            echo "<td>" . $monthly_hour->vorname . "</td>";
                                                            echo "<td>" . $monthly_hour->nachname . "</td>";
                                                            echo "<td>" . $monthly_hour->rfid_nr . "</td>";
                                                            echo "<td>" . $monthly_hour->month . "</td>";
                                                            echo "<td>" . $monthly_hour->hours . "</td>";
                                                            echo "</tr>";
                                                        }
                                                    }
                                                    ?>

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>

                            </div>


                            <!-- START: WEEK TABLE-->
                            <div class="tab-pane fade" id="week" role="tabpanel" aria-labelledby="week-tab">


                                <div class="card mb-4">
                                    <div class="card-header">
                                        <i class="fas fa-table mr-1"></i>
                                        Tägliche Arbeitsstunden sind pro Woche aussummiert!
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-bordered" id="dataTable2" width="100%" cellspacing="0">
                                                <thead>
                                                    <tr>
                                                        <th>Vorname</th>
                                                        <th>Nachname</th>
                                                        <th>RFID Nummer</th>
                                                        <th>Kalenderwoche</th>
                                                        <th>Arbeitstunden</th>
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                    <?php
                                                    //$id = $_GET['employee_id'];

                                                    //URL contains SQL result of Combined tables like Mitarbeiter, Attendance,Timesheet
                                                    $weekly_hours = file_get_contents('http://127.0.0.1:8000/attendance/summary/weekly/' . $id);
                                                    //Array with Objects instead Arrays
                                                    $weekly_hours = json_decode($weekly_hours, false);
                                                    foreach ($weekly_hours as $weekly_hour) {
                                                        echo "<tr>";
                                                        echo "<td>" . $weekly_hour->vorname . "</td>";
                                                        echo "<td>" . $weekly_hour->nachname . "</td>";
                                                        echo "<td>" . $weekly_hour->rfid_nr . "</td>";
                                                        echo "<td>" . $weekly_hour->week . "</td>";
                                                        echo "<td>" . $weekly_hour->hours . "</td>";
                                                        echo "</tr>";
                                                    }
                                                    ?>

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <!-- END: WEEK TABLE-->
                        </div>
                        <!-- END: BOTH TABLES-->
                    </div>

                </div>
            </main>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
    <script src="assets/demo/datatables-demo.js"></script>

    <!-- Search for...  -->
    <script>
        $('#dataTable1').dataTable({
            language: {
                search: "Suche:",
                searchPlaceholder: "Vorname /Nachname"
            }
        });
        $('#dataTable2').dataTable({
            language: {
                search: "Suche:",
                searchPlaceholder: "Vorname /Nachname"
            }
        });
    </script>
</body>

</html>