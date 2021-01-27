<?php
	session_start();
	$_SESSION = array();
	$_SESSION['logged']= false;
	header("Location: /Stage_ISTC/index.php");
?>