<?php
session_start();

require_once 'database.php';
require_once 'logs.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Then, delete the message group
    $delete = "DELETE FROM message_group WHERE id = ?";
    $delete = $conn->prepare($delete);
    $delete->execute([$id]);

    $_SESSION['message'] = array("text" => "Message group and associated messages successfully deleted.", "alert" => "info");
    getlog('deleted a messagegroup');
} else {
    $_SESSION['message'] = array("text" => "No ID parameter provided in the URL.", "alert" => "danger");
}


header("Location: message_group_list.php");
?>
