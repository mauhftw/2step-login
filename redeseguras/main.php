<?php
include_once 'database.php';
include_once 'login.php';
include_once 'sec.php'; 

if (isset($_POST['username'], $_POST['password'])) {

$username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_SPECIAL_CHARS);
$password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_SPECIAL_CHARS);

    if (login($username, $password, $mysqli) == true) {
        // Inicio de sesión exitosa
        header('Location:home.php');
    } 
	else {
        // Inicio de sesión FALLIDA
	header("Location:error.php");
	 }
       }
	 else {
    // Las variables POST correctas no se enviaron a esta página.
    echo 'Solicitud no válida, rellene los campos';
    header ('Location: index.php');
	}	

?>
