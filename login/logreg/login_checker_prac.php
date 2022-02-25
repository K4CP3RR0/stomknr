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
        header('Location: login_lekarz.php');
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
            header('Location: login_lekarz.php');
	        exit;
        }

        /** 
         * Sprawdzenie czy dane są prawidłowe 
         */
        if ($result = mysqli_query($link, sprintf("SELECT * FROM pracownicy WHERE email = '%s' AND haslo='%s' ",mysqli_real_escape_string($link,$login),
            mysqli_real_escape_string($link,$haslo)))) {
        
                /**
	     * Jeśli dane prawidłowe ustawienie sesji i przejście do panelu lekarza
	     */
            if(mysqli_num_rows($result) == 1){  
                
                $_SESSION["zalogowany_pracownicy"]=true;
               
                $_SESSION["login_pracownicy"]=$login;
                $_SESSION["haslo_pracownicy"]=$haslo;
                $rows = $result -> fetch_object();
                $_SESSION['imie_pracownika']=$rows->imie;
                $_SESSION['nazwisko_pracownika']=$rows->nazwisko;
                 header("Location: panellekarza.php");
                exit;
            }
            /** 
             * Jeśli dane złe powrót do formularza logowania
	    */  
            else{
                header('Location: login_lekarz.php');
	            exit;
            }
        }  
        else{  
            echo "<h1> Login failed. Invalid username or password.</h1>";  
        }     
    }
    /** 
     * Zakończenie połączenia z bazą danych */
    mysqli_close($link); 
?>
  