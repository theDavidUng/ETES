<?php 
include('connection.php'); 
if(isset($_GET["submit"]))
{
	    $first_name = stripcslashes(mysqli_real_escape_string($db,$_GET['first_name']));
        $last_name = stripcslashes(mysqli_real_escape_string($db,$_GET['last_name']));
        $email = stripcslashes(mysqli_real_escape_string($db,$_GET['email']));
        $phone = stripcslashes(mysqli_real_escape_string($db, $_GET['phone']));
        $username = stripcslashes(mysqli_real_escape_string($db, $_GET['username']));
        $password = stripcslashes(mysqli_real_escape_string($db,$_GET['password']));
        $creditcard = stripcslashes(mysqli_real_escape_string($db, $_GET['creditcard']));
        $street = stripcslashes(mysqli_real_escape_string($db, $_GET['street_number'] . " " . $_GET['route']));
        $city = stripcslashes(mysqli_real_escape_string($db, $_GET['locality']));
        $state = stripcslashes(mysqli_real_escape_string($db, $_GET['administrative_area_level_1']));
        $zip = stripcslashes(mysqli_real_escape_string($db, $_GET['postal_code']));

        $query = "SELECT * FROM User WHERE email='$email'";
        $response = mysqli_query($db, $query);
        $numResults = mysqli_num_rows($response);

        $query = "SELECT * FROM User WHERE username='$username'";
        $response = @mysqli_query($db, $query);
        $numResults2 = mysqli_num_rows($response);

        //print 'Check Username: ' . $numResults2;
        //print 'Check Email:' . $numResults;

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) 
        {
            $message =  "Invalid email address please type a valid email!!";
            //echo $message;
            //echo "<script>alert('$message');</script>";
        }
        elseif($numResults >= 1)
        {
            $message = $email." Email already exist!!";
            //echo $message;
            //echo "<script>alert('$message');</script>";
        }
        elseif($numResults2 >= 1)
        {
            $message = $username." already exist!!";
            //echo $message;
            //echo "<script>alert('$message');</script>";
        }
        else
        {
        	$sql_query = "INSERT INTO  User (firstName,lastName, password, username, email, streetAddress, city, zipCode, state, phoneNumber, creditCardNumber) values ( ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)"; 
        	$stmt = mysqli_prepare($db, $sql_query); 

        	mysqli_stmt_bind_param($stmt, "sssssssssss", $first_name, $last_name, md5($password), $username, $email, $street, $city, $zip, $state, $phone, $creditcard); 
        	mysqli_stmt_execute($stmt); 
        	//echo mysqli_connect_error();
        	//var_dump($stmt);
        	//mysqli_stmt_close($stmt);
            //mysqli_query($db, "INSERT INTO User (firstName,lastName, password, username, email, streetAddress, city, zipCode, state, phoneNumber, creditCardNumber) values ('".$first_name."','".$last_name."', '".md5($password)."','".$username."','".$email."','".$street."','".$city."','".$zip."','".$state."','".$phone."','".$creditcard."')");

            $message = "Signup Sucessfully!!";

            //echo mysqli_error($db);

            //echo "INSERT INTO User (firstName,lastName, password, username, email, streetAddress, city, zipCode, state, phoneNumber, creditCardNumber) values ('".$first_name."','".$last_name."', '".md5($password)."','".$username."','".$email."','".$street."','".$city."','".$zip."','".$state."','".$phone."','".$creditcard."')";
        }


}
header('Location: startbootstrap-grayscale-gh-pages/index.php#seller');
exit;
?>