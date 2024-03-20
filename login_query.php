<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');

	session_start();
	
	require_once 'database.php';
	require_once 'logs.php';
	
	if(ISSET($_POST['login'])){
		if($_POST['email'] != "" || $_POST['password'] != ""){
			$email = $_POST['email'];
			$password = md5($_POST['password']);
			
            $sql = "SELECT * FROM `user` WHERE `email`=? AND `password`=? ";
			$query = $conn->prepare($sql);
			$query->execute(array($email,$password));
			$row = $query->rowCount();
			$fetch = $query->fetch();
			if($row > 0) {
				$_SESSION['user'] = $fetch['userid'];
				$_SESSION['message']=array("text"=>"Login successfully created.","alert"=>"info");
				getlog('login');
				header("location: home.php");
			} else{
				echo "
				<script>alert('Invalid name or password')</script>
				<script>window.location = 'index.php'</script>
				";
			}
		}else{
			echo "
				<script>alert('Please complete the required field!')</script>
				<script>window.location = 'index.php'</script>
			";
		}
	}
?>