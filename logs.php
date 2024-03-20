<?php

//  session_start();
require_once 'database.php';


function getlog($data){
    global $conn;
    
    // Set timezone to Indian Standard Time (IST)
    date_default_timezone_set('Asia/Kolkata');
    
    $log_type = $data;
    $t = time();
    $log_timestamp = $t; 
        
    // Check if the user is logged in and their name is available in the session
    $id = $_SESSION['user'];
    $sql = $conn->prepare("SELECT * FROM `user` WHERE `userid`='$id'");
    $sql->execute();
    $fetch = $sql->fetch();

   
    
    // $operation = $fetch['name'] . "@" . $data . "@" . date('h:i:s A', $log_timestamp);

     // Construct the log message
     $operation = $fetch['name']."@" . $data ." at " . date('h:i:s A', $log_timestamp);
    // $operation = $data."@".date('h:i:s A', $log_timestamp);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "INSERT INTO `logs` (`log_type`, `operation`, `log_timestamp`) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$log_type, $operation, $log_timestamp]);
       
    return 0;
}


