<?php session_start();

//var_dump($GLOBALS);
//var_dump($_SESSION);
//echo $_SESSION['productID'];

$buyerLocation = $_GET['street_number'] . " " . $_GET['route'] . " " . $_GET['locality'] . " " . $_GET['postal_code'];
$BuyerCreditCardNumber = md5($_GET['card-number']);

$productID = $_SESSION['productID'];

include("../connection.php");

$sql_query = "SELECT TPclientID, numberOfTickets, eventName, eventDate, eventCategory, ticketPrice 
FROM Ticket_Products WHERE productID = " . $productID;

$response = @mysqli_query($db, $sql_query);
$row = mysqli_fetch_array($response);

$clientID = $row['TPclientID'];
$ticketQuantity = $row['numberOfTickets'];
$eventName = $row['eventName'];
$eventDate = $row['eventDate'];
$eventCategory = $row['eventCategory'];
$ticketPrice = $row['ticketPrice'];


$sql_query = "SELECT streetAddress, city, zipCode FROM User WHERE clientID = " . $clientID;
$response = @mysqli_query($db, $sql_query);
$row = mysqli_fetch_array($response);

$sellerLocation = $row['streetAddress'] . " " . $row['city'] . " " . $row['zipCode'];

//Decrement number of tickets available
if ($ticketQuantity > 0)
{
    $newTicketQuantity = --$ticketQuantity;
    //SQL Query
    $sql_query = "UPDATE Ticket_Products SET numberOfTickets = ? WHERE productID = " . $productID;
    $stmt = mysqli_prepare($db, $sql_query);
    //Bind the Variables to sql
    mysqli_stmt_bind_param($stmt, "i", $newTicketQuantity);

    //Execute Code
    mysqli_stmt_execute($stmt);

    //Delete from table if quantity is 0
    if ($newTicketQuantity == 0)
    {
        //SQL Query
        $sql_query = "DELETE from Ticket_Products WHERE productID = " . $productID;
        $stmt = mysqli_prepare($db, $sql_query);

        //Execute Code
        mysqli_stmt_execute($stmt);
    }
}

mysqli_close($db);

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>ETES - Electronic Ticket Exchange System</title>

    <!-- Bootstrap Core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">

    <!-- Theme CSS -->
    <link href="css/grayscale.min.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

<style>
    #panel
    {
    background-color: #ffffff;
    }
</style>
</head>

<body id="page-top" data-spy="scroll" data-target=".navbar-fixed-top">

<!-- Navigation -->
<nav class="navbar navbar-custom navbar-fixed-top" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-main-collapse">
                Menu <i class="fa fa-bars"></i>
            </button>
            <a class="navbar-brand page-scroll" href="index.php">
                <i class="fa fa-play-circle"></i> <span class="light">Ticket</span>Home
            </a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse navbar-right navbar-main-collapse">
            <ul class="nav navbar-nav">
                <!-- Hidden li included to remove active class from about link when scrolled up past about section -->
                <li class="hidden">
                    <a href="#page-top"></a>
                </li>
                <li>
                    <a class="page-scroll" href="index.php#seller">Seller</a>
                </li>
                <li>
                    <a class="page-scroll" href="index.php#buyer">Buyer</a>
                </li>
                <li>
                    <a class="page-scroll" href="index.php#contact">Contact</a>
                </li>
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container -->
</nav>


<section id="transaction_summary" class="container content-section">
    <h2 class="text-center">Transaction Complete</h2>

    <h5 class="text-center">Your order has been placed. Delivery information is displayed below.</h5>
    <!-- Map Section -->
    <div id="map" style="width: 600px; float: left"></div>
    <div id="panel" style="width: 500px; float: right;"></div>
    <script>
        function initMap() {
            var map = new google.maps.Map(document.getElementById('map'), {
                                          zoom: 13,
                                          center: {lat: 34.04924594193164, lng: -118.24104309082031}
                                          });
                                          
                                          var trafficLayer = new google.maps.TrafficLayer();
                                          trafficLayer.setMap(map);
        }
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBG8qGQLshrWPzNOsg_JnzIMCbVYqW0-QY&callback=initMap">
        </script>

    <script type="text/javascript">
        
        var directionsService = new google.maps.DirectionsService();
        var directionsDisplay = new google.maps.DirectionsRenderer();
        
        var map = new google.maps.Map(document.getElementById('map'), {
                                      zoom:7,
                                      mapTypeId: google.maps.MapTypeId.ROADMAP
                                      });
                                      var trafficLayer = new google.maps.TrafficLayer();
                                      trafficLayer.setMap(map);
                                      directionsDisplay.setMap(map);
                                      directionsDisplay.setPanel(document.getElementById('panel'));
                                      
                                      var request = {
                                          origin: "<?php echo $sellerLocation?>",
                                          destination: "<?php echo $buyerLocation?>",
                                          travelMode: 'DRIVING',
                                      };
    
    directionsService.route(request, function(response, status) {
                            if (status == google.maps.DirectionsStatus.OK) {
                                trafficModel = 'pessimistic';
                                directionsDisplay.setDirections(response);
                            }
                            });
        </script>



</section>

<?php include("../connection.php");

$sql_query = "SELECT numberOfTickets FROM Ticket_Products WHERE productID = " . $productID;
$response = @mysqli_query($db, $sql_query);
$row = mysqli_fetch_array($response);
$ticketQuantity = $row['numberOfTickets'];


mysqli_close($db);

?>

<?php
include("../connection.php");

//SQL Query
$sql_query2 = "INSERT INTO Transaction_Log (TLclientID, eventName, eventDate, eventCategory, ticketPrice, 
purchaseDate, purchaseStatus, paymentApproved, BuyerCreditCardNumber, dropOffLocation, pickUpLocation) 
VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

$stmt2 = mysqli_prepare($db, $sql_query2);

date_default_timezone_set('America/Los_Angeles');
$todayDate = date("Y-m-d");
$paymentApproved = "Pending";
$purchaseStatus = "Pending";

//Bind the Variables to sql
mysqli_stmt_bind_param($stmt2, "isssdssssss", $clientID, $eventName, $eventDate, $eventCategory, $ticketPrice,
    $todayDate, $purchaseStatus, $paymentApproved, $BuyerCreditCardNumber, $buyerLocation, $sellerLocation);

//Execute Code
mysqli_stmt_execute($stmt2);

mysqli_stmt_close($stmt2);
mysqli_close($db);
?>

<?php

$totalPrice = $ticketPrice + ($ticketPrice * .05);

$msg = "Thank you for purchasing with ETES\nPurchase Summary:\nEvent Name: " . $eventName . "\nEvent Date: " . $eventDate
    . "\nEvent Category: " . $eventCategory . "\nTotal Price: " . $totalPrice . "\nDrop Off Location: ". $buyerLocation;


$msg = wordwrap($msg,70);

$to = $_GET['email'];
$subject = "ETES Ticket Purchase Receipt";
$headers = "From: webmaster@etes.com";

mail($to, $subject, $msg, $headers);

?>


<script src="vendor/jquery/jquery.js"></script>
<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
<script src="https://fonts.googleapis.com/css?family=Playfair+Display|Quicksand:400,700|Open+Sans|PT+Mono"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js"></script>
<script src="js/grayscale.min.js"></script>
</body>

<!-- Footer -->
<footer>
    <div class="container text-center">
        <p>Copyright &copy; ETES 2017</p>
    </div>
</footer>
</html>
