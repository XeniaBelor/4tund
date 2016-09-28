<?php
	//v�tab ja kopeerib faili sisu
	
	require ("../../config.php");
	require("functions.php");
	
	//echo hash("sha512", "b");
	//Loogimine sisse muutujad
	
	$loginEmailError = $loginPasswordError = "";
	$loginEmail = "";
	
	//loomine muutujad
	$signupEmailError = $signupEmail = $signupPasswordError = $signupNickNameError = $signupSugu = "";
	
	//Loogimine sisse
	if (isset ($_POST["loginEmail"])) {
		if (empty ($_POST["loginEmail"])) {
			$loginEmailError = "* V�li on kohustuslik!";
		
	} else {
		//kui Email on korras
		$loginEmail = $_POST ["loginEmail"];
		
		}
	}
	
	if (isset ($_POST["loginPassword"])) {
		if (empty ($_POST["loginPassword"])) {
			$loginPasswordError = "* V�li on kohustuslik!";
		} else {
			
		}if (strlen ($_POST["loginPassword"]) <8)
			$loginPasswordError = "* Parool peab olema v�hemalt 8 t�hem�rkki pikk!";
	}
	
	//Kasutaja registreerimine
	
	
	if (isset ($_POST["signupEmail"])) {
		if (empty ($_POST["signupEmail"])) {
			$signupEmailError = "* V�li on kohustuslik!";
		} else {
		//kui Email on korras
		$signupEmail = $_POST ["signupEmail"];
		
		}
	}
	
	
	if (isset ($_POST["signupPassword"])) {
		if (empty ($_POST["signupPassword"])) {
			$signupPasswordError = "* V�li on kohustuslik!";
		} else {
			
		}if (strlen ($_POST["signupPassword"]) <8)
			$signupPasswordError = "* Parool peab olema v�hemalt 8 t�hem�rkki pikk!";
	}
	
	
	if (isset ($_POST["signupNickName"])) {
		if (empty ($_POST["signupNickName"])) {
			$signupNickNameError = "* V�li on kohustuslik!";
		} else {
			
			}if (strlen ($_POST["signupNickName"]) <8)
				$signupNickNameError = "* Nimi peab olema v�hemalt 8 t�hem�rkki pikk!";
	}
	
	// Kui pole �htegi viga
	if( isset($_POST["signupEmail"]) &&
		isset($_POST["signupPassword"]) &&
		$signupEmailError == "" &&		
		empty($signupPasswordError)
		)
		
		{	
			echo "Salvestan...<br>";
			
			echo "email: ".$signupEmail."<br>";
			echo "password: ".$_POST["signupPassword"]."<br>";
			
			$password = hash("sha512", $_POST["signupPassword"]);
			echo "password hashed: ".$password."<br>";
			
			//�HENDUS
			
			$database = "if16_ksenbelo_4";
			$mysqli = new mysqli($serverHost, $serverUsername, $serverPassword, $database);
			
			if ($mysqli->connect_error) {
			die('Connect Error: ' . $mysqli->connect_error);
			}
			
			//sqli rida
			$stmt = $mysqli->prepare("INSERT INTO user_sample (email, password) VALUES (?, ?)");
			
			echo $mysqli->error;
			
			$stmt->bind_param("ss", $signupEmail, $password);
			
				if($stmt->execute()) {
				echo "salvestamine �nnestus";
			
				} else {
				echo "ERROR ".$stmt->error;
				
				}
				
				$stmt->close();
				$mysqli->close();
				
		}
	
	
?>

<!DOCTYPE html>

<html>
		
		<head>
				<title>Sisselogimise leht</title>
		<center>
		<style>	
		body {
			background-image:	url("https://pp.vk.me/c636017/v636017905/28122/Jjn90hQPABY.jpg");
			background-repeat: no-repeat;
			background-position: left top;
			background-attachment: fixed;
			}
		
		.MVPborder
		{
		width: 450px;
		height: 125px;
		border:3px solid;
		border-color:#A1D852;
		margin: 20px;
		} 
		
		</style>
		</head>
		
		
		<body>
		
				<h1>Logi sisse</h1>
				<form method="POST" >
				
					<label></label><br>
					<input name="loginEmail" type = "email" placeholder="E-post" value="<?=$loginEmail;?>">
						<br><font color="red"><?php echo $loginEmailError; ?></font></br>
					
					<input name="loginPassword" type = "password" placeholder="Parool"> 
						<font color="red"><br><?php echo $loginPasswordError; ?></font></br>
					
					<input type="submit" style="background-color:#A1D852; color:white" value="Logi sisse">
				</form>

				
				<h1>Loo kasutaja</h1>
				<form method="POST" >
				
					<label></label><br>	
					<input name="signupEmail" type = "email" placeholder="E-post" value="<?=$signupEmail;?>">
						<br><font color="red"><?php echo $signupEmailError; ?></font></br>
					
					<input name="signupPassword" type = "password" placeholder="Parool"> 
						<br><font color="red"><?php echo $signupPasswordError; ?></font></br>
					
					<input name="signupNickName" placeholder="Nickname"> 
						<br><font color="red"><?php echo $signupNickNameError; ?></font></br>
					
					<p><label for="s�nnip�ev">S�nnip�ev:</label><br>
					<input name= "s�nnip�ev" type="date" id="s�nnip�ev" required>
					
					
					<p><label for="signupSugu">Sugu:</label><br>
					<select name = "signupSugu"  id="signupSugu" required><br><br>
					<option value="">N�ita</option>
					<option value="Mees">Mees</option>
					<option value="Naine">Naine</option>
					</select><br><br>
					

				<input type="submit" style="background-color:#A1D852; color:white;" value="Loo kasutaja">
					
				<h1>MVP idee</h1>
				<form method="POST" >
				<p class="MVPborder"><br>Minu MVP idee on luua veebileht, kus inimesed saaksid kirjutada
				�levaaded kohtades, kus nad s��ma k�isid, kas meeldinud toit/personaal/hind.
				Tulevad kategooriad nagu asukoht(riig/linnas), t��p (restoran/kohvik jne), 
				hind, pallid (kui palju pallid antsid s��gikohale).</p>
				<br><br>
				</center>	
				</form>
			
		</body>
		

</html>