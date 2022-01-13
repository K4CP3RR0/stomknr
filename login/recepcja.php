<?php
    require("con.php");
?>

<?php

    session_start();

    if((!isset($_SESSION["zalogowany_recepcja"])) && ($_SESSION["zalogowany_recepcja"]!=true)){
        header("Location: recepcja_login.php");
        exit;
    }

    echo "Dziala";


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
        $sql = "SELECT pacjenci.imie AS 'imie_pacjenta',pacjenci.nazwisko AS 'nazwisko_pacjenta',wizyta.opis AS 'opis_wizyty', wizyta.data_wizyty AS 'data_wizyty', pracownicy.imie AS 'imie_lekarza', pracownicy.nazwisko AS 'nazwisko_lekarza','wizyta.id_wizyty' FROM wizyta INNER JOIN pacjenci ON wizyta.id_pacjenta = pacjenci.id_pacjent INNER JOIN pracownicy ON wizyta.id_pracownika=pracownicy.id_pracownicy WHERE wizyta.zatwierdzone='0' ORDER BY wizyta.data_wizyty DESC;";
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
                    echo '';
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