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
    * Start sesji oraz */
    session_start();
    /** 
     * Komendy do pokazywania błędów */
    //ini_set('display_errors', 1);
    //ini_set('display_startup_errors', 1);
    //error_reporting(E_ALL);
    
    /**
     * Sprawdzenie czy pola logowania są poprawne, w przeciwnym przypadku odświeżenie strony logowania
     */
    if((!isset($_POST['InputPassword'])) || (!isset($_POST['InputEmail'])) || $_POST['InputPassword']=="" || $_POST['InputEmail']==""){
        header('Location: login.php');
        exit;
    }
    else{
        /** 
         * Dołączenie pliku łączącego z bazą danych */
        require_once("con.php");
        /** 
         * Pobranie wartości pól logowania i hasła */
        $login = $_POST['InputEmail'];
        $haslo = $_POST['InputPassword'];
        $login = htmlentities($login, ENT_QUOTES, "UTF-8");
        $haslo = htmlentities($haslo, ENT_QUOTES, "UTF-8");
        /**
         * Jeśli błędne połączenie z bazą, odświeżenie panelu logowania
         */
        if(!$link){
            echo "Error";
            header('Location: login.php');
	        exit;
        }
        if ($result = mysqli_query($link, sprintf("SELECT * FROM pacjenci WHERE email = '%s' AND haslo='%s' ",mysqli_real_escape_string($link,$login),
            mysqli_real_escape_string($link,$haslo)))) {
	    /**
	     * Jeśli dane prawidłowe ustawienie sesji i przejście do panelu pacjenta
	     */
            if(mysqli_num_rows($result) == 1){  
                $_SESSION["zalogowany"]=true;
                $_SESSION["login"]=$login;
                $_SESSION["haslo"]=$haslo;
                $rows = $result -> fetch_object();
                $_SESSION['id']=$rows->id_pacjent;
                $_SESSION['imie']=$rows->imie;
                $_SESSION['nazwisko']=$rows->nazwisko;
                
                header("Location: panelpacjenta.php");
                exit;
	    }
	    /** 
         * Jeśli dane złe powrót do formularza logowania
	    */  
            else{  
                header('Location: login.php');
                exit;
            }
        }
    }
    /** 
     * Zakończenie połączenia z bazą danych */
    mysqli_close($link); 
?>
  
