<?php
include_once "sec.php";
include_once "database.php";
include_once "checkotp.php";

$user_id = $_SESSION['id'];
$key = filter_input(INPUT_POST, 'pass', FILTER_SANITIZE_SPECIAL_CHARS);
checkotp($user_id,$mysqli,$key);

?>
