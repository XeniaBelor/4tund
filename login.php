<?php
	//võtab ja kopeerib faili sisu

	require("../../config.php");
	require("functions.php");
	
	
	if (isset ($_SESSION["userId"]))
	{	
		header("Location: data.php");
	}
	

	//Muutujad
	
	$loginEmailError = $loginPasswordError = "";
	$loginEmail = "";
	
	$signupEmailError = $signupEmail = $signupPasswordError = "";
	
	//Loogimine sisse
	if (isset ($_POST["loginEmail"])) {
		if (empty ($_POST["loginEmail"])) {
			$loginEmailError = "* Väli on kohustuslik!";
		
	} else {
		//kui Email on korras
		$loginEmail = $_POST ["loginEmail"];
		
		}
	}
	
	if (isset ($_POST["loginPassword"])) {
		if (empty ($_POST["loginPassword"])) {
			$loginPasswordError = "* Väli on kohustuslik!";
		} else {
			
		}if (strlen ($_POST["loginPassword"]) <8)
			$loginPasswordError = "* Parool peab olema vähemalt 8 tähemärkki pikk!";
	}
	
	//Kasutaja registreerimine
	
	
	if (isset ($_POST["signupEmail"])) {
		if (empty ($_POST["signupEmail"])) {
			$signupEmailError = "* Väli on kohustuslik!";
		} else {
		//kui Email on korras
		$signupEmail = $_POST ["signupEmail"];
		}
	}
	
	
	if (isset ($_POST["signupPassword"])) {
		if (empty ($_POST["signupPassword"])) {
			$signupPasswordError = "* Väli on kohustuslik!";
		} else {	
		
		}if (strlen ($_POST["signupPassword"]) <8)
			$signupPasswordError = "* Parool peab olema vähemalt 8 tähemärkki pikk!";
	}


	
	// Kui pole ühtegi viga
	if( isset($_POST["signupEmail"]) &&
		isset($_POST["signupPassword"]) &&
		empty($signupPasswordError)&&
		empty($signupEmailError)
		)
		
		{	
			echo "Salvestan...<br>";
			echo "email: ".$signupEmail."<br>";
			//echo "password: ".$_POST["signupPassword"]."<br>"; parool ilma hashiga
			
			$signupPassword = hash("sha512", $_POST["signupPassword"]);
			echo "password hashed: ".$signupPassword."<br>";

		signup($signupEmail, $signupPassword);
	   }
	
		
		$error = "";
		//kontrollin, et kasutaja täitis välja ja võib sisse logida
		if(isset($_POST["loginEmail"]) && 
		isset($_POST["loginPassword"]) &&
		!empty($_POST["loginEmail"]) && 
		!empty($_POST["loginPassword"])
		)
		
		{
		$error =login($_POST["loginEmail"], $_POST["loginPassword"]);
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
				<?php echo $error; ?><br><br>
				<input name="loginEmail" type = "email" placeholder="E-post" value="<?=$loginEmail;?>">
				<br><font color="red"><?php echo $loginEmailError; ?></font></br>
					
				<input name="loginPassword" type = "password" placeholder="Parool"> 
				<font color="red"><br><?php echo $loginPasswordError;   ?></font></br>
					
				<input type="submit" style="background-color:#A1D852; color:white" value="Logi sisse">
				<input type="button" onClick="location.href='register.php'" style="background-color:#A1D852; 
				color:white" value="Loo uut kasutaja">
			
				
				<h1>Loo kasutaja</h1>
				
					<label></label><br>	
					<input name="signupEmail" type = "email" placeholder="E-post" value="<?=$signupEmail;?>">
					<br><font color="red"><?php echo $signupEmailError; ?></font></br>
					
					<input name="signupPassword" type = "password" placeholder="Parool"> 
					<br><font color="red"><?php echo $signupPasswordError; ?></font></br>

						
						
				<input type="submit" style="background-color:#A1D852; color:white;" value="Loo kasutaja">
				
				</form>
			
		</body>
		

</html>