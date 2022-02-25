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
 * Sprawdzenie czy pola są poprawne */
if ((!isset($_POST['InputPassword'])) || (!isset($_POST['InputEmail'])) || (!isset($_POST['telefon'])) || (!isset($_POST['imie'])) || (!isset($_POST['nazwisko'])) || (!isset($_POST['ulinum'])) || (!isset($_POST['miejscowosc'])) || (!isset($_POST['pesel'])) || $_POST['InputPassword']=="" || $_POST['InputEmail']=="" || $_POST['telefon']=="" || $_POST['imie']=="" || $_POST['nazwisko']=="" || $_POST['ulinum']=="" || $_POST['miejscowosc']=="" || $_POST['pesel']=="" || $_POST['haslo2']=="" || (!isset($_POST['haslo2']))){
	header('Location: register.php');
	exit;
}
/** 
* Pobranie wartości pól logowania i hasła */
$login = $_POST['InputEmail'];
$haslo = $_POST['InputPassword'];
$telefon = $_POST['telefon'];
$imie = $_POST['imie'];
$nazwisko = $_POST["nazwisko"];
$ulinum = $_POST['ulinum']; 
$miejscowosc = $_POST['miejscowosc'];
$pesel = $_POST["pesel"];
$haslo2 = $_POST['haslo2'];
$login = htmlentities($login, ENT_QUOTES, "UTF-8");
$haslo = htmlentities($haslo, ENT_QUOTES, "UTF-8");
$telefon = htmlentities($telefon,ENT_QUOTES,"UTF-8");
$imie = htmlentities($imie,ENT_QUOTES,"UTF-8");
$nazwisko = htmlentities($nazwisko,ENT_QUOTES,"UTF-8");
$ulinum = htmlentities($ulinum,ENT_QUOTES,"UTF-8");
$miejscowosc = htmlentities($miejscowosc,ENT_QUOTES,"UTF-8");
$pesel = htmlentities($pesel,ENT_QUOTES,"UTF-8");
$haslo2 = htmlentities($haslo2,ENT_QUOTES,"UTF-8");

/**
 * Sprawdzenie czy oba hasła są takie same, w przeciwnym razie odświeżenie panelu rejestracji
 */
if ($haslo2!=$haslo){
    header('Location: register.php');
	exit;
}
/**
 * Sprawdzenie czy pesel ma 11 cyfr, w przeciwnym razie odświeżenie panelu rejestracji
 */
if(strlen($pesel)!=11){
    header("Location: register.php");
    exit;
}
/**
 * Sprawdzenie czy telefon ma 9 cyfr, w przeciwnym razie odświeżenie panelu rejestracji
 */
if (strlen($telefon)!=9){
    header("Location: register.php");
    exit;
}

/**
 * Dołaczenie pliku łączącego z bazą danych
 */
require_once("con.php");


/**
* Jeśli błędne połączenie z bazą, odświeżenie panelu logowania */
if(!$link){
    header('Location: register.php');
    exit;
}
else{
    /**
     * Sprawdzenie czy istnieje osoba z podanym w formularzu jeśli nie przejście dalej do sprawdzania
     */
    $sql = sprintf("SELECT pesel FROM pacjenci WHERE pesel='%s'",mysqli_real_escape_string($link,$pesel));
    $result = mysqli_query($link,$sql);
    if (mysqli_num_rows($result) >=1){
        header("Location: register.php");
        exit;
    }
    /** 
     * Sprawdzenie czy istnieje osoba z podanym loginem, jeśli nie przejście dalej*/
    $sql = sprintf("SELECT login FROM pacjenci WHERE login='%s'",mysqli_real_escape_string($link,$login));
    $result = mysqli_query($link,$sql);
    if (mysqli_num_rows($result) >=1){
        header("Location: register.php");
        exit;
    }
    /**
     * Dodanie użytkownika do bazy danych, aby umożliwić mu logowanie poprzez panel pacjenta
     */
    $sql = sprintf("INSERT INTO pacjenci (imie,nazwisko,pesel,nr_telefonu,miejscowosc,ulica_i_numer,email,haslo) VALUES ('%s','%s','%s','%s','%s','%s','%s','%s')",
    mysqli_real_escape_string($link,$imie),
    mysqli_real_escape_string($link,$nazwisko),
    mysqli_real_escape_string($link,$pesel),
    mysqli_real_escape_string($link,$telefon),
    mysqli_real_escape_string($link,$miejscowosc),
    mysqli_real_escape_string($link,$ulinum),
    mysqli_real_escape_string($link,$login),
    mysqli_real_escape_string($link,$haslo));
    $result = mysqli_query($link,$sql);
   
    /** 
     * Jeśli rejestracja poprawna przeniesienie do panelu logowania */
    if ($result) {
        header('Location: login.php');
        exit;
    } 
    /** 
     * W przeciwnym razie ponowna rejestracja */
    else{
        header("Location: register.php");
        exit;
    }
    /** 
     * Zakończenie połączenia z bazą danych
     */
    mysqli_close($link);    
}
?>