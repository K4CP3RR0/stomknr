<?php
require_once('conn.php');
if ($link){
    if((!isset($_POST['imie_pacjenta'])) || (!isset($_POST['nazwisko_pacjenta'])) || ($_POST['nazwisko_pacjenta']=="") || ($_POST['imie_pacjenta'])==""){
        header("Location: index.php");
        exit();
    }
    $imie = $_POST['imie_pacjenta'];
    $nazwisko = $_POST['nazwisko_pacjenta'];
    $sql = "SELECT pacjenci.imie AS 'imie_pacjenta',pacjenci.nazwisko AS 'nazwisko_pacjenta',wizyta.opis AS 'opis_wizyty', wizyta.data_wizyty AS 'data_wizyty', pracownicy.imie AS 'imie_lekarza', pracownicy.nazwisko AS 'nazwisko_lekarza' FROM historia_wizyt INNER JOIN wizyta ON historia_wizyt.id_wizyty = wizyta.id_wizyty INNER JOIN pacjenci ON historia_wizyt.id_pacjent = pacjenci.id_pacjent INNER JOIN pracownicy ON historia_wizyt.id_pracownicy=pracownicy.id_pracownicy WHERE pacjenci.imie='$imie'      AND pacjenci.nazwisko='$nazwisko';";
    $wynik = $link -> query($sql);
    if ($wynik->num_rows>0){
            echo "<table>";
            echo "<tr width='100px'>";
                echo "<th width='100px'>Imię pacjenta</th>";
                echo "<th width='100px'>Nazwisko pacjenta</th>";
                echo "<th width='100px'>Opis wizyty</th>";
                echo "<th width='100px'>Data wizyty</th>";
                echo "<th width='100px'>Imię lekarza</th>";
                echo "<th width='100px'>Nazwisko lekarza</th>";   
            echo "</tr>";
            // echo "<table><th width='100px'><td width='100px'>Imię pacjenta</td><td width='100px'>Nazwisko pacjenta</td><td width='100px'>Opis wizyty</td><td width='100px'>Data wizyty</td><td width='100px'>Nazwisko lekarza</td><td width='100px'>Imię lekarza</td></th>";

        while ($rekord = $wynik -> fetch_object())
        {   
            echo "<tr>";
                echo "<th>".$rekord -> imie_pacjenta."</th>";
                echo "<th>".$rekord -> nazwisko_pacjenta."</th>";
                echo "<th>".$rekord -> opis_wizyty."</th>";
                echo "<th>".$rekord -> data_wizyty."</th>";
                echo "<th>".$rekord -> imie_lekarza."</th>";
                echo "<th>".$rekord -> nazwisko_lekarza."</th>";
            echo "</tr>";
            // echo "<tr width='100px'><td width='100px'>". $rekord -> imie_pacjenta ."</td><td width='100px'>". $rekord -> nazwisko_pacjenta ."</td><td width='100px'>". $rekord -> opis_wizyty ."</td><td width='100px'>". $rekord -> data_wizyty ."</td><td width='100px'>". $rekord -> imie_lekarza ."</td><td width='100px'>". $rekord -> nazwisko_lekarza ."</td></tr>";
        }
        echo "</table>";
    }
    else{
        echo "Nie ma takiego pacjenta w bazie danych<br>";
        echo "<a href='index.php'>Powrót</a>";
    }
}
?>