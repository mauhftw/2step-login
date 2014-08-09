<?php

session_start();
if($_SESSION['logged'] != 1) {

session_destroy();
header("Location: index.php");
}

?>
