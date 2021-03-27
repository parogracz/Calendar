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
							<?php
								Dane_Konta($_SESSION['login']);
							?>
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
				?>
				</div>
			</div>
		</div>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"></script>
		<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	</body>
	
</html>