<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Password Recovery</title>
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
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Password Recovery</h3></div>
                                    <div class="card-body">
                                        <div class="small mb-3 text-muted"></div>
                                        
                                     <form class="form-signin">
                                            <div class="form-group">
                                                <label class="small mb-1" for="inputEmailAddress">Email:</label>
                                                <input class="form-control py-4" id="email" type="email" aria-describedby="emailHelp" placeholder="E-Mail Adresse eingeben" />
                                            </div>
                                            <div class="form-group">
                                                <label class="small mb-1" for="password">New Password:</label>
                                                <input class="form-control py-4" id="password" name="inputNewPassword" type="password" placeholder="Neues Passwort eingeben" value=""/>
                                            </div>
                                            
                                            <div class="form-group d-flex align-items-center justify-content-between mt-4 mb-0">
                                                <a class="small" href="Login.php">Zurück zum Login</a>
                                                <button type="button" onclick="resetPassword()" class="btn btn-primary">Reset Password</button>
                                            </div>
                                            
                                        </form>
                                    </div>
                                    <div class="card-footer text-center">
                                        <div class="small"></div>
                                    </div>
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
                            <div>
                                <a href="#">Privacy Policy</a>
                                &middot;
                                <a href="#">Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/4.0.0/crypto-js.min.js" integrity="sha512-nOQuvD9nKirvxDdvQ9OMqe2dgapbPB7vYAMrzJihw5m+aNcf0dX53m6YxM4LgA9u8e9eg9QX+/+mPu8kCNpV2A==" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        
        
        <!--creating an JSON Request Object for Controller method. It is same as postman postman-->
        <script>
        function resetPassword(){
            const url = 'http://127.0.0.1:8000/mitarbeiter/update/password';
            const data = {
                email: $('#email').val(),
                password:  CryptoJS.MD5($('#password').val()).toString()
            };
            const requestObject = {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify(data),
            };
            //same as try catch block
            fetch(url, requestObject)
                .then((response) => {
                    alert("Password updated successfully");
                    window.location.href = "Login.php";
                })
                .catch((error) => {
                    console.error('Error:', error);
                });        
            
            }
        
        </script>

    </body>
</html>
