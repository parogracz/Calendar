<?php
	SESSION_START();
	include("funkcje.php");
	include("dbconnect.php");
	Rejestracja($_POST['login'],$_POST['haslo'], $_POST['email']);
?>