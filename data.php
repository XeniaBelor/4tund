
<?php 
	require("functions.php");
	$food = $NicknameError = $Nickname = "";
	// kas on sisseloginud, kui ei ole siis
	// suunata login lehele
	if (!isset ($_SESSION["userId"])) {
		
		header("Location: login.php");
		exit();
		
	}
	
	//kas ?logout on aadressireal
	if (isset($_GET["logout"])) {
		
		session_destroy();
		
		header("Location: login.php");
		exit();
	}
	
	if (isset ($_POST["Nickname"])) {
		if (empty ($_POST["Nickname"])) {
			$NicknameError = "* Väli on kohustuslik!";
		
		} else {
			
		if (strlen ($_POST["Nickname"]) >18){
		$NicknameError = "* Nickname ei tohi olla pikkem kui 18!";
	
		} else {
			$Nickname = $_POST ["Nickname"];
			}
		}
	}
	
	
	if (isset($_POST["food"])&&
		!empty($_POST["food"])
		)
		
	{
	register_food($Nickname,$_POST["food"],$_SESSION["userId"]);
	}

?>

<h1>Data</h1>
<p>
	Tere tulemast <?=$_SESSION["userId"];?>!
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
<form method="POST">

	<input name="Nickname" type="text" placeholder="Nickname"> 
	<br><font color="red"><?php echo $NicknameError; ?></font></br>

	<p><label for="food">Vali oma lemmiku kööki:</label><br>
	<select name="food" id="food" required>
		<option value="">Näita</option>
		<option value="Abhaasia köök">Abhaasia köök</option>
		<option value="Australian köök">Australian köök</option>
		<option value="Austria köök">Austria köök</option>
		<option value="Aserbaidžaani köök<">Aserbaidžaani köök</option>
		<option value="Ameerika köök<">Ameerika köök</option>
		<option value="Araabia köök">Araabia köök</option>
		<option value="Argentiina köök">Argentiina köök</option>
		<option value="Armeenia köök">Armeenia köök</option>
		<option value="Valgevene köök">Valgevene köök</option>
		<option value="Bulgaaria köök">Bulgaaria köök</option>
		<option value="Brasiilia köök">Brasiilia köök</option>
		<option value="Ungari köök">Ungari köök</option>
		<option value="Havai köök">Havai köök</option>
		<option value="Hollandi köök">Hollandi köök</option>
		<option value="Kreeka köök">Kreeka köök</option>
		<option value="Gruusia köök">Gruusia köök</option>
		<option value="Taani köök">Taani köök</option>
		<option value="Juudi köök">Juudi köök</option>
		<option value="Iiri köök">Iiri köök</option>
		<option value="India köök">India köök</option>
		<option value="Inglise köök">Inglise köök</option>
		<option value="Itaalia köök">Itaalia köök</option>
		<option value="Hispaania köök">Hispaania köök</option>
		<option value="Kaukaasia köök">Kaukaasia köök</option>
		<option value="Hiina köök">Hiina köök</option>
		<option value="Korea köök">Korea köök</option>
		<option value="Kuuba köök">Kuuba köök</option>
		<option value="Läti köök">Läti köök</option>
		<option value="Leedu köök">Leedu köök</option>
		<option value="Mehhiko köök">Mehhiko köök</option>
		<option value="Moldaavia köök">Moldaavia köök</option>
		<option value="Mongoli köök">Mongoli köök</option>
		<option value="Saksa köök">Saksa köök</option>
		<option value="Norra köök">Norra köök</option>
		<option value="Poola köök">Poola köök</option>
		<option value="Portugali köök">Portugali köök</option>
		<option value="Rumeenia köök">Rumeenia köök</option>
		<option value="Vene köök">Vene köök</option>
		<option value="Türgi köök">Türgi köök</option>
		<option value="Ukraina köök">Ukraina köök</option>
		<option value="Soome köök">Soome köök</option>
		<option value="Prantsuse köök">Prantsuse köök</option>
		<option value="Tšehhi köök">Tšehhi köök</option>
		<option value="Rootsi köök">Rootsi köök</option>
		<option value="Šoti köök">Šoti köök</option>
		<option value="Eesti köök">Eesti köök</option>
		<option value="Jaapani köök">Jaapani köök</option>
	</select>
	
	
	<input type="submit" style="background-color:#A1D852; color:white;" value="Loo kasutaja">
	

</form>
</body>

<h2>Table</h2>
<?php 
	
	$html = "<table>";
		$html .= "<tr>";
			$html .= "<th>id</th>";
			$html .= "<th>country</th>";
			$html .= "<th>food</th>";
			$html .= "<th>created</th>";
		$html .= "</tr>";
?>