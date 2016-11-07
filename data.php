<?php 
	require("functions.php");
	
	//MUUTUJAD
	$food = $usernameError = $username = $birthday = "";
	
	// kas on sisseloginud, kui ei ole siis
	// suunata login lehele
	if (!isset ($_SESSION["userId"])) {
		header("Location: login.php");
		exit();	
	}
	
	//LOG OUT
	if (isset($_GET["logout"])) {
		session_destroy();
		header("Location: login.php");
		exit();
	}
	
	//USERNAME
	if (isset ($_POST["username"])) {
		if (empty ($_POST["username"])) {
		$usernameError = "* Väli on kohustuslik!";
	
		} else {
		if (strlen ($_POST["username"]) >18){
		$usernameError = "* Nickname ei tohi olla pikkem kui 18!";

		} else {
		$username = $_POST ["username"];
			}
		}
	}
	
	//KONTROLLIN,ET KÕIK ON OKEI JA VÕIB SALVESTADA
	if (isset($_POST["username"])&&
		isset($_POST["food"]) &&
		!empty($_POST["username"])&&
		!empty($_POST["food"])
		)
		
	{
	register_food($username,$_POST["birthday"],$_POST["food"],$_SESSION["userId"]);
	}
	
	
	$people = All_info();

?>

<html>
<p>
<h1>Salvesta andmed enda kohta</h1>
	Tere tulemast <?=$_SESSION["email"];?>!
	<a href="?logout=1">Logi välja</a>
</p>
<style>
body {
		background-image:	url("https://pp.vk.me/c837125/v837125905/518b/bJR1ZtqBM9w.jpg");
		background-repeat: no-repeat;
		background-position: right top;
		background-attachment: fixed;
		}

</style>
<body>
<title>Registreerimise lõpp</title>


	
	<form method="POST">
	
	<p><label for="birthday">Kasutaja nimi:</label><br>
	<input name="username" type="text" placeholder="Kasutaja nimi" value=<?=$username;?>> 
	<br><font color="red"><?php echo $usernameError; ?></font>

	<p><label for="birthday">Sünnipäev:</label><br>
	<input name= "birthday" type="date" id="birthday" required>
	
	<p><label for="food">Vali oma lemmiku kööki:</label><br>
	<select name="food" id="food" required>
		<option value="">Näita</option>
		<option value="Abhaasia k">Abhaasia köök</option>
		<option value="Australian k">Australian köök</option>
		<option value="Austria k">Austria köök</option>
		<option value="Aserbaidzaani k<">Aserbaidžaani köök</option>
		<option value="Ameerika k<">Ameerika köök</option>
		<option value="Araabia k">Araabia köök</option>
		<option value="Argentiina k">Argentiina köök</option>
		<option value="Armeenia k">Armeenia köök</option>
		<option value="Valgevene k">Valgevene köök</option>
		<option value="Bulgaaria k">Bulgaaria köök</option>
		<option value="Brasiilia k">Brasiilia köök</option>
		<option value="Ungari k">Ungari köök</option>
		<option value="Havai k">Havai köök</option>
		<option value="Hollandi k">Hollandi köök</option>
		<option value="Kreeka k">Kreeka köök</option>
		<option value="Gruusia k">Gruusia köök</option>
		<option value="Taani k">Taani köök</option>
		<option value="Juudi k">Juudi köök</option>
		<option value="Iiri k">Iiri köök</option>
		<option value="India k">India köök</option>
		<option value="Inglise k">Inglise köök</option>
		<option value="Itaalia k">Itaalia köök</option>
		<option value="Hispaania k">Hispaania köök</option>
		<option value="Kaukaasia k">Kaukaasia köök</option>
		<option value="Hiina k">Hiina köök</option>
		<option value="Korea k">Korea köök</option>
		<option value="Kuuba k">Kuuba köök</option>
		<option value="Lati k">Läti köök</option>
		<option value="Leedu k">Leedu köök</option>
		<option value="Mehhiko k">Mehhiko köök</option>
		<option value="Moldaavia k">Moldaavia köök</option>
		<option value="Mongoli k">Mongoli köök</option>
		<option value="Saksa k">Saksa köök</option>
		<option value="Norra k">Norra köök</option>
		<option value="Poola k">Poola köök</option>
		<option value="Portugali k">Portugali köök</option>
		<option value="Rumeenia k">Rumeenia köök</option>
		<option value="Vene k">Vene köök</option>
		<option value="Tyrgi k">Türgi köök</option>
		<option value="Ukraina k">Ukraina köök</option>
		<option value="Soome k">Soome köök</option>
		<option value="Prantsuse k">Prantsuse köök</option>
		<option value="Tsehhi k">Tšehhi köök</option>
		<option value="Rootsi k">Rootsi köök</option>
		<option value="Soti k">Šoti köök</option>
		<option value="Eesti k">Eesti köök</option>
		<option value="Jaapani k">Jaapani köök</option>
	</select>
	
	<br><br>
	<input type="submit" style="background-color:#A1D852; color:white;" value="Salvesta andmed">
	

</form>
</body>
</html>
<h2>Table</h2>
<?php 
	
$html = "<table>";
	
		$html .= "<tr>";
			$html .= "<th>Kasutaja</th>";
			$html .= "<th>Sünniaasta</th>";
			$html .= "<th>Köök</th>";
			$html .= "<th>ID</th>";
		$html .= "</tr>";
		
		//iga liikme kohta massiivis
		foreach ($people as $p) {
			
			$html .= "<tr>";
				$html .= "<td>".$p->username."</td>";
				$html .= "<td>".$p->birthday."</td>";
				$html .= "<td>".$p->food."</td>";
				$html .= "<td>".$p->id."</td>";
			$html .= "</tr>";
		
		}
		
	$html .= "</table>";
	
	echo $html;
?>