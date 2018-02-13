<?php 
session_start(); 
include('connection.php'); 
$error = ""; 

if(isset($_GET["submit"])){
	if(empty($_GET["username"]) || empty($_GET["password"])){
		$error = "Both fields are required."; 
	} else {
		$username = $_GET['username']; 
		$password = $_GET['password']; 

		$username = stripcslashes($username); 
		$password = stripslashes($password); 

		$username = mysqli_real_escape_string($db, $username); 
		$password = mysqli_real_escape_string($db, $password); 
		$password = md5($password); 

		$query = @"SELECT clientID FROM User WHERE username = '$username' and password = '$password'"; 
		$result = mysqli_query($db, $query); 

		$row = mysqli_fetch_array($result, MYSQLI_ASSOC); 
			}
			if(mysqli_num_rows($result) == 1){
				$cID = $row['clientID'];
				$_SESSION['clientID'] = $cID;
                header('Location: startbootstrap-grayscale-gh-pages/seller_main_page.php');
			}elseif(!$row) {
				die(header('Location: /index.php?loginFailed=true&reason=password'));
			}
		}
exit;

?>
