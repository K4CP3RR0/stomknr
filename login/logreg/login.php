<?php
/**
 * 
 * @package StomatologiaKNR
 * @author Kacper Cichorski <kacper.cichorski@zsmeie.edu.torun.pl>
 * @author Natan Grajczyk <natan.grajczyk@zsmeie.edu.torun.pl>
 * @author Remigiusz Fischer <remigiusz.fischer@zsmeie.edu.torun.pl>
 * @copyright Copyright (c) 2022 StomatologiaKNR <https://github.com/K4CP3RR0/stomknr>
 * @license Propietary license
 * @version 1.0.0
 */
    /** 
     * Start sesji pacjenta */
    session_start();
    /** 
     * Sprawdzenie czy istnieje sesja, jeśli tak przeniesienie do panelu pacjenta */
    if((isset($_SESSION["zalogowany"])) && ($_SESSION["zalogowany"]==true)){
        header("Location: panelpacjenta.php");
        exit;
    }


?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Logowanie</title>

    
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

    <div class="container">

       
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Witamy ponownie!</h1>
                                    </div>
                                    <form class="user" method="post" action="login_checker.php">
                                        <div class="form-group">
                                            <input type="email" class="form-control form-control-user"
                                                id="exampleInputEmail" aria-describedby="emailHelp"
                                                name= "InputEmail" placeholder="Adres Email">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user"
                                                id="exampleInputPassword" name="InputPassword" placeholder="Hasło">
                                        </div>
                                        <input type="submit"id="submit" class="btn btn-primary btn-user btn-block" name="submitLog" value="Zaloguj się"/> 
                                    </form>
                                    
                                    <hr class="alert-primary">
                                    
                                    <div class="text-center">
                                        <a class="small" href="register.php">Utwórz konto!</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

</body>

</html>