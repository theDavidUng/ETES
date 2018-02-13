<?php
session_start();

$clientID = $_SESSION['clientID'];

include('../connection.php');
	    $first_name = $_GET['first_name'];
        $last_name = $_GET['last_name'];
        $email = $_GET['email'];
        $phone = $_GET['phone'];
        $password = $_GET['password'];
        $creditcard = $_GET['creditcard'];
        $street = $_GET['street'];
        $city = $_GET['city'];
        $state =  $_GET['state_initial_delivery'];
        $zip = $_GET['zip'];

            //SQL Query
        	$sql_query = "UPDATE User SET firstName = ?, lastName = ?, email = ?, phoneNumber = ?, password = ?, streetAddress = ?, city = ?, zipCode = ?, state = ?, creditCardNumber = ?  WHERE clientID = " . $clientID;
            $stmt = mysqli_prepare($db, $sql_query);

            //Bind the Variables to sql
            mysqli_stmt_bind_param($stmt, "ssssssssss", $first_name, $last_name, $email, $phone, md5($password), $street, $city, $zip, $state, $creditcard);

            //Execute Code
            mysqli_stmt_execute($stmt);

mysqli_close($db);
header('Location: seller_main_page.php');
exit;

?>