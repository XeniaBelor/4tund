<?php
	
	require("../../config.php");
	session_start();
	
	$email = $password = $birthday = $signupSugu = "";
	
	$database = "if16_ksenbelo_4";
	
	function signup ($email, $password,$birthday,$signupSugu) {
		
		$mysqli = new mysqli($GLOBALS["serverHost"],$GLOBALS["serverUsername"],$GLOBALS["serverPassword"],$GLOBALS["database"]);
		$stmt = $mysqli->prepare("INSERT INTO user_sample (email, password, bithday,gender) VALUES (?, ?, ?, ?)");
		echo $mysqli->error;
		$stmt->bind_param("ssss",$email, $password,$birthday,$signupSugu);
		
		if ($stmt->execute()) {
			echo "salvestamine õnnestus";
		} else {
			echo "ERROR ".$stmt->error;
		}
		
	}
	
	
	function login($email, $password) {
		
		$error = "";
		
		$mysqli = new mysqli($GLOBALS["serverHost"],$GLOBALS["serverUsername"],$GLOBALS["serverPassword"],$GLOBALS["database"]);
		$stmt = $mysqli->prepare("
			SELECT id, email, password, created 
			FROM user_sample
			WHERE email = ?
		");
		echo $mysqli->error;
		
		//asendan küsimärgi
		$stmt->bind_param("s", $email);
		
		//määran tupladele muutujad
		$stmt->bind_result($id, $emailFromDb, $passwordFromDb, $created);
		$stmt->execute();
		
		//küsin rea andmeid
		if($stmt->fetch()) {
			//oli rida
		
			// võrdlen paroole
			$hash = hash("sha512", $password);
			if($hash == $passwordFromDb) {
				
				echo "kasutaja ".$id." logis sisse";
				
				
				$_SESSION["userId"] = $id;
				$_SESSION["email"] = $emailFromDb;
				
				//suunaks uuele lehele
				header("Location: data.php");
				exit();
				
			} else {
				$error = "parool vale";
			}
			
		
		} else {
			//ei olnud 
			
			$error = "sellise emailiga ".$email." kasutajat ei olnud";
		}
		
		$stmt->close();
		$mysqli->close();
		
		return $error;
		
		
	}
	
	
		function register_food($username,$food) {
		
		$mysqli = new mysqli($GLOBALS["serverHost"], 
		$GLOBALS["serverUsername"], 
		$GLOBALS["serverPassword"], 
		$GLOBALS["database"]);
		
		$stmt = $mysqli ->prepare("INSERT INTO register_food (nickname, food, user_Id) VALUE(?,?,?)");
		echo $mysqli->error;
		$stmt->bind_param("ssi", $username, $food, $_SESSION["userId"]);
	
		if($stmt->execute() ) {
			echo "Õnnestus!","<br>";			
		} else{
			echo "ERROR".$stmterror;
		}
	
	}
	
		function saveregister_food(){
		
		$mysqli = new mysqli($GLOBALS["serverHost"], 
		$GLOBALS["serverUsername"], 
		$GLOBALS["serverPassword"], 
		$GLOBALS["database"]);
		
		$stmt = $mysqli->prepare("
			SELECT nickname, food
			FROM register_food
			");
		
		$stmt->bind_result($username, $food);
		$stmt->execute();
		
		$results = array();
		
		while ($stmt->fetch()) {
			
			$human = new StdClass();
			$human->nickname = $username;
			$human->food = $food;
			
			array_push($results, $human);	
			}
			
		return $results;
		
		}
	

		function cleanInput($input) {
		

		$input = trim($input);
		$input = stripslashes($input);
		$input = htmlspecialchars($input);
		return $input;
		
		}
?>
