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
     * Start sesji */
    session_start();
    /**
     * Usunięcie sesji, wylogowanie użytkownika */
    session_unset(); 
    /**
     * Powrót do wyboru typu konta użytkownika */
    header("Location: user_select.php");

?>