<?php
    // require_once("con.php");
	// session_start();
	
	// if ((!isset($_POST['login'])) || (!isset($_POST['haslo'])))
	// {
	// 	header('Location: register.php');
	// 	exit();
	// }


	// $polaczenie = @new mysqli($link);
	
	// if ($polaczenie->connect_errno!=0)
	// {
	// 	echo "Error: ".$polaczenie->connect_errno;
	// }
	// else
	// {
	// 	$login = $_POST['InputEmail'];
	// 	$haslo = $_POST['InputPassword'];
    //     $telefon = $_POST['telefon'];
    //     $imie = $_POST['imie'];
    //     $nazwisko = $_POST["nazwisko"];
    //     $ulinum = $_POST['ulinum'];
    //     $miejscowosc = $_POST['miejscowosc'];
    //     $pesel = $_POST["pesel"];
		
	// 	$login = htmlentities($login, ENT_QUOTES, "UTF-8");
	// 	$haslo = htmlentities($haslo, ENT_QUOTES, "UTF-8");
    //     $telefon = htmlentities($telefon,ENT_QUOTES,"UTF-8");
    //     $imie = htmlentities($imie,ENT_QUOTES,"UTF-8");
    //     $nazwisko = htmlentities($nazwisko,ENT_QUOTES,"UTF-8");
    //     $ulinum = htmlentities($ulinum,ENT_QUOTES,"UTF-8");
    //     $miejscowosc = htmlentities($miejscowosc,ENT_QUOTES,"UTF-8");
    //     $pesel = htmlentities($pesel,ENT_QUOTES,"UTF-8");



    //     //"INSERT INTO `pacjenci` (`id_pacjenta`, `imie`, `nazwisko`, `pesel`, `nr_telefonu`, `miejscowosc`, `ulica i numer`, `email`, `haslo`) VALUES (NULL, "%s","%s","%s","%s",//"%s","%s","%s","%s")" 





        
	// 	if ($rezultat = @$polaczenie->query("INSERT INTO `pacjenci` (`id_pacjenta`, `imie`, `nazwisko`, `pesel`, `nr_telefonu`, `miejscowosc`, `ulica i numer`, `email`, `haslo`) VALUES (NULL, mysqli_real_escape_string($polaczenie,$imie),mysqli_real_escape_string($polaczenie,$nazwisko),mysqli_real_escape_string($polaczenie,$pesel),"mysqli_real_escape_string($polaczenie,$telefon)","mysqli_real_escape_string($polaczenie,$miejscowosc)","mysqli_real_escape_string($polaczenie,$ulinum)",mysqli_real_escape_string($polaczenie,$login),mysqli_real_escape_string($polaczenie,$haslo)")))
	// 	{
    //         echo "DZIALA";
	// 		// $ilu_userow = $rezultat->num_rows;
	// 		// if($ilu_userow>0)
	// 		// {
	// 		// 	$_SESSION['zalogowany'] = true;
				
	// 		// 	$wiersz = $rezultat->fetch_assoc();
	// 		// 	$_SESSION['id'] = $wiersz['id'];
	// 		// 	$_SESSION['user'] = $wiersz['user'];
	// 		// 	$_SESSION['email'] = $wiersz['email'];
				
	// 		// 	$rezultat->free_result();
				
	// 		// } else {
				
	// 		// 	$_SESSION['blad'] = '<span style="color:red">Nieprawidłowy login lub hasło!</span>';
	// 		// 	header('Location: index.php');
				
	// 		// }
			
	// 	}
		
	// 	$polaczenie->close();
	// }
	

?>