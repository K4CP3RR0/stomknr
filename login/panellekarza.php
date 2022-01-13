<?php
  session_start();
    if(!isset($_SESSION["zalogowany_pracownicy"])){
      // echo isset($_SESSION["zalogowany_pracownicy"]);
      session_unset();
        header("Location: login_lekarz.php");
        exit;
    }
    // ini_set('display_errors', 1);
    // ini_set('display_startup_errors', 1);
    // error_reporting(E_ALL);
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Panel Lekarz</title>
        <meta charset="UTF-8">
        
        <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
        <link
            href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
            rel="stylesheet">
    
        <!-- Custom styles for this template-->
        <link href="css_panel/bootstrap.css" rel="stylesheet">
     
    </head>
    <body>
        

        <nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="">
        Stomatologia KNR
    <img src="img_panel/teeth.svg" alt="" width="30" height="24" class="d-inline-block align-text-top">    
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
      <div class="navbar-nav">
        <a class="nav-link active ">Panel lekarza</a>
        <a></a>
        <?php
        echo '<a class="navbar-brand">'.$_SESSION['imie_pracownika'].' '.$_SESSION['nazwisko_pracownika'].'</a>';
        ?>
        <a class="nav-link" href="logout.php">Wyloguj</a>
      </div>
    </div>
  </div>
</nav>
<div class="container-fluid">
    <h1 class="nav-link disabled">Historia wizyt pacjenta</h1>
    <form method="post">
    <div class="mb-3">
      <label for="imiePacjenta" class="form-label">Imię</label>
      <input type="text" class="form-control" id="imie_pacjenta_form" name="imie">
      
    </div>
    <div class="mb-3">
      <label for="nazwiskoPacjenta" class="form-label">Nazwisko</label>
      <input type="text" class="form-control" id="nazwisko_pacjenta_form" name="nazwisko">
    </div>
    
  <input type="submit" class="btn btn-primary" value="Zatwierdź"/>
</form>
<?php
    require_once('con.php');
    if ($link){
        // $imie = "John";
        // $nazwisko = "Tester";
        // echo $_SESSION['imie_pracownika'];
        // echo $_SESSION['nazwisko_pracownika'];
        // echo $_SESSION['login_pracownika'];
        $imie = $_POST['imie'];
        $nazwisko = $_POST['nazwisko'];
        // echo $imie;
        // echo $nazwisko;
        $sql = "SELECT pacjenci.imie AS 'imie_pacjenta',pacjenci.nazwisko AS 'nazwisko_pacjenta',wizyta.opis AS 'opis_wizyty', wizyta.data_wizyty AS 'data_wizyty', pracownicy.imie AS 'imie_lekarza', pracownicy.nazwisko AS 'nazwisko_lekarza' FROM wizyta INNER JOIN pacjenci ON wizyta.id_pacjenta = pacjenci.id_pacjent INNER JOIN pracownicy ON wizyta.id_pracownika=pracownicy.id_pracownicy WHERE pacjenci.imie = '".$imie."' AND pacjenci.nazwisko = '".$nazwisko."' ORDER BY wizyta.data_wizyty DESC;";
        // echo $sql;
        echo "<br>";
        $wynik = $link -> query($sql);
        if ($wynik->num_rows>0){
                echo '<table class="table table-striped table-dark">';
                echo "<tr width='100px'>";
                    echo '<th class=" table-primary">Imię pacjenta</th>';
                    echo '<th class="table-primary">Nazwisko pacjenta</th>';
                    echo '<th class="table-primary">Opis wizyty</th>';
                    echo '<th class="table-primary">Data wizyty</th>';
                    echo '<th class="table-primary">Imię lekarza</th>';
                    echo '<th class="table-primary" >Nazwisko lekarza</th>';   
                echo "</tr>";
                // echo "<table><th width='100px'><td width='100px'>Imię pacjenta</td><td width='100px'>Nazwisko pacjenta</td><td width='100px'>Opis wizyty</td><td width='100px'>Data wizyty</td><td width='100px'>Nazwisko lekarza</td><td width='100px'>Imię lekarza</td></th>";
    
            while ($rekord = $wynik -> fetch_object())
            {   
                echo "<tr>";
                    echo "<td>".$rekord -> imie_pacjenta."</td>";
                    echo "<td>".$rekord -> nazwisko_pacjenta."</td>";
                    echo "<td>".$rekord -> opis_wizyty."</td>";
                    echo "<td>".$rekord -> data_wizyty."</td>";
                    echo "<td>".$rekord -> imie_lekarza."</td>";
                    echo "<td>".$rekord -> nazwisko_lekarza."</td>";
                echo "</tr>";
                // echo "<tr width='100px'><td width='100px'>". $rekord -> imie_pacjenta ."</td><td width='100px'>". $rekord -> nazwisko_pacjenta ."</td><td width='100px'>". $rekord -> opis_wizyty ."</td><td width='100px'>". $rekord -> data_wizyty ."</td><td width='100px'>". $rekord -> imie_lekarza ."</td><td width='100px'>". $rekord -> nazwisko_lekarza ."</td></tr>";
            }
            echo "</table>";
        }
        else{
            echo "Nie ma takiego pacjenta w bazie danych<br>";
            echo  "Spróbuj wyszukać ponownie";
        }
    }
    ?>
</div>

</body>
</html>
<?php
mysqli_close($link); 
?>