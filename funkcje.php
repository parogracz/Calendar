<?php
function Kalendarz($week)
{
	include("dbconnect.php");
	$day=0;
	echo '<div class="row">
				<div class="col">Poniedziałek</div>
				<div class="col">Wtorek</div>
				<div class="col">Środa</div>
				<div class="col">Czwartek</div>
				<div class="col">Piątek</div>
				<div class="col">Sobota</div>
				<div class="col">Niedziela</div>
			</div>';
	for($weeks=1; $weeks<=$week; $weeks++)
	{
		echo '<div class="row col">';
		for($days=1; $days<=7; $days++)
		{
			$day++;
			$zapytanie="SELECT * FROM zadania WHERE data LIKE $day AND login LIKE '$_SESSION[login]'";
			//echo $zapytanie;
			$wynik=@mysqli_query($connect,$zapytanie);
			
			echo "<div class=\"col figure rounded overflow-auto\">$day";
			while($tablica=@mysqli_fetch_array($wynik))			
			{
				echo "<form action=\"usun.php\" method=\"POST\">";
				echo "<input name=\"id\"  class=\"d-none\" value=\"$tablica[5]\">";
				if($tablica[2]) echo "<b><a style=\"color:$tablica[4]\">$tablica[1]</a></b><input type=\"submit\" style=\"background-color:white\" class=\"btn-close\" value=\"\">";
				else echo "<a style=\"color:$tablica[4]\">$tablica[1]</a> <input type=\"submit\" style=\"background-color:white\" class=\"btn-close\" value=\"\">";
				echo "</form>";
			}
			echo"</div>";
		}
		echo '</div>';
	}
}
function Logowanie($login, $haslo)
{
	$login = rtrim($login);
	$haslo = rtrim($haslo);
	include("dbconnect.php");
	$zapytanie = "SELECT * FROM uzytkownicy WHERE login LIKE '$login' AND haslo LIKE '$haslo'";
	$wynik = mysqli_query($connect, $zapytanie);
	if(mysqli_num_rows($wynik)) 
	{
		$_SESSION['zalogowano']=true;
		$_SESSION['alert_zalogowano']=true;
		$_SESSION['login']=$login;
		header("Location: index.php");
	}
	else
	{
		$_SESSION['err_dane_log']=true;
		header("Location: index2.php");
	}
}
function Rejestracja($login, $haslo, $email)
{
	$login = rtrim($login);
	$haslo = rtrim($haslo);
	$email = rtrim($email);
	include("dbconnect.php");
	$zapytanie = "INSERT INTO uzytkownicy(login, haslo, email) VALUES ('$login','$haslo','$email')";
	if(mysqli_query($connect, $zapytanie))
	{		
		mysqli_query($connect, $zapytanie);
		$_SESSION['alert_zarejestrowano']=true;
		header("Location: index2.php");
	}
	else
	{
		$_SESSION['err_zarejestrowano']=true;
		header("Location: index3.php");
	}
}
function Wylogowanie()
{
	$_SESSION["zalogowano"]=false;
	$_SESSION["alert_wylogowano"]=true;
	header("Location: index2.php");
}
function Dodaj($nazwa, $priorytet, $dzien, $kolor)
{
	$nazwa = rtrim($nazwa);
	include("dbconnect.php");
	if($priorytet=="Zwykły")$priorytet=0;
	else $priorytet=1;
	
	$dzien =  $dzien[dzien.length-1]+$dzien[dzien.length-2]*10;
	
	$zapytanie="INSERT INTO zadania (login, nazwa, priorytet, data, kolor) VALUES ('$_SESSION[login]','$nazwa',$priorytet,$dzien,'$kolor')";
	echo $zapytanie;
	$wynik=mysqli_query($connect,$zapytanie);
	if($wynik)
	{
		header("Location: index.php");
	}
	else
	{
		$_SESSION['err_dodaj']=true;
		header("Location: index.php");
	}
}
function Usun($id)
{
	include("dbconnect.php");
	$zapytanie="DELETE FROM zadania WHERE id like $id";
	//echo $zapytanie;
	$wynik=mysqli_query($connect,$zapytanie);
	if($wynik)
	{
		header("Location: index.php");
	}
	else
	{
		$_SESSION['err_usun']=true;
		header("Location: index.php");
	}
}
function Alert_Box()
{
	if($_SESSION['err_dane_log']){echo "<center><h1>Błędne dane logowania!</h1></center>";$_SESSION['err_dane_log']=false;}
	if($_SESSION['err_zarejestrowano']){echo "<center><h1>Nie udało się utworzyć konta!</h1></center>";$_SESSION['err_zarejestrowano']=false;}
	if($_SESSION['err_dodaj']){echo "<center><h1>Błąd dodania zadania!</h1></center>";$_SESSION['err_dodaj']=false;}
	if($_SESSION['err_usun']){echo "<center><h1>Błąd usuwania zadania!</h1></center>";$_SESSION['err_usun']=false;}
	if($_SESSION['alert_zalogowano']){echo "<center><h1>Pomyślnie zalogowano! Witaj $_SESSION[login]!</h1></center>";$_SESSION['alert_zalogowano']=false;}
	if($_SESSION['alert_wylogowano']){echo "<center><h1>Pomyślnie wylogowano!</h1></center>";$_SESSION['alert_wylogowano']=false;}
	if($_SESSION['alert_zarejestrowano']){echo "<center><h1>Pomyślnie zarejestrowano!</h1></center>";$_SESSION['alert_zarejestrowano']=false;}
}
function Dane_Konta($login)
{
	include("dbconnect.php");
	$zapytanie = "SELECT * FROM uzytkownicy WHERE login LIKE '$login'";
	//echo $zapytanie;
	$wynik = mysqli_query($connect,$zapytanie);
	$tablica = mysqli_fetch_array($wynik);
	echo "<h6><b>Login:</b> $tablica[0]</h6>";
	echo "<h6><b>E-Mail:</b> $tablica[2]</h6>";
}
?>
