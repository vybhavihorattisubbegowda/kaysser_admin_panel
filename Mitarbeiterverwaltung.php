<?php

session_start();
if ($_SESSION['user'] != 'admin') {
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
    <title>Admin Panel-Mitarbeiterverwaltung</title>
    <link href="css/styles.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
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
                        <a class="nav-link" href="Zeiterfassung.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-clock"></i></div>
                            Zeiterfassung
                        </a>
                        <a class="nav-link" href="Mitarbeiterverwaltung.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-users-cog"></i></div>
                            Mitarbeiterverwaltung
                        </a>
                        <a class="nav-link" href="Stundensummen.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Stundensummen
                        </a>
                    </div>
                </div>
                <div class="sb-sidenav-footer">
                    <div class="small">Angemeldet als:</div>
                    Administrator
                </div>
            </nav>
        </div>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid">
                    <h1 class="mt-4">Mitarbeiterverwaltung</h1>
                    <hr />
                    <!-- Button trigger modal -->
                    <button type="button" onclick="resetEmployeeForm()" class="btn btn-primary" data-toggle="modal" data-target="#employeeModal">
                        Mitarbeiter hinzufügen
                    </button>
                    <!-- Modal -->
                    <div class="modal fade" id="employeeModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLongTitle">Mitarbeiter hinzufügen/ bearbeiten</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form id="employeeForm">
                                        <div class="form-group">
                                            <label for="vorname" class="col-form-label">Vorname:</label>
                                            <input type="text" class="form-control" id="vorname">
                                            <input type="hidden" id="employeeId" name="employeeId" value="">
                                            <div style="color:red; font-size: 12px">* Pflichtfeld</div>
                                        </div>

                                        <div class="form-group">
                                            <label for="nachname" class="col-form-label">Nachname:</label>
                                            <input type="text" class="form-control" id="nachname">
                                            <div style="color:red; font-size: 12px">* Pflichtfeld</div>

                                        </div>

                                        <div class="form-group">
                                            <label for="email" class="col-form-label">Email:</label>
                                            <input type="text" class="form-control" id="email">
                                        </div>

                                        <div class="form-group">
                                            <label for="rfid_nr" class="col-form-label">RFID Tag:</label>
                                            <input type="text" class="form-control" id="rfid_nr">


                                        </div>

                                        <div class="form-group">
                                            <label for="password" class="col-form-label">Passwort:</label>
                                            <input type="password" class="form-control" id="password">
                                        </div>

                                        <div class="form-group">
                                            <label for="role" class="col-form-label">Rolle:</label>
                                            <select class="custom-select" id="rolle">
                                                <option value="admin">Admin</option>
                                                <option value="lagerpersonal">Lagerpersonal</option>
                                                <option value="azubi">Azubi</option>
                                                </option>
                                            </select>
                                            <div style="color:red; font-size: 12px">* Pflichtfeld</div>
                                        </div>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Schließen</button>
                                    <button type="button" onclick="addEmplopyee()" class="btn btn-primary">Speichern</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr />
                    <div class="table-responsive">
                        <table class="table table-bordered" id="employeeDT" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Vorname</th>
                                    <th>Nachname</th>
                                    <th>Email</th>
                                    <th>Passwort</th>
                                    <th>Rolle</th>
                                    <th>RFID Tag</th>
                                    <!--here comes javascript target column -1 -->
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                //gets all Employees details from mitarbeiter table
                                $employees = file_get_contents('http://127.0.0.1:8000/v2/mitarbeiters');
                                $employees = json_decode($employees, false);
                                foreach ($employees as $employee) {
                                    echo '<tr data-line-id="' . $employee->id . '">';
                                    echo '<td data-type="id">' . $employee->id . '</td>';
                                    echo '<td data-type="firstname">' . $employee->vorname . '</td>';
                                    echo '<td data-type="lastname">' . $employee->nachname . '</td>';
                                    echo '<td data-type="email">' . $employee->email . '</td>';
                                    echo '<td data-type="password">' . $employee->passwort . '</td>';
                                    echo '<td data-type="role">' . $employee->rolle . '</td>';
                                    echo '<td data-type="rfid">' . $employee->rfid_nr . '</td>';
                                    //here comes javascript target column -1
                                    echo "<td> </td>";
                                    echo "</tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </main>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="./js/scripts.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
    <script src="./assets/demo/datatables-demo.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/4.0.0/crypto-js.min.js" integrity="sha512-nOQuvD9nKirvxDdvQ9OMqe2dgapbPB7vYAMrzJihw5m+aNcf0dX53m6YxM4LgA9u8e9eg9QX+/+mPu8kCNpV2A==" crossorigin="anonymous"></script>


    <!-- Functions in Last Column of Table like Edit & Delete  -->
    <script>
        $(document).ready(function() {
            var table = $('#employeeDT').DataTable({
                "columnDefs": [{
                    "targets": -1, //last column in the table
                    "data": null,
                    "defaultContent": '<button id="edit" class="btn btn-warning">Bearbeiten</button> <button id="delete" class="btn btn-danger">Löschen</button>'
                }],

                //search for...
                language: {
                    search: "Suche:",
                    searchPlaceholder: "Vorname /Nachname"
                }
            });





            //Employee data Modification through jquery function 
            $('#employeeDT tbody').on('click', 'button', function() {
                //assigns id of current button
                const btnType = this.id;
                var data = table.row($(this).parents('tr')).data();
                //if btnType is edit, the respective user data is shown in modal
                if (btnType === "edit") {
                    //Employee ID is taken but not shown in modal
                    $('#employeeId').val(data[0]);
                    $('#vorname').val(data[1]);
                    $('#nachname').val(data[2]);
                    $('#email').val(data[3]);
                    $('#password').val(data[4]);
                    $('#rfid_nr').val(data[6]);
                    $("#rolle").val(data[5]);
                    $('#employeeModal').modal('show')

                } else if (btnType === "delete") {
                    //calling function to Delete certain Employee per DELETE
                    deleteUser(data[0]);
                }
                //pop up meassage displays if wrong action submits
                else {
                    alert("Unknown event");
                }
            });
        });
    </script>

    <script>
        function resetEmployeeForm() {
            document.getElementById("employeeForm").reset();
        }


        //Employee data Modification through jquery function 
        function addEmplopyee() {
            const employeeId = $('#employeeId').val();

            const en_password = CryptoJS.MD5($('#password').val()).toString();
            if (employeeId !== "") {
                //hidden employeeId not empty means EditEmployee so, modal values must be updated
                const data = {
                    id: employeeId,
                    firstName: $('#vorname').val(),
                    lastName: $('#nachname').val(),
                    email: $('#email').val(),
                    password: en_password,
                    role: $('#rolle').val(),
                    rfid_nr: $('#rfid_nr').val()
                };
                if (data.firstName != "" && data.lastName != "" && data.role != "") {
                    //calling function to Update modal values per POST
                    userAction(data, "POST");
                } else {
                    alert("Bitte geben Sie Vorname, Nachname und Rolle ein!");
                }
            } else {
                //hidden employeeId empty means AddEmployee.
                const data = {
                    firstName: $('#vorname').val(),
                    lastName: $('#nachname').val(),
                    email: $('#email').val(),
                    password: en_password,
                    role: $('#rolle').val(),
                    rfid_nr: $('#rfid_nr').val()
                };
                if (data.firstName != "" && data.lastName != "" && data.role != "") {
                    //calling function to Insert modal values per PUT
                    userAction(data, "PUT");
                } else {
                    alert("Bitte geben Sie Vorname, Nachname und Rolle ein!");
                }
            }
        }

        //async methods() run after the main thread has finished processing so that they do not block 
        //subsequent JavaScript code from running.
        const userAction = async (data, method) => {

            const url = 'http://127.0.0.1:8000/mitarbeiter';

            const requestObject = {
                method: method,
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify(data),
            };

            fetch(url, requestObject)
                .then((response) => {
                    $('#employeeModal').modal('hide');
                    alert("Benutzer wurde hinzugefügt/upgedatet!");
                })
                .catch((error) => {
                    console.error('Error:', error);
                });
        }



        const deleteUser = async (id) => {
            const url = 'http://127.0.0.1:8000/mitarbeiter/' + id;
            const requestObject = {
                method: "DELETE",
                headers: {
                    'Content-Type': 'application/json',
                }
            };

            fetch(url, requestObject)
                .then((response) => {
                    alert("Benutzer wurde gelöscht!");
                })
                .catch((error) => {
                    console.error('Error:', error);
                });
        }
    </script>

</body>

</html>