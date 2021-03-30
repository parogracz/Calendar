<!DOCKTYPE html>
<html lang="pl">
	<head>
		<title> Plan Twojego Dnia</title>
		<meta charset="UTF-8"/>
		<meta name="description" content="Kalendarz, aplikacja mająca na celu pomoc w planowaniu miesiąca!"/>
		<meta name="keywords" content="kalendarz, plan, dzień, pomoc, lepszy dzień, zaplanuj, organizacja, planowanie"/>
		<meta name="author" content="Daniel N" />
		<meta name="robots" content="follow"/>
		<!-- BOOTSTRAP -->
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet">
		<!-- /BOOTSTRAP -->
		<link rel="stylesheet" href="css/style.css"/>
		<script src="funkcje.js"></script>
		<?php 
			SESSION_START();
			include("funkcje.php");
			include("dbconnect.php");
			
			if(!isset($_SESSION['zalogowano'])) $_SESSION['zalogowano']=false;
			
			if(!isset($_SESSION['err_dane_log'])) $_SESSION['err_dane_log']=false;
			if(!isset($_SESSION['err_zarejestrowano'])) $_SESSION['err_zarejestrowano']=false;
			if(!isset($_SESSION['err_dodaj'])) $_SESSION['err_dodaj']=false;
			if(!isset($_SESSION['err_usun'])) $_SESSION['err_usun']=false;
			if(!isset($_SESSION['err_usunkon'])) $_SESSION['err_usunkon']=false;
			if(!isset($_SESSION['err_zmiana'])) $_SESSION['err_zmiana']=false;
			
			if(!isset($_SESSION['alert_zalogowano'])) $_SESSION['alert_zalogowano']=false;
			if(!isset($_SESSION['alert_wylogowano'])) $_SESSION['alert_wylogowano']=false;
			if(!isset($_SESSION['alert_zarejestrowano'])) $_SESSION['alert_zarejestrowano']=false;
			if(!isset($_SESSION['alert_usunieto'])) $_SESSION['alert_usunieto']=false;
			if(!isset($_SESSION['alert_zmiana'])) $_SESSION['alert_zmiana']=false;
			//if(!isset($_SESSION['zalogowano'])) $_SESSION['zalogowano']=false;
			
			if(!$_SESSION['zalogowano']) header("Location: index2.php");
		?>
	</head>
	<body onload="Zegar()">
		<div class="container-flex">
			<div id="kafelek1">
				<nav class="navbar navbar-dark navbar-expand-xl">
					<a href="index.php"><div class="navbar-brand "><img src="img/icon.png" width="70" alt="logo">Główna</div></a>
					<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#mainmenu">
						<span class="navbar-toggler-icon"> </span>
					</button>
					<div class="collapse navbar-collapse" id="mainmenu">
						<ul class="navbar-nav">
							<li class="nav-item"> 
								<a href="index4.php" class="nav-link" role="button">Dane konta</a>
							</li>
							<?php
							if($_SESSION['login']=="dnasser")
							echo 	'<li class="nav-item"> 
										<a href="index7.php" class="nav-link" role="button">Edytuj Konta</a>
									</li>';
							?>
							<li class="navbar-item"> 
								<a href="wylogowanie.php" class="nav-link" role="button">Wyloguj</a> 
							</li>
						</ul>
					</div>
				</nav>
				<div class="text-body text-center m-auto fs-1 rounded" id="clock">
				</div>
			</div>
				<div class="text-body text-center m-auto fs-1 rounded" id="clock">
				</div>
			</div>
		
			<div id="kafelek2">	
				<div class="modal-dialog">
					<div class="modal-content" style="background-color:#f3eafa">
						<div class="modal-header">
							<h3 class="modal-title">Dane Konta</h3>
						</div>
						<div class="modal-body">
							<form action="zmiana_danych.php" method="POST">
								<div style="float:left">
									<l>Nazwa użytkownika: </l><br>
									<l>Konto E-Mail: </l><br>
									<l>Hasło: </l><br>
									<l>Powtórz Hasło: </l><br>
								</div>
								<?php
									$zapytanie = "SELECT login, email FROM uzytkownicy WHERE login LIKE '$_SESSION[login]'";
									$wynik = @mysqli_query($connect, $zapytanie);
									$tab = mysqli_fetch_array($wynik);
									echo '<div style="float:left"> 
											<input type="text" class="lo" name="login" value="'.$tab[0].'"> <br>
											<input type="email" class="lo" name="mail" value="'.$tab[1].'"> <br>
											<input type="password" class="lo" name="haslo"> <br>
											<input type="password" class="lo" name="haslo2"> <br>
										</div>';
								?>
								<div style="clear:both">
									<input type="submit" value="Zapisz!" class="fadeIn third button-log">
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
			<div id="kafelek3">
			</div>
			<div id="kafelek4">
				<div id="Bot_text"> 
				<?php
					Alert_Box();
					//$_SESSION['err_zmiana'] = true;
				?>
				</div>
			</div>
		</div>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"></script>
		<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	</body>
	
</html>