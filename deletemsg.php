<?php

session_start();

require_once 'database.php';
require_once 'logs.php';

if (isset($_GET['messageid'])) {
    $id = $_GET['messageid'];

    $query = "DELETE FROM message WHERE messageid=?";
    $stmt = $conn->prepare($query);
    $stmt->execute([$id]);

    $_SESSION['message'] = array("text" => "message list successfully deleted.", "alert" => "info");
    getlog('deleted a message');
} else {
    $_SESSION['message'] = array("text" => "No ID parameter provided in the URL.", "alert" => "danger");
}



header("Location: messagelist.php");


?>
