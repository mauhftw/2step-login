<?php
require 'PHPMailer/PHPMailerAutoload.php';
include_once 'home.php';
include_once 'sec.php';


function email ($user_id, $qr, $mysqli) {

if (empty($_SESSION['completed'])) {

if ($query = $mysqli->prepare("SELECT email FROM users WHERE id = ? LIMIT 1")) {
        $query->bind_param('s', $user_id);                                       // Une “$username” al parámetro.
        $query->execute();                                                       // Ejecuta la consulta preparada.
        $query->store_result();                                                  // almacena la consulta
        $query->bind_result($email);                                             // Obtiene las variables del resultado.
        $query->fetch();
}

$mail = new PHPMailer;

$mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username = 'comredseguras';                 // SMTP username
$mail->Password = 'redSegura2314';                           // SMTP password
$mail->SMTPSecure = 'ssl';                            // Enable encryption, 'ssl' also accepted
$mail->From = 'Admin@redeseguras.com.ar';
$mail->FromName = 'Admin';
$mail->addAddress($email);     // Add a recipient
$mail->WordWrap = 50;                                 // Set word wrap to 50 characters
$mail->isHTML(true);                                  // Set email format to HTML
$mail->Subject = 'Two-Step Authentication';
$mail->Body    = $qr;
$mail->send();

	}
$_SESSION['completed'] = TRUE;

}

?>
