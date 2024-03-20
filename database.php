<?php
// Enable error report
error_reporting(E_ALL);
ini_set('display_errors', '1');

//Prepare the mysql username and password
$db_username='root';
$db_password='';

// Connect to MySQL
$conn = new PDO( 'mysql:host=localhost;  ', $db_username, $db_password );

if(!$conn){
	die("Fatal Error: Connection Failed!");
}

// Create database if the database is not exists.
$dbname = 'cds';
$conn->query("CREATE DATABASE IF NOT EXISTS $dbname");
$conn->query("use $dbname");

?>
 
 