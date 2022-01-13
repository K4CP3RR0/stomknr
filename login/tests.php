<?php
	session_start();
    
    require_once("con.php");
    $polaczenie = $link;
    echo $polaczenie;
	
	if ((!isset($_POST['InputPassword'])) || (!isset($_POST['InputEmail'])) || (!isset($_POST['telefon'])) || (!isset($_POST['imie'])) || (!isset($_POST['nazwisko'])) || (!isset($_POST['ulinum'])) || (!isset($_POST['miejscowosc'])) || (!isset($_POST['pesel'])) || $_POST['InputPassword']=="" || $_POST['InputEmail']=="" || $_POST['telefon']=="" || $_POST['imie']=="" || $_POST['nazwisko']=="" || $_POST['ulinum']=="" || $_POST['miejscowosc']=="" || $_POST['pesel']=="" || $_POST['haslo2']=="" || (!isset($_POST['haslo2'])))
	{
		header('Location: register.html');
		exit;
	}


	// $polaczenie = @new mysqli("localhost","root","","stomatologiaknr");
	
	if ($polaczenie->connect_errno!=0)
	{
		echo "Error: ".$polaczenie->connect_errno;
	}
	else
	{
		$login = $_POST['InputEmail'];
		$haslo = $_POST['InputPassword'];
        $telefon = $_POST['telefon'];
        $imie = $_POST['imie'];
        $nazwisko = $_POST["nazwisko"];
        $ulinum = $_POST['ulinum']; 
        $miejscowosc = $_POST['miejscowosc'];
        $pesel = $_POST["pesel"];
		$haslo2 = $_POST['haslo2'];

		/*
		$login = htmlentities($login, ENT_QUOTES, "UTF-8");
		$haslo = htmlentities($haslo, ENT_QUOTES, "UTF-8");
        $telefon = htmlentities($telefon,ENT_QUOTES,"UTF-8");
        $imie = htmlentities($imie,ENT_QUOTES,"UTF-8");
        $nazwisko = htmlentities($nazwisko,ENT_QUOTES,"UTF-8");
        $ulinum = htmlentities($ulinum,ENT_QUOTES,"UTF-8");
        $miejscowosc = htmlentities($miejscowosc,ENT_QUOTES,"UTF-8");
        $pesel = htmlentities($pesel,ENT_QUOTES,"UTF-8");

	
        */
        $zapytanie = sprintf("INSERT INTO pacjenci (id_pacjenta,imie,nazwisko,pesel,nr_telefonu,miejscowosc,ulica_i_numer,email,haslo) VALUES ('','%s','%s','%s','%s','%s','%s','%s','%s')",
        mysqli_real_escape_string($polaczenie,$imie),
        mysqli_real_escape_string($polaczenie,$nazwisko),
        mysqli_real_escape_string($polaczenie,$pesel),
        mysqli_real_escape_string($polaczenie,$telefon),
        mysqli_real_escape_string($polaczenie,$miejscowosc),
        mysqli_real_escape_string($polaczenie,$ulinum),
        mysqli_real_escape_string($polaczenie,$login),
        mysqli_real_escape_string($polaczenie,$haslo));
        // $zapytanie = "INSERT INTO pacjenci (id_pacjenta,imie,nazwisko,pesel,nr_telefonu,miejscowosc,ulica_i_numer,email,haslo) VALUES (NULL,'$imie','$nazwisko','$pesel','$telefon','$miejscowosc','$ulinum','$login','$haslo')";
		echo $zapytanie;
        $rezultat = mysqli_query($polaczenie,$zapytanie);
        echo mysqli_num_rows($rezultat);
        echo $rezultat;
		if ($rezultat)
		{
            echo "DZIALA";
			// $ilu_userow = $rezultat->num_rows;
			// if($ilu_userow>0)
			// {
			// 	$_SESSION['zalogowany'] = true;
				
			// 	$wiersz = $rezultat->fetch_assoc();
			// 	$_SESSION['id'] = $wiersz['id'];
			// 	$_SESSION['user'] = $wiersz['user'];
			// 	$_SESSION['email'] = $wiersz['email'];
				
			// 	$rezultat->free_result();
				
			// } else {
				
			// 	$_SESSION['blad'] = '<span style="color:red">Nieprawidłowy login lub hasło!</span>';
			// 	header('Location: index.php');
				
			// }
			
		}
		$polaczenie->close();
		session_destroy();
	}
?>

