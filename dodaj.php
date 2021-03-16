<?php
	SESSION_START();
	include("funkcje.php");
	Dodaj($_POST['nazwa'],$_POST['priorytet'],$_POST['dzien'],$_POST['kolor']);
?>