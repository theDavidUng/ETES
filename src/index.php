<?php
//include('login.php'); // Include Login Script
/*** begin our session ***/
session_start();


if ((isset($_SESSION['username']) != '')) 
{
header("Location: home.php");
}
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

</head>

<body id="page-top" data-spy="scroll" data-target=".navbar-fixed-top">

    <!-- Navigation -->
    <nav class="navbar navbar-custom navbar-fixed-top" role="navigation">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-main-collapse">
                    Menu <i class="fa fa-bars"></i>
                </button>
                <a class="navbar-brand page-scroll" href="#page-top">
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
                        <a class="page-scroll" href="#seller">Seller</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="#buyer">Buyer</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="#contact">Contact</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>

    <!-- Intro Header -->
    <header class="intro">
        <div class="intro-body">
            <div class="container">
                <div class="row">
                    <div class="col-md-8 col-md-offset-2">
                        <h1 class="brand-heading">ETES</h1>
                        <p class="intro-text">Welcome to the Electronic Ticket Exchange System</p>
                        <a href="#seller" class="btn btn-circle page-scroll">
                            <i class="fa fa-angle-double-down animated"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Seller Section -->
    <section id="seller" class="container content-section text-center">
        <h2>Seller</h2>
        <div id="form">
            <!-- Container -->
            <div class="container">
                <div class="col-lg-6 col-lg-offset-3">
                    <div id="userform">
                        <ul class="nav nav-tabs nav-justified" role="tablist">
                            <li class="active"><a href="#login"  role="tab" data-toggle="tab">LOGIN</a></li>
                            <li><a href="#signup"  role="tab" data-toggle="tab">SIGN UP</a></li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane fade active in" id="login">
                                <p></p>
                                <form id="login" method = "GET" action = "../login.php">
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="username" name = "username" required autocomplete="off" placeholder="Username">
                                            <p class="help-block text-danger"></p>
                                    </div>
                                    <div class="form-group">
                                        <input type="password" class="form-control" id="password" name = "password" required autocomplete="off" placeholder="Password">
                                            <p class="help-block text-danger"></p>
                                    </div>
                                    <div class="mrgn-30-top">
                                        <button type="submit" name = "submit" class="btn btn-default btn-lg">Log In</button>
                                        <?php $reasons = array("password" => "Wrong username or password"); if(isset($_GET["loginFailed"])) echo $reasons[$_GET["reason"]]; ?>
                                    </div>
                                </form>
                            </div>




                            <div class="tab-pane fade in" id="signup">
                                <p></p>
                                <form id="signup" method = "GET" action="../signUp.php">
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-6">
                                            <div class="form-group">
                                                <input type="text" class="form-control" id="first_name" name ="first_name" required autocomplete="off" placeholder="First Name">
                                                    <p class="help-block text-danger"></p>
                                                    </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-6">
                                            <div class="form-group">
                                                <input type="text" class="form-control" id="last_name" name = "last_name" required autocomplete="off" placeholder="Last Name">
                                                    <p class="help-block text-danger"></p>
                                                    </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-6">
                                            <div class="form-group">
                                                <input type="text" class="form-control" id="email" name = "email" required autocomplete="off" placeholder="Email">
                                                <p class="help-block text-danger"></p>
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-6">
                                            <div class="form-group">
                                                <input type="text" class="form-control" id="phone" name = "phone" required autocomplete="off" placeholder="Phone">
                                                <p class="help-block text-danger"></p>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="row">
                                        <div class="col-xs-12 col-sm-6">
                                            <div class="form-group">
                                                <input type="text" class="form-control" id="username" name = "username" required autocomplete="off" placeholder="Username">
                                                <p class="help-block text-danger"></p>
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-6">
                                            <div class="form-group">
                                                <input type="text" class="form-control" id="password"  name = "password" required autocomplete="off" placeholder="Password">
                                                <p class="help-block text-danger"></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" onkeypress='return event.charCode >= 48 && event.charCode <= 57' maxlength="16" class="form-control" id="creditcard" name = "creditcard" required autocomplete="off" placeholder="Credit Card: xxxx-xxxx-xxxx-xxxx">
                                        <p class="help-block text-danger"></p>
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
                                        <input class="form-control" id="autocomplete" placeholder="Enter your address here" onFocus="geolocate()" type="text"></input>
                                    </div>
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-4">
                                            <div class="form-group">
                                                <input class="form-control" id="street_number" name="street_number" disabled="true" placeholder="#"></input>
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-8">
                                            <div class="form-group">
                                                <input class="form-control" id="route" name="route" disabled="true" placeholder="Street"></input>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="row">
                                        <div class="col-xs-12 col-sm-6">
                                            <div><input class="form-control" id="locality" name="locality" disabled="true" placeholder="City"></input></div>
                                        </div>

                                        <div class="col-sm-3">
                                            <div><input class="form-control" id="administrative_area_level_1" name="administrative_area_level_1" disabled="true" placeholder="State" maxlength="2"></input></div>
                                        </div>

                                        <div class="col-sm-3">
                                            <div><input class="form-control" id="postal_code" name="postal_code" disabled="true" placeholder="Zip" maxlength="5"></input></div>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="mrgn-30-top">
                                        <button type="submit" name = "submit" class="btn btn-default btn-lg">Sign Up</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.container -->
        </div>
    </section>

    <!-- Buyer Section -->
    <section id="buyer" class="content-section text-center">
        <div class="download-section">
            <div class="container">
                <div class="col-lg-8 col-lg-offset-2">
                    <h2>Buyer</h2>
                    <form id="search">
                        <div class="form-group">
                            <a href="buyer_search.php" type="submit" class="btn btn-default btn-lg">Search for Tickets</a>
                    </form>


                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact" class="container content-section text-center">
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2">
                <h2>Contact ETES</h2>
                <p>Feel free to email us to as questions, provide some feedback, give us suggestions, or to just say hello!</p>
                <p><a href="#">feedback@etes.com</a>
                </p>
                <ul class="list-inline banner-social-buttons">
                    <li>
                        <a href="https://twitter.com/etescs160" class="btn btn-default btn-lg"><i class="fa fa-twitter fa-fw"></i> <span class="network-name">Twitter</span></a>
                    </li>
                    <li>
                        <a href="https://github.com/pgvinco19/CS160Group6" class="btn btn-default btn-lg"><i class="fa fa-github fa-fw"></i> <span class="network-name">Github</span></a>
                    </li>
                    <li>
                        <a href="https://plus.google.com/u/0/102817512952665973428" class="btn btn-default btn-lg"><i class="fa fa-google-plus fa-fw"></i> <span class="network-name">Google+</span></a>
                    </li>
                </ul>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <div class="container text-center">
            <p>Copyright &copy; ETES 2017</p>
        </div>
    </footer>

    <!-- jQuery -->
    <script src="vendor/jquery/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Plugin JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>

    <!-- Theme JavaScript -->
    <script src="js/grayscale.min.js"></script>

</body>
</html>
