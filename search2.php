<?php

require_once 'database.php';

header('Content-Type: application/json; charset=utf-8');

if (isset($_GET['term'])) {
	$stmt = $conn->prepare('select name,campaignid from campaign where campaignid like :keyword');
	$stmt->bindValue('keyword', '%' . $_GET['term'] . '%');
	$stmt->execute();
	echo json_encode($stmt->fetchAll(PDO::FETCH_CLASS));

} else {
	$stmt = $conn->prepare('select * from campaign');
	$stmt->execute();
	echo json_encode($stmt->fetchAll(PDO::FETCH_CLASS));
}

?>