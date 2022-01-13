<?php
    session_start();

    if((!isset($_POST['InputPassword'])) || (!isset($_POST['InputEmail'])) || $_POST['InputPassword']=="" || $_POST['InputEmail']==""){
        header('Location: login_lekarz.php');
	    exit;
    }
    else{
        require_once("con.php");

        $login = $_POST['InputEmail'];
        $haslo = $_POST['InputPassword'];
        
        $login = htmlentities($login, ENT_QUOTES, "UTF-8");
        $haslo = htmlentities($haslo, ENT_QUOTES, "UTF-8");

        if(!$link){
            header('Location: login_lekarz.php');
	        exit;
        }
        if ($result = mysqli_query($link, sprintf("SELECT * FROM pracownicy WHERE email = '%s' AND haslo='%s' ",mysqli_real_escape_string($link,$login),
            mysqli_real_escape_string($link,$haslo)))) {
            // echo sprintf("SELECT * FROM pracownicy WHERE email = '%s' AND haslo='%s' ",mysqli_real_escape_string($link,$login),
            //     mysqli_real_escape_string($link,$haslo));
            // echo "Returned rows are: " . mysqli_num_rows($result);
            if(mysqli_num_rows($result) == 1){  
                
                $_SESSION["zalogowany_pracownicy"]=true;
                // echo "<h1><center> Login successful ".$login."</center></h1>";
                // echo "<p>".$login."<br>";
                // echo  $pass."</p>";
                $_SESSION["login_pracownicy"]=$login;
                $_SESSION["haslo_pracownicy"]=$haslo;

                // echo $_SESSION["login_pracownicy"];
                // echo $_SESSION["haslo_pracownicy"];

                $rows = $result -> fetch_object();
                $_SESSION['imie_pracownika']=$rows->imie;
                $_SESSION['nazwisko_pracownika']=$rows->nazwisko;
                // echo $_SESSION['imie_pacownika'];
                header("Location: panellekarza.php");
                exit;
            }
            else{
                header('Location: login_lekarz.php');
	            exit;
            }
        }  
        else{  
            echo "<h1> Login failed. Invalid username or password.</h1>";  
        }     
    }
    mysqli_close($link); 
?>
  