<?php

function login ($username, $password, $mysqli) {
 
if ($query = $mysqli->prepare("SELECT id, username, email, password, salt FROM users WHERE username = ? LIMIT 1")) {
        $query->bind_param('s', $username); 					 // Une “$username” al parámetro.
        $query->execute();   							 // Ejecuta la consulta preparada.
        $query->store_result(); 						 // almacena la consulta

	$query->bind_result($user_id, $username, $email, $db_password, $salt);		 // Obtiene las variables del resultado.
	$query->fetch();
 
        $password = hash('sha512', $password . $salt); 				// Hace el hash de la contraseña con una sal única.
		
        if ($query->num_rows == 1) {
		if ($db_password == $password){  				// passwords coinciden, usuario autenticado             
		   	 session_start();				 
                   	 $_SESSION['username'] = $username;
	           	 $_SESSION['logged'] = 1;
			 $_SESSION['id']= $user_id;
        	   	return true;
                    }
		
		else {
                    $now = time();					 // La contraseña no es correcta. Se graba este intento en la base de datos.
                    $mysqli->query("INSERT INTO login_retries(userid, time) VALUES ('$user_id', '$now')");		 
		    //session_start();
      		    //session_destroy();
       		   // header("Location:index.php".urlencode("Usuario o clave incorrecta"));
       		    return false;
                }
             }
		 else {
			//session_start();							//El usuario no existe, destruyo sesion 
       		        //session_destroy();
        		//header("Location:index.php".urlencode("No se realizo la consulta"));
			return false;
        }
   }      
}
?>
