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
        <title>Admin panel-Zeiterfassung</title>
        <link href="css/styles.css" rel="stylesheet" />
        <link href='css/calendar.css' rel='stylesheet' />
        <script src="js/calendar.js"></script>
        <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <a class="navbar-brand" href="index.html">Kyasser GmbH</a>
            <button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i class="fas fa-bars"></i></button>
            
            <!-- Navbar Logout-->
            <div class="d-md-inline-block ml-auto my-md-0"></div>
        
            <ul class="navbar-nav ml-auto ml-md-0 ">
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
              
        <!-- START: side verticle Bar -->
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
            <!-- END: side verticle Bar -->

            <!-- START: Pop up for timings -->
            <div id="layoutSidenav_content">
               <div class="modal fade" id="event-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                            <h4 class="modal-title">Zeit hinzufügen</h4>
                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Schließen</span></button>
                            </div>
                            <div class="modal-body">
                            <form name="save-event" method="post">
                                <div class="form-group">
                                <label>Kommen</label>
                                <input type="text" name="evtStart" id="evtStart" class="form-control col-xs-3" />
                                </div>
                                <div class="form-group">
                                <label>Gehen</label>
                                <input type="text" name="evtEnd" id="evtEnd" class="form-control col-xs-3" />
                                </div> 
                            </div>
                            <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Schließen</button>
                            <button type="submit" class="btn btn-primary">Speichern</button>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>  
                </main>
                    <div class="container-fluid">
                        <h1 class="mt-4">Teilnahme und Zeiterfassung</h1>
                        <div>
                        

                        <select class="browser-default custom-select custom-select-lg mb-3 bg-light" id="employee_list">
                            <option value="0">Mitarbeiter auswählen:</option>
                            <?php 
                            //gets all Employees names from mitarbeiter table
                            $employees = file_get_contents('http://127.0.0.1:8000/v2/mitarbeiters');
                            $employees = json_decode($employees,false);    
                            foreach($employees as $employee){
                                echo "<option value=".$employee->id.">".$employee->vorname." ".$employee->nachname."</option>";                             
                            }
                            ?>
                          </select>
                        </div>
                        
                        <div id="calendar"></div>
                    </div>
                </main>
                 
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/chart-area-demo.js"></script>
        <script src="assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/datatables-demo.js"></script>
        
        
        
        <!-- Add timings.  -->
        <script>
 
        
        $('#employee_list').change(function (e) {
              var calendarEl = document.getElementById('calendar');
              var emp_id = $("#employee_list").val();
               var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'timeGridWeek',
                locale: 'de',
                firstDay: 1,
                businessHours: { 
                    daysOfWeek: [ 1, 2, 3, 4, 5],  
                    startTime: '06:00', 
                    endTime: '18:00',  
                },
                nowIndicator: true,
                editable: true, 
                selectable: true,
                displayEventEnd: false, 
                events:  function (info, successCallback, failureCallback) {
                    console.log(emp_id);
                    console.log(info);
                    const url = 'http://127.0.0.1:8000/timesheet/'+emp_id;
                    const requestObject = {
                    method: "GET",
                    data: {},
                    headers: {
                        'Content-Type': 'application/json',
                    }
                    };
                    fetch(url, requestObject)
                    .then((response) => {
                         return response.json();
                        }).then((data)=>{ 
                            if (successCallback) successCallback(data);
                        })
                    .catch((error) => {
                        console.error('Error:', error);
                        failureCallback(error);
                    });
             
                        },
                select: function(info) {
                        $('#event-modal').find('input[name=evtStart]').val(
                            info.startStr.substring(0,16)
                        );
                        $('#event-modal').find('input[name=evtEnd]').val(
                            info.endStr.substring(0,16)
                        );
                        $('#event-modal').modal('show'); 

                         $("#event-modal").find('form').on('submit', function() {
                            createTimesheet(); 
                        }); 
                    },
                eventClick: function(calEvent) {
                    var newTime = prompt("Enter New Time:", calEvent.event.startStr.substring(11,16));
                    if(calEvent.event.title === "Kommen") {   
                        const data = {
                        "id": calEvent.event.id,
                        "check_in": newTime,
                        "check_out": ""
                    };
                    updateTimesheet(data);
                    }else{
                        const data = {
                        "id": calEvent.event.id,
                        "check_in": "",
                        "check_out":newTime
                    };
                    updateTimesheet(data);
                    }
                    }, 
                });
                calendar.render();
            });  
        
        const createTimesheet = async () => {
            var clock_in = $("#evtStart").val().split('T');
            var clock_out = $("#evtEnd").val().split('T');
            var emp_id = $("#employee_list").val();
            const data = {
                "date":clock_in[0],
                "mitarbeiter_id": emp_id,
                "timesheet":{
                "check_in":clock_in[1],
                "check_out":clock_out[1] 
            }
            };

            const url = 'http://127.0.0.1:8000/attendance';
            const requestObject = {
            method: "PUT",
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify(data),
            };
            fetch(url, requestObject)
            .then((response) => {
                alert("Stundensätze wurde erfolgreich hinzugefügt!");
                })
            .catch((error) => {
                console.error('Error:', error);
            });
        }

        const updateTimesheet = async (data) => {
            const url = 'http://127.0.0.1:8000/timesheet';
            const requestObject = {
            method: "POST",
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify(data),
            };
            fetch(url, requestObject)
            .then((response) => {
                alert("Time slot updated successfully!");
                })
            .catch((error) => {
                console.error('Error:', error);
            });
            
        }
          </script>
    </body>
</html>
