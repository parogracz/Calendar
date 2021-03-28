<?php
SESSION_START();
include("dbconnect.php");
include("funkcje.php");
usun_konto($_SESSION['login'], $_POST['haslo'], $_POST['check']);
?>