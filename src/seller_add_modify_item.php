<?php session_start();

$TPclientID = $_SESSION['clientID'];

include("connection.php");

// Check connection
if ($db->connect_error)
{
    die("Connection failed: " . $db->connect_error);
}

$numberOfTickets = $_GET['num_items'];
$eventName = $_GET['eventName'];
$eventDate = $_GET['event_date'];
$eventLocation = $_GET['street_address'] . " " . $_GET['city'] . " " . $_GET['state_initial'] . " " . $_GET['zip_code'];
$ticketPrice = $_GET['price'];
$eventDescription = $_GET['event_description'];
$eventCategory = $_GET['category'];


//SQL Query
$sql_query = "INSERT INTO Ticket_Products (TPclientID, numberOfTickets, eventName, eventDate, 
eventLocation, ticketPrice, eventDescription, eventCategory) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = mysqli_prepare($db, $sql_query);

//Bind the Variables to sql
mysqli_stmt_bind_param($stmt, "iisssdss", $TPclientID, $numberOfTickets, $eventName, $eventDate,
        $eventLocation, $ticketPrice, $eventDescription, $eventCategory);

//Execute Code
mysqli_stmt_execute($stmt);

$affected_rows = mysqli_stmt_affected_rows($stmt);
if($affected_rows != 1)
{
    echo 'Error Occurred<br />';
    echo mysqli_error();
}

mysqli_stmt_close($stmt);
mysqli_close($db);

header('Location: startbootstrap-grayscale-gh-pages/seller_main_page.php');
exit;

?>