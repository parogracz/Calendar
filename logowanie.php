<?php
	SESSION_START();
	include("funkcje.php");
	include("dbconnect.php");
	Logowanie($_POST['login'],$_POST['haslo']);
?>