



<?php

require_once 'database.php';

header('Content-Type: application/json; charset=utf-8');

if (isset($_GET['term'])) {
	$stmt = $conn->prepare('select name,userid from user where userid like :keyword');
	$stmt->bindValue('keyword', '%' . $_GET['term'] . '%');
	$stmt->execute();
	echo json_encode($stmt->fetchAll(PDO::FETCH_CLASS));


} else {
	$stmt = $conn->prepare('select * from user');
	$stmt->execute();
	echo json_encode($stmt->fetchAll(PDO::FETCH_CLASS));
}

?>