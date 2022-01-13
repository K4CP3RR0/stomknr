<?php
  session_start();
    if(isset($_SESSION["zalogowany"])){
      // echo isset($_SESSION["zalogowany"]);
        header("Location: panelpacjenta.php");
        exit;
    }
    if(isset($_SESSION["zalogowany_pracownicy"])){
        // echo isset($_SESSION["zalogowany"]);
          header("Location: panellekarza.php");
          exit;
      }
    // ini_set('display_errors', 1);
    // ini_set('display_startup_errors', 1);
    // error_reporting(E_ALL);
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Wybierz typ konta</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4 te">Wybierz typ konta</h1>
                                    </div>
                                    <a href="login.php" class="text-decoration-none" ><button class="btn btn-primary btn-user btn-block " >Pacjent</button></a>
                                    <hr class="alert-primary">   
                                    <a href="login_lekarz.php" class="text-decoration-none" ><button class="btn btn-primary btn-user btn-block " >Lekarz</button></a> 
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