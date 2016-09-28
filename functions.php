<?php 
	
	$database = "if16_ksenbelo_4";
	// functions.php
	
	function signup($email, $password) {
		
		$mysqli = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $GLOBALS["database"]);
		
		$stmt = $mysqli->prepare("INSERT INTO user_sample (email, password) VALUE (?, ?)");
		echo $mysqli->error;
		$stmt->bind_param("ss", $email, $password);
		if ( $stmt->execute() ) {
			echo "õnnestus";
		} else {
			echo "ERROR ".$stmt->error;
		}
		
	}
	
	
	/*function sum($x, $y) {
		
		return $x + $y;
		
	}
	
	echo sum(12312312,12312355553);
	echo "<br>";
	
	
	function hello($firstname, $lastname) {
		return 
		"Tere tulemast "
		.$firstname
		." "
		.$lastname
		."!";
	}
	
	echo hello("Ksenia", "Belorusskaja");
	*/
	
?>