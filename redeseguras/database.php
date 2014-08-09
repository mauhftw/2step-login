<?php
$server="localhost";
$userDB="root";
$passwordDB="root";
$base="secure_login";

$mysqli=new mysqli($server,$userDB,$passwordDB,$base);
if ($mysqli->connect_errno) {
    echo "Fallo al contenctar a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}
//echo $mysqli->host_info . "\n";
?>
