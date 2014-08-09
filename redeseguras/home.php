<?php
include_once "sec.php";
include_once "database.php";
include_once "genotp.php";
include_once "checkotp.php"; 
include_once "email.php";
include_once "qrcode.php";
?>
<?php
$user = $_SESSION['username'];
$user_id = $_SESSION['id'];

// GENERACION DEL CODIGO QR  /FUNCION/
$qr= qrcode($user, $user_id, $mysqli); 
// ENVIO MAIL
email($user_id, $qr, $mysqli);
?>

<h2>Se ha enviado un e-mail a su casilla de correo con su key</h2>
<p>Ingrese el codigo de verificacion generado por Google Authenticator</p> 
<form method="post" action=checkauth.php> 
<input type="password" name="pass"><br> <!--FILTRAR ENTRADAS Y CAMBIAR TYPE A PASSWORD:--!>
<input type="submit" name="submit" value="Enviar"><br>
</form>

