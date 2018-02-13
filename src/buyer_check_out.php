<?php session_start();
$productID = $_GET['productID'];
$_SESSION['productID'] = $productID;
//echo $_SESSION['productID'];
//var_dump($_SESSION);
//var_dump($GLOBALS);
session_write_close();
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

        h3, h4, h5, h6
        {
            margin: 0;
            line-height: 2;
        }

        h3
        {
            font-size: 16px;
            letter-spacing: 1px;
            text-align: left;
            margin-top: 5px;
        }

        h4
        {
            font-size: 16px;
            letter-spacing: 1px;
            text-align: left;
            line-height: 2;
        }

        h5
        {
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 1px;
            text-align: left;
            text-transform: uppercase;
            line-height: 1.4;
        }

        h5 > span
        {
            margin-left: 87px;
        }

        h5.total {
            margin-top: 20px;
        }

        h6
        {
            font-size: 18px;
            font-weight: 400;
            color: #f4f5f9;
            letter-spacing: 0;
            text-align: left;
            text-transform: uppercase;
            line-height: 2;
        }

        h6 > span
        {
            margin-left: 64px;
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


<section id="edit_product" class="container content-section">
    <h2 class="text-center">Checkout</h2>

    <?php

    include("../connection.php");

    $sql_query = "SELECT eventName, eventDate, eventLocation, ticketPrice, eventCategory FROM Ticket_Products WHERE productID = " . $productID;
    $response = @mysqli_query($db, $sql_query);
    $row = mysqli_fetch_array($response);

    $eventName = $row['eventName'];
    $eventDate = $row['eventDate'];
    $eventLocation = $row['eventLocation'];
    $ticketPrice = $row['ticketPrice'];
    $eventCategory = $row['eventCategory'];

    mysqli_close($db);
    ?>
    <?php

$submitbutton= isset($_POST['submitbutton']);

$number= isset($_POST['card-number']);

function validatecard($number)
 {
    global $type;

    $cardtype = array(
        "electron" => "/^(4026|417500|4405|4508|4844|4913|4917)\d+$/",
        "maestro" => "/^(5018|5020|5038|5612|5893|6304|6759|6761|6762|6763|0604|6390)\d+$/",
        "dankort" => "/^(5019)\d+$/",
        "interpayment"=> "/^(636)\d+$/",
        "unionpay"=> "/^(62|88)\d+$/",
        "visa"=> "/^4[0-9]{12}(?:[0-9]{3})?$/",
        "mastercard"=> "/^5[1-5][0-9]{14}$/",
        "amex"=> "/^3[47][0-9]{13}$/",
        "diners"=> "/^3(?:0[0-5]|[68][0-9])[0-9]{11}$/",
        "discover"=> "/^6(?:011|5[0-9]{2})[0-9]{12}$/",
        "jcb"=> "/^(?:2131|1800|35\d{3})\d{11}$/",
    );

    if (preg_match($cardtype['electron'],$number))
    {
    $type= "electron";
        return true;
    
    }
    else if (preg_match($cardtype['maestro'],$number))
    {
    $type= "maestro";
        return true;
    }
    else if (preg_match($cardtype['dankort'],$number))
    {
    $type= "dankort";
        return true;
    
    }
    else if (preg_match($cardtype['interpayment'],$number))
    {
    $type= "interpayment";
        return true;
    }
     else if (preg_match($cardtype['unionpay'],$number))
    {
    $type= "unionpay";
        return true;
    }
         else if (preg_match($cardtype['visa'],$number))
    {
    $type= "visa";
        return true;
    }
         else if (preg_match($cardtype['mastercard'],$number))
    {
    $type= "mastercard";
        return true;
    }
         else if (preg_match($cardtype['amex'],$number))
    {
    $type= "amex";
        return true;
    }
         else if (preg_match($cardtype['diners'],$number))
    {
    $type= "diners";
        return true;
    }
         else if (preg_match($cardtype['discover'],$number))
    {
    $type= "discover";
        return true;
    }
         else if (preg_match($cardtype['jcb'],$number))
    {
    $type= "jcb";
        return true;
    }
    else
    {
        return false;
    } 
 }

validatecard($number);


?>


    <div id="order-list" class='order'>
        <h3 class="text-center">Orders</h3>

        <h4>Event: <?php echo $eventName ?></h4>
        <h4>Date: <?php echo $eventDate ?></h4>
        <h4>Location: <?php echo $eventLocation ?></h4>
        <h4>Category: <?php echo $eventCategory ?></h4>

        <h5 id="serviceFeeCost">Original Cost</h5><h4>$ <?php echo $ticketPrice ?></h4>
        <h5 id="serviceFeeCost">Service Fee</h5><h4>$ <?php echo $ticketPrice * .05 ?></h4>
        <h5 id="totalCost" class='total'>Total</h5><h1><?php echo $ticketPrice + ($ticketPrice * .05) ?></h1>
    </div>

    <form class="form" action="buyer_delivery.php" method="GET">

        <h3 class="text-center">Delivery Info</h3>

        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="full-name">Full Name (First, Last):</label>
                    <input class="form-control" name="full-name" id="full-name" type="text" placeholder="Full Name" required>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input class="form-control" name="email" id="email" type="email" placeholder="email" required>
                </div>
            </div>
        </div>


        <script>
            // This example displays an address form, using the autocomplete feature
            // of the Google Places API to help users fill in the information.

            // This example requires the Places library. Include the libraries=places
            // parameter when you first load the API. For example:
            // <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">

            var placeSearch, autocomplete;
            var componentForm = {
                street_number: 'short_name',
                route: 'long_name',
                locality: 'long_name',
                administrative_area_level_1: 'short_name',
                postal_code: 'short_name'
            };

            function initAutocomplete() {
                // Create the autocomplete object, restricting the search to geographical
                // location types.
                autocomplete = new google.maps.places.Autocomplete(
                    /** @type {!HTMLInputElement} */(document.getElementById('autocomplete')),
                    {types: ['geocode']});

                // When the user selects an address from the dropdown, populate the address
                // fields in the form.
                autocomplete.addListener('place_changed', fillInAddress);
            }

            function fillInAddress() {
                // Get the place details from the autocomplete object.
                var place = autocomplete.getPlace();

                for (var component in componentForm) {
                    document.getElementById(component).value = '';
                    document.getElementById(component).disabled = false;
                }

                // Get each component of the address from the place details
                // and fill the corresponding field on the form.
                for (var i = 0; i < place.address_components.length; i++) {
                    var addressType = place.address_components[i].types[0];
                    if (componentForm[addressType]) {
                        var val = place.address_components[i][componentForm[addressType]];
                        document.getElementById(addressType).value = val;
                    }
                }
            }

            // Bias the autocomplete object to the user's geographical location,
            // as supplied by the browser's 'navigator.geolocation' object.
            function geolocate() {
                if (navigator.geolocation) {
                    navigator.geolocation.getCurrentPosition(function(position) {
                        var geolocation = {
                            lat: position.coords.latitude,
                            lng: position.coords.longitude
                        };
                        var circle = new google.maps.Circle({
                            center: geolocation,
                            radius: position.coords.accuracy
                        });
                        autocomplete.setBounds(circle.getBounds());
                    });
                }
            }
        </script>

        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBG8qGQLshrWPzNOsg_JnzIMCbVYqW0-QY&libraries=places&callback=initAutocomplete"
                async defer></script>


        <div class="form-group" id="locationField">
            <label for="locationField">Enter Address Here:</label>
            <input class="form-control" id="autocomplete" placeholder="Enter your address here" onFocus="geolocate()" type="text"></input>
        </div>
        <div class="row">
            <div class="col-xs-12 col-sm-4">
                <div class="form-group">
                    <label for="street_number">Apt/House #:</label>
                    <input class="form-control" id="street_number" name="street_number" disabled="true" placeholder="#"></input>
                </div>
            </div>
            <div class="col-xs-12 col-sm-8">
                <div class="form-group">
                    <label for="route">Street:</label>
                    <input class="form-control" id="route" name="route" disabled="true" placeholder="Street"></input>
                </div>
            </div>

        </div>

        <div class="row">
            <div class="col-xs-12 col-sm-6">
                <label for="locality">City:</label>
                <div><input class="form-control" id="locality" name="locality" disabled="true" placeholder="City"></input></div>
            </div>

            <div class="col-sm-3">
                <label for="administrative_area_level_1">State:</label>
                <div><input class="form-control" id="administrative_area_level_1" name="administrative_area_level_1" disabled="true" placeholder="State" maxlength="2"></input></div>
            </div>

            <div class="col-sm-3">
                <label for="postal_code">Zip Code:</label>
                <div><input class="form-control" id="postal_code" name="postal_code" disabled="true" placeholder="Zip" maxlength="5"></input></div>
            </div>
        </div>

        <br>
        <br>

        <h3 class="text-center">Payment Info</h3>

        <div class="row">
        <div class="form-group">
            <div class="col-sm-6">
                <label for="first-name-billing">First Name</label>
                <input class="form-control" name="first-name-billing" id="first-name-billing" type="text" placeholder="Enter First Name" required>
            </div>

            <div class="col-sm-6">
                <label for="last-name-billing">Last Name</label>
                <input class="form-control" name="last-name-billing" id="last-name-billing" type="text" placeholder="Enter Last Name" required>
            </div>
        </div>
        </div>

        <div class="row">
        <div class="form-group">
            <div class="col-sm-6">
                <label for="card-number">Card Number:</label>
                <input type='text' onkeypress='return event.charCode >= 48 && event.charCode <= 57' maxlength="16" id='card-number' name='card-number' placeholder='1234 1234 1234 1234'
                            title='Card Number' class="form-control" required value = '<?php if ($submitbutton) {echo "$number"; } ?>'>
                            <?php 
                        if ($submitbutton){
                        if (validatecard($number) == false)
                {
                    echo " <red>This credit card number is invalid</red>";
                }
            }
                ?>
            </div>

            <div class="col-sm-3">
                <label class="control-label" for="expire-month">Expire Month:</label>
                <div>
                    <select class="form-control" name="expire-month" id="expire-month">
                        <option>Jan</option>
                        <option>Feb</option>
                        <option>Mar</option>
                        <option>Apr</option>
                        <option>May</option>
                        <option>Jun</option>
                        <option>Jul</option>
                        <option>Aug</option>
                        <option>Sep</option>
                        <option>Oct</option>
                        <option>Nov</option>
                        <option>Dec</option>
                    </select>
                </div>
            </div>


            <div class="col-sm-3">
                <label class="control-label" for="expire-year">Expire Year:</label>
                <div>
                    <select class="form-control" name="expire-year" id="expire-year">
                        <script>
                            var myDate = new Date();
                            var year = myDate.getFullYear();
                            for(var i = 2017; i < year + 25; i++){
                                document.write('<option value="'+i+'">'+i+'</option>');
                            }
                        </script>
                    </select>
                </div>
            </div>
        </div>
        </div>
        <br>
        <div class="row">
        <div class="form-group">
            <div class="col-sm-12">
                <button id="submit-data" type="submit" class="btn btn-default">Submit</button>
                <button id="reset-data" type="reset" class="btn btn-default">Reset</button>
            </div>
        </div>
        </div>

    </form>

</section>

<script src="vendor/jquery/jquery.js"></script>
<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
<script src="js/grayscale.min.js"></script>

<script src="https://fonts.googleapis.com/css?family=Playfair+Display|Quicksand:400,700|Open+Sans|PT+Mono"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js"></script>


</body>

<!-- Footer -->
<footer>
    <div class="container text-center">
        <p>Copyright &copy; ETES 2017</p>
    </div>
</footer>
</html>
