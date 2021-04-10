<?php
session_start();
$_SESSION['user'] = 0;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Admin panel-Login</title>
    <link href="css/styles.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>
</head>

<body class="bg-primary">

    <div id="layoutAuthentication">
        <div id="layoutAuthentication_content">
            <main>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-5">
                            <div class="card shadow-lg border-0 rounded-lg mt-5">
                                <div class="card-header">
                                    <h3 class="text-center font-weight-light my-4">Login</h3>
                                </div>
                                <div class="card-body">

                                    <?php
                                    $errorMsg = $emailErr = $passwordErr = "";
                                    $email = $password = "";
                                    if ($_SERVER["REQUEST_METHOD"] == "POST") {
                                        if (empty($_POST["inputEmailAddress"])) {
                                            $emailErr = "* Email ist erforderlich.";
                                        } else {
                                            $email = $_POST["inputEmailAddress"];
                                            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                                                $emailErr = "* ungültiges Format.";
                                            } else {
                                                $email = $_POST["inputEmailAddress"];
                                            }
                                        }
                                        if (empty($_POST["inputPassword"])) {
                                            $passwordErr = "* Passwort ist erforderlich.";
                                        } else {
                                            $password = $_POST["inputPassword"];
                                        }

                                        $jsonresponses = file_get_contents('http://127.0.0.1:8000/v2/mitarbeiters');
                                        $jsonresponses = json_decode($jsonresponses, false);

                                        foreach ($jsonresponses as $jsonresponse) {
                                            $existing_pass = $jsonresponse->passwort;
                                            $existing_email = $jsonresponse->email;
                                            $existing_rolle = $jsonresponse->rolle;


                                            if (md5($password) == $existing_pass && $email == $existing_email && $existing_rolle == "admin") {
                                                $_SESSION['user'] =  'admin';
                                                header("Location:Mitarbeiterverwaltung.php");
                                            } elseif (md5($password) == $existing_pass && $email == $existing_email && $existing_rolle == "lagerpersonal") {
                                                $_SESSION['user'] =  'lagerpersonal';
                                                header("Location: StundensummeLager.php?employee_id=$jsonresponse->id");
                                            } else {
                                                $errorMsg = "* Email Id und Passwort stimmen nicht";
                                            }
                                        }
                                    }
                                    ?>



                                    <form class="form-signin" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
                                        <div class="form-group">
                                            <label class="small mb-1" for="email">Email:</label>
                                            <input class="form-control py-4" id="inputEmailAddress" name="inputEmailAddress" type="email" placeholder="E-Mail Adresse eingeben" />
                                            <span style="color:red;"><?php echo $emailErr; ?></span>
                                        </div>
                                        <div class="form-group">
                                            <label class="small mb-1" for="password">Passwort:</label>
                                            <input class="form-control py-4" id="inputPassword" name="inputPassword" type="password" placeholder="Passwort eingeben" />
                                            <span style="color:red;"><?php echo $passwordErr . $errorMsg; ?></span>
                                        </div>

                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox">
                                                <input class="custom-control-input" id="rememberPasswordCheck" type="checkbox" />
                                                <label class="custom-control-label" for="rememberPasswordCheck">Passwort erinnern</label>

                                            </div>
                                        </div>
                                        <div class="form-group d-flex align-items-center justify-content-between mt-4 mb-0">
                                            <a class="small" href="PasswordRecovery.php">Passwort vergessen?</a>
                                            <button class="btn btn-primary" type="submit">Login</button>
                                        </div>
                                    </form>
                                </div>
                                <div class="card-footer text-center"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
        <div id="layoutAuthentication_footer">
            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">Copyright &copy; 2021</div>
                        <div></div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/4.0.0/crypto-js.min.js" integrity="sha512-nOQuvD9nKirvxDdvQ9OMqe2dgapbPB7vYAMrzJihw5m+aNcf0dX53m6YxM4LgA9u8e9eg9QX+/+mPu8kCNpV2A==" crossorigin="anonymous"></script>

</body>

</html>