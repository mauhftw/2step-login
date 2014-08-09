<?php
include_once "sec.php";
require_once "Auth.php";

function genotp () {

	$g = new GAuth\Auth();
	$code = $g->generateCode();
//	echo 'Generated code: '.$code;
	return $code;

}
?>
