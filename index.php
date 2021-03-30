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
	<body class="flex-column" onload="Zegar()">
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
			<div id="kafelek2">	
				<div id="Kalendarz">
					<?php Kalendarz(4); ?>
				</div>
			</div>
			<div id="kafelek3">
				<form class="form-inline" action="dodaj.php" method="POST">
					<input type="text" name="nazwa" class="form-control w-50 ekran" style="float:left" placeholder="Zadanie">
					<select id="inputState" name="priorytet" style="float:left" class="form-control w-25">
						<option selected>Zwykły</option>
						<option>Priorytetowy</option>
					</select>
					<input type="date" name="dzien" class="form-control datepicker w-25" value="01-01-1999">
					<input type="color" name="kolor" class="form-control datepicker w-50" value="#FFFFFF">
					<div style="clear:both"></div>
					<div class="Klawiatura user-select-none" onclick="Pisz('Q')">Q</div>
					<div class="Klawiatura user-select-none" onclick="Pisz('W')">W</div>
					<div class="Klawiatura user-select-none" onclick="Pisz('E')">E</div>
					<div class="Klawiatura user-select-none" onclick="Pisz('R')">R</div>
					<div class="Klawiatura user-select-none" onclick="Pisz('T')">T</div>
					<div class="Klawiatura user-select-none" onclick="Pisz('Y')">Y</div>
					<div class="Klawiatura user-select-none" onclick="Pisz('U')">U</div>
					<div class="Klawiatura user-select-none" onclick="Pisz('I')">I</div>
					<div class="Klawiatura user-select-none" onclick="Pisz('O')">O</div>
					<div class="Klawiatura user-select-none" onclick="Pisz('P')">P</div>
					<div class="Klawiatura user-select-none" onclick="Pisz('A')" style="clear:both">A</div>
					<div class="Klawiatura user-select-none" onclick="Pisz('S')">S</div>
					<div class="Klawiatura user-select-none" onclick="Pisz('D')">D</div>
					<div class="Klawiatura user-select-none" onclick="Pisz('F')">F</div>
					<div class="Klawiatura user-select-none" onclick="Pisz('G')">G</div>
					<div class="Klawiatura user-select-none" onclick="Pisz('H')">H</div>
					<div class="Klawiatura user-select-none" onclick="Pisz('J')">J</div>
					<div class="Klawiatura user-select-none" onclick="Pisz('K')">K</div>
					<div class="Klawiatura user-select-none" onclick="Pisz('L')">L</div>
					<div class="Klawiatura user-select-none" onclick="Pisz('Z')" style="clear:both">Z</div>
					<div class="Klawiatura user-select-none" onclick="Pisz('X')">X</div>
					<div class="Klawiatura user-select-none" onclick="Pisz('C')">C</div>
					<div class="Klawiatura user-select-none" onclick="Pisz('V')">V</div>
					<div class="Klawiatura user-select-none" onclick="Pisz('B')">B</div>
					<div class="Klawiatura user-select-none" onclick="Pisz('N')">N</div>
					<div class="Klawiatura user-select-none" onclick="Pisz('M')">M</div>
					<div class="Klawiatura user-select-none" onclick="Pisz(' ')" style="width:50%; clear:both"></div>
					<input type="submit" value="Dodaj!" class="Klawiatura align-middle user-select-none" onclick="Send()" style="width:10%"/>
				</form>
			</div>
			<div id="kafelek4">
				<div id="Err_box">
					<?php
					Alert_Box();
					?>
				</div>
			</div>
		</div>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"></script>
		<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	</body>
	
</html>