<?php
    session_start();
    if(!isset($_SESSION["zalogowany"])){
      // echo isset($_SESSION["zalogowany"]);
      session_unset();
        header("Location: login.php");
        exit;
    }
    
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    require_once('con.php');
    // echo $_SESSION['imie'];
    // echo $_SESSION['id'];
    // echo $_SESSION['']
    $sql = "INSERT INTO wizyta(data_wizyty,id_pacjenta,id_pracownika,id_zabiegu) VALUES('".$_POST['calendar']."',".$_SESSION['id'].",".$_POST['pracownik'].",".$_POST['rodzaj'].");";
    // echo $sql;
    // echo $_POST['calendar'];
    $result = $link -> query($sql);
    header("Location: panelpacjenta.php");
    exit;
?>