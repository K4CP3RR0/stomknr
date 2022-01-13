<?php
if ((!isset($_POST['InputPassword'])) || (!isset($_POST['InputEmail'])) || (!isset($_POST['telefon'])) || (!isset($_POST['imie'])) || (!isset($_POST['nazwisko'])) || (!isset($_POST['ulinum'])) || (!isset($_POST['miejscowosc'])) || (!isset($_POST['pesel'])) || $_POST['InputPassword']=="" || $_POST['InputEmail']=="" || $_POST['telefon']=="" || $_POST['imie']=="" || $_POST['nazwisko']=="" || $_POST['ulinum']=="" || $_POST['miejscowosc']=="" || $_POST['pesel']=="" || $_POST['haslo2']=="" || (!isset($_POST['haslo2']))){
	header('Location: register.php');
	exit;
}

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
if ($haslo2!=$haslo){
    header('Location: register.php');
	exit;
}

if(strlen($pesel)!=11){
    header("Location: register.php");
    exit;
}

if (strlen($telefon)!=9){
    header("Location: register.php");
    exit;
}


require_once("con.php");



if(!$link){
    header('Location: register.php');
    exit;
}
else{

    $sql = sprintf("SELECT pesel FROM pacjenci WHERE pesel='%s'",mysqli_real_escape_string($link,$pesel));
    $result = mysqli_query($link,$sql);
    if (mysqli_num_rows($result) >=1){
        header("Location: register.php");
        exit;
    }

    $sql = sprintf("SELECT login FROM pacjenci WHERE pesel='%s'",mysqli_real_escape_string($link,$login));
    $result = mysqli_query($link,$sql);
    if (mysqli_num_rows($result) >=1){
        header("Location: register.php");
        exit;
    }




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
    // echo $sql;
    // echo $result;

    if ($result) {
        header('Location: login.php');
        exit;
    }  
    else{
        header("Location: register.php");
        exit;
    }

    mysqli_close($link);    
}
?>