<?php
include_once "sec.php";
include_once "home.php";

function qrcode ($user, $user_id, $mysqli) {

	
	if ($query = $mysqli->prepare("SELECT otp FROM users WHERE id = ?")) {
        $query->bind_param('i', $user_id);                                      // Une “$username” al parámetro.
        $query->execute();                                                       // Ejecuta la consulta preparada.
        $query->store_result();                                                  // almacena la consulta

        $query->bind_result($otp);           // Obtiene las variables del resultado.
        $query->fetch();

	//echo $otp; YA TENGO OTP
	
	$uri = sprintf("otpauth://totp/%s@redeseguras.com?secret=%s",$user,$otp);
	$preqr = sprintf("https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl=%s&choe=UTF-8",$uri);
	$qr =sprintf("Por favor escanee el siguiente codigo QR con Google Authenticator <BR> <img src=%s />",$preqr);

	return $qr;


}
return "query fail";

	}

?>
