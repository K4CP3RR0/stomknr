<?php
  session_start();
    if(!isset($_SESSION["zalogowany"])){
      // echo isset($_SESSION["zalogowany"]);
      session_unset();
        header("Location: login.php");
        exit;
    }
    // ini_set('display_errors', 1);
    // ini_set('display_startup_errors', 1);
    // error_reporting(E_ALL);
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Panel Pacjenta</title>
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
        <a class="nav-link active ">Panel pacjenta</a>
        <a></a>
        <?php
        echo '<a class="navbar-brand">'.$_SESSION['imie'].' '.$_SESSION['nazwisko'].'</a>';
        ?>
        <a class="nav-link" href="logout.php">Wyloguj</a>
      </div>
    </div>
  </div>
</nav>
<div class="container-fluid">
    <h1 class="nav-link disabled">Historia wizyt</h1>
   <?php
    require_once('con.php');
    if ($link){
        
        // $imie = "John";
        // $nazwisko = "Tester";
        // echo $_SESSION['imie'];
        // echo $_SESSION['nazwisko'];
        $imie = $_SESSION['imie'];
        $nazwisko = $_SESSION['nazwisko'];
        $sql = "SELECT pacjenci.imie AS 'imie_pacjenta',pacjenci.nazwisko AS 'nazwisko_pacjenta',wizyta.opis AS 'opis_wizyty', wizyta.data_wizyty AS 'data_wizyty', pracownicy.imie AS 'imie_lekarza', pracownicy.nazwisko AS 'nazwisko_lekarza' FROM wizyta INNER JOIN pacjenci ON wizyta.id_pacjenta = pacjenci.id_pacjent INNER JOIN pracownicy ON wizyta.id_pracownika=pracownicy.id_pracownicy WHERE pacjenci.id_pacjent = ".$_SESSION['id']." AND wizyta.data_wizyty<CURRENT_DATE ORDER BY wizyta.data_wizyty DESC";
        // echo $_SESSION['id'];
        // echo $imie.$nazwisko;
        // echo $sql;
        $wynik = $link -> query($sql);
        if ($wynik->num_rows>=0){
                echo '<table class="table table-striped" >';
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
            echo "<a href='login.php'>Powrót</a>";
        }
    }
    ?>
    <h1 class="nav-link disabled">Przyszłe wizyty</h1>
   <?php
    require_once('con.php');
    if ($link){
        
        // $imie = "John";
        // $nazwisko = "Tester";
        // echo $_SESSION['imie'];
        // echo $_SESSION['nazwisko'];
        $imie = $_SESSION['imie'];
        $nazwisko = $_SESSION['nazwisko'];
        $sql = "SELECT pacjenci.imie AS 'imie_pacjenta',pacjenci.nazwisko AS 'nazwisko_pacjenta',wizyta.opis AS 'opis_wizyty', wizyta.data_wizyty AS 'data_wizyty', pracownicy.imie AS 'imie_lekarza', pracownicy.nazwisko AS 'nazwisko_lekarza' FROM wizyta INNER JOIN pacjenci ON wizyta.id_pacjenta = pacjenci.id_pacjent INNER JOIN pracownicy ON wizyta.id_pracownika=pracownicy.id_pracownicy WHERE pacjenci.id_pacjent = ".$_SESSION['id']." AND wizyta.data_wizyty>CURRENT_DATE ORDER BY wizyta.data_wizyty ASC";
        // echo $_SESSION['id'];
        // echo $imie.$nazwisko;
        // echo $sql;
        $wynik = $link -> query($sql);
        if ($wynik->num_rows>=0){
                echo '<table class="table table-striped" >';
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
            echo "<a href='login.php'>Powrót</a>";
        }
    }
    ?>
    <h1 class="nav-link disabled">Rejestracja wizyt</h1>
    <form class="row g-3" method="post" action="insert_wizyta.php">
  <div class="col-md-4">
    <label for="validationServer02" class="form-label">Imię i nazwisko pacjenta</label>
    <input type="text" class="form-control" id="validationServer01"  value="<?php echo"$imie $nazwisko" ?>" readonly>
    
  </div>
  <div class="col-md-4">
    <label for="validationServer02" class="form-label">Wybierz rodzaj zabiegu</label>
   
    <select class="form-select" aria-label="Default select example" name="rodzaj">
      <option selected>Zabieg:</option>
      <option value="1">Usuwanie zęba - 100zł</option>
      <option value="2">Borowanie - 50zł</option>
      <option value="3">Znieczulenie - 100zł</option>
      <option value="4">Plombowanie - 50zł</option>
    </select>
  </div>

  <div class="col-md-4">
    <label for="validationServer02" class="form-label">Wybierz swojego ukochanego lekarza <3</label>
    <select class="form-select" aria-label="Default select example" name="pracownik">
      <option selected>Lekarz:</option>
      <?php
        $lekarz_sql="SELECT id_pracownicy,imie,nazwisko FROM `pracownicy`;";
        $lekarz_wynik = $link -> query($lekarz_sql);
        while ($rekord = $lekarz_wynik -> fetch_object())
        {   
            echo"<option value=".$rekord -> id_pracownicy.">".$rekord ->  imie." ".$rekord -> nazwisko."</option>";
        }
      ?>
    </select>
  </div>
  <div class="col-md-6">
  </div>
    <div id="date-picker-example" class="md-form md-outline input-with-post-icon datepicker">
    <input placeholder="Select date" type="date"  name="calendar" class="form-control" id="calendar" pattern="">
   
    
    
    
  </div>
  <div class="col-12">
    <input class="btn btn-primary alert-primary" type="submit" value="Zarejestruj się"/>
  </div>
  </div>
  
   
</form>
    
</div>

</body>
</html>
<?php
mysqli_close($link); 
?>