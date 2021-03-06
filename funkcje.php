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
	if($_SESSION['err_dane_log']){echo "<center><h1 class=\"alert alert-danger\">Błędne dane logowania!</h1></center>";$_SESSION['err_dane_log']=false;}
	if($_SESSION['err_zarejestrowano']){echo "<center><h1 class=\"alert alert-danger\">Nie udało się utworzyć konta!</h1></center>";$_SESSION['err_zarejestrowano']=false;}
	if($_SESSION['err_dodaj']){echo "<center><h1 class=\"alert alert-danger\">Błąd dodania zadania!</h1></center>";$_SESSION['err_dodaj']=false;}
	if($_SESSION['err_usun']){echo "<center><h1 class=\"alert alert-danger\">Błąd usuwania zadania!</h1></center>";$_SESSION['err_usun']=false;}
	if($_SESSION['err_usunkon']){echo "<center><h1 class=\"alert alert-danger\">Błąd usuwania konta!</h1></center>";$_SESSION['err_usunkon']=false;}
	if($_SESSION['err_zmiana']){echo "<center><h1 class=\"alert alert-danger\">Błąd zmiany danych konta!</h1></center>";$_SESSION['err_zmiana']=false;}
	if($_SESSION['alert_zalogowano']){echo "<center><h1 class=\"alert alert-success\">Pomyślnie zalogowano! Witaj $_SESSION[login]!</h1></center>";$_SESSION['alert_zalogowano']=false;}
	if($_SESSION['alert_wylogowano']){echo "<center><h1 class=\"alert alert-success\">Pomyślnie wylogowano!</h1></center>";$_SESSION['alert_wylogowano']=false;}
	if($_SESSION['alert_zarejestrowano']){echo "<center><h1 class=\"alert alert-success\">Pomyślnie zarejestrowano!</h1></center>";$_SESSION['alert_zarejestrowano']=false;}
	if($_SESSION['alert_usunieto']){echo "<center><h1 class=\"alert alert-success\">Pomyślnie usunięto konto!</h1></center>";$_SESSION['alert_usunieto']=false;}
	if($_SESSION['alert_zmiana']){echo "<center><h1 class=\"alert alert-success\">Pomyślnie zmieniono dane konta!</h1></center>";$_SESSION['alert_zmiana']=false;}
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
function Usun_Konto($login, $haslo, $check)
{
	include("dbconnect.php");
	$zapytanie = "SELECT haslo FROM uzytkownicy WHERE `login` LIKE '$login'";
	//echo $zapytanie;
	$wynik = mysqli_query($connect,$zapytanie);
	$tab = mysqli_fetch_array($wynik);
	echo $tab[0];
	echo $check;
	
	if($haslo == $tab[0] && $check == "on")
	{
		$zapytanie = "DELETE FROM uzytkownicy WHERE login LIKE '$login'";
		$wynik = mysqli_query($connect,$zapytanie);
		$_SESSION['alert_usunieto'] = true;
		$_SESSION['zalogowano']=false;
		header("Location: index2.php");
	}
	else
	{
		$_SESSION['err_usunkon'] = true;
		header("Location: index6.php");
	}
}
function Zmiana_Danych($login, $mail, $haslo, $haslo2)
{
	include("dbconnect.php");
	SESSION_START();
	$zapytanie = "SELECT * FROM uzytkownicy WHERE login LIKE '$login' OR email LIKE '$mail'";
	$wynik = mysqli_query($connect, $zapytanie);
	if((mysqli_num_rows($wynik) > 0 && $_SESSION['login']!=$login) || $haslo != $haslo2) 
	{
		$_SESSION['err_zmiana'] = true;
		header("Location: index5.php");
	}
	else
	{
		$zapytanie = "UPDATE uzytkownicy SET login = '$login', haslo = '$haslo', email = '$mail' WHERE login = '$_SESSION[login]' ";
		mysqli_query($connect, $zapytanie);
		$_SESSION['alert_zmiana'] = true;
		$_SESSION['zalogowano'] = false;
		header("Location: index2.php");
	}
}
function Rejestr_Kont()
{
	include("dbconnect.php");
	$zapytanie = "SELECT * FROM uzytkownicy";
	$wynik = mysqli_query($connect, $zapytanie);
	echo '<center><table>';
		echo '<tr style="background-color:MediumOrchid">';
		echo "<td>Login</td> <td>Hasło</td> <td>EMail</td> ";
		echo '</tr>';
	while($tab = mysqli_fetch_array($wynik))
	{
		echo '<tr style="background-color:Linen">';
		echo "<td style=\"border:solid 1px black\">$tab[0]</td> <td style=\"border:solid 1px black\">$tab[1]</td> <td style=\"border:solid 1px black\">$tab[2]</td> ";
		echo '</tr>';
	}
	echo '</table></center>';
}
?>
