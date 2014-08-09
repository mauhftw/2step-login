<?php
include_once "sec.php";
include_once "login.php";
require_once "Auth.php";

function checkotp ($user_id, $mysqli, $key) {

	
	if ($query = $mysqli->prepare("SELECT otp FROM users WHERE id = ?")) {
        $query->bind_param('i', $user_id);                                      // Une “$username” al parámetro.
        $query->execute();                                                       // Ejecuta la consulta preparada.
        $query->store_result();                                                  // almacena la consulta

        $query->bind_result($otp);           // Obtiene las variables del resultado.
        $query->fetch();

	//echo $otp; YA TENGO OTP


	$g = new \GAuth\Auth($otp);  //traigo el key del usuario y luego comparo 

	if ($g-> validateCode($key)) {
		header("Location: welcome.php");
	}
	else {
		header("Location: failed.php");
	}


}


	}

?>
