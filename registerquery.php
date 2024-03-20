<?php

session_start();
require_once 'database.php';

if(ISSET($_POST['register'])){
    if($_POST['name'] != "" || $_POST['phonenumber'] != "" || $_POST['email'] != "" || $_POST['company'] != "" || $_POST['password'] != "" || $_POST['confirmpassword'] != ""){
        try{
            $name = $_POST['name'];
            $phonenumber = $_POST['phonenumber'];
            $email = $_POST['email'];
            $company = $_POST['company'];
            // md5 encrypted
            $password = md5($_POST['password']);
            $confirmpassword = md5($_POST['confirmpassword']);
            // $user_roles = $_POST['user_roles'];
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "INSERT INTO `user` VALUES ('', '$name', '$phonenumber',  '$email', '$company', '$password')";
            $conn->exec($sql);
        }
        catch(PDOException $e){
            echo $e->getMessage();
        }
        $_SESSION['message']=array("text"=>"User successfully created.","alert"=>"info");
        $conn = null;
        header('location:index.php');
    }
    else{
        echo "
            <script>alert('Please fill up the required field!')</script>
            <script>window.location = 'registration.php'</script>
        ";
    }
}
?>