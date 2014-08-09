<?php
include_once"database.php";
include_once "genotp.php";

if (!empty ($_POST['username']) && !empty ($_POST['password']) && !empty ($_POST['email']) ) { 	

	$username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_SPECIAL_CHARS);
	$password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_SPECIAL_CHARS);
	$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_SPECIAL_CHARS);

       	$query = $mysqli->prepare("SELECT username, email FROM users WHERE username = ? OR email= ? LIMIT 1");
        $query->bind_param('ss', $username, $email); 					 // Une “$username” al parámetro.
        $query->execute();   							 // Ejecuta la consulta preparada.
        $query->store_result(); 						 // almacena la consulta
	$query->bind_result($usernameDB, $emailDB);		 // Obtiene las variables del resultado.
	$query->fetch();

	$result = $query->num_rows;	
		if ($result > 0 ) {
			header("Location:error.php");
			}
		else {
		 $salt = base64_encode(mcrypt_create_iv(24, MCRYPT_DEV_URANDOM));		//Genero la salt
		 $password = hash('sha512', $password . $salt); 				// Hace el hash de la contraseña con una sal única.
		 $otp = genotp();								//genero el topt
       		 $query2 = $mysqli->prepare("INSERT INTO users (username,email,password,salt,otp) VALUES (?, ?, ?, ?, ?)");
       		 $query2->bind_param('sssss', $username, $email, $password, $salt, $otp); 
       		 $query2->execute();
       		 header ("Location:success.php"); 
		}	
}
else {
	header("Location:error.php");
}

?>
