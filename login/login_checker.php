<?php
    session_start();
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    if((!isset($_POST['InputPassword'])) || (!isset($_POST['InputEmail'])) || $_POST['InputPassword']=="" || $_POST['InputEmail']==""){
        header('Location: login.php');
        exit;
    }
    else{
        require_once("con.php");

        $login = $_POST['InputEmail'];
        $haslo = $_POST['InputPassword'];
        
        $login = htmlentities($login, ENT_QUOTES, "UTF-8");
        $haslo = htmlentities($haslo, ENT_QUOTES, "UTF-8");

        if(!$link){
            echo "Error";
            header('Location: login.php');
	        exit;
        }
        if ($result = mysqli_query($link, sprintf("SELECT * FROM pacjenci WHERE email = '%s' AND haslo='%s' ",mysqli_real_escape_string($link,$login),
            mysqli_real_escape_string($link,$haslo)))) {
            // echo "Returned rows are: " . mysqli_num_rows($result);
            // echo sprintf("SELECT * FROM pacjenci WHERE email = '%s' AND haslo='%s' ",mysqli_real_escape_string($link,$login),
            // mysqli_real_escape_string($link,$haslo));
            if(mysqli_num_rows($result) == 1){  
                $_SESSION["zalogowany"]=true;
                
                $_SESSION["login"]=$login;
                $_SESSION["haslo"]=$haslo;
                // echo "<h1><center> Login successful ".$login."</center></h1>";
                // echo "<p>".$login."<br>";
                // echo  $pass."</p>";
                // $sql = "SELECT imie,nazwisko FROM pacjenci WHERE email = '".$_SESSION['login']."' AND haslo = '".$_SESSION['haslo']."'";
                // echo "<br>".$sql;
                // $result = $link -> query($sql);
                // $result = mysqli_query($link,$sql);
                
                $rows = $result -> fetch_object();
                $_SESSION['id']=$rows->id_pacjent;
                $_SESSION['imie']=$rows->imie;
                $_SESSION['nazwisko']=$rows->nazwisko;
                // echo $_SESSION['imie'];
                // echo $_SESSION['nazwisko'];
                // echo isset($_SESSION['zalogowany']);
                header("Location: panelpacjenta.php");
                exit;
            }  
            else{  
                header('Location: login.php');
                exit;
            }
        }
    }
    mysqli_close($link); 
?>
  