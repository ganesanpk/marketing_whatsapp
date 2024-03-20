<?php
session_start();

require_once 'database.php';
require_once 'logs.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Delete associated messages first
  

    // Fetch the campaign name before deleting it (optional)
    $query = "SELECT `name` FROM campaign WHERE `campaignid`=?";
    $stmt = $conn->prepare($query);
    $stmt->execute([$id]);
    $campaignData = $stmt->fetch();

    // Delete the campaign
    $query = "DELETE FROM campaign WHERE `campaignid`=?";
    $stmt = $conn->prepare($query);
    $stmt->execute([$id]);

    // Log the deletion with the campaign name (optional)
    if ($campaignData) {
        $campaignName = $campaignData['name'];
        getlog(" deleted a campaign $campaignName");
    }

    $_SESSION['message'] = array("text" => "Campaign List successfully deleted.", "alert" => "info");
    header("Location: campaignlist.php");
} else {
    $_SESSION['message'] = array("text" => "No ID parameter provided in the URL.", "alert" => "danger");
    header("Location: campaignlist.php");
}
?>
