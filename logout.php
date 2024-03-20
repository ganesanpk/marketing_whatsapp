<?php
    require_once 'logs.php';
	session_start();
	session_destroy();
	getlog('logout');
	header('location: index.php');

?>