<?php session_start();

$TPclientID = $_SESSION['clientID'];
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
        table {
            border-collapse: collapse;
            border-spacing: 0;
            width: 100%;
            border: 1px solid #ddd;
        }

        th, td {
            border: none;
            text-align: left;
            padding: 8px;
        }

        tr:nth-child(even){background: rgba(255, 255, 255, 0.1)}
        body { padding-top: 20px; }
        section {padding-top: 70px;}
        .button_section{
            padding-left: 100px
        }
     
        form {
            /* Just to center the form on the page */
            margin-top:  10px;
            width: 500px;
            /* To see the outline of the form */
            padding-left: 200px
            padding-top: 200px;
            border: 1px solid #CCC;
            text-align: left;

        }

        input:focus, textarea:focus {
            /* To give a little highlight on active elements */
            border-color: #000;
        }


        #editProfile{display:none;}
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
                    <a class="page-scroll" href="logout.php">Logout</a>
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

<section>
</section>

<section id = "button_section">
    <script type="text/javascript">
        <!--
        function toggle_visibility(id) {
            var e = document.getElementById(id);
            if(e.style.display == 'block')
                e.style.display = 'none';
            else
                e.style.display = 'block';
        }


        //-->
    </script>
     <div class="row">
        <div class="button_section">
            <div class="col-sm-12">
            <a href="seller_add_modify_item.html" type="submit" class="btn btn-default">Add Product</a>
            <a href="#editProfile" onclick="toggle_visibility('editProfile')" type="submit" class="btn btn-default"> Edit Profile</a>
            </div>
        </div>
    </div>


</section>


<section id="sellerMain">

    <div class="container" style="overflow-x:auto;">
        <h5 align="center">Available Tickets On Your Account</h5>
        <?php
        include("../connection.php");

        //Getting tickets listing from certain seller
        $sql = "SELECT eventName, eventDate, eventLocation, numberOfTickets FROM `Ticket_Products` WHERE TPclientID = " . $TPclientID;
        $response = $db->query($sql);

        if ($response->num_rows > 0)  {
            echo "<table><tr><th>Event Name</th><th>Date</th><th>Location</th><th>Quantity</th></tr>";
            // output data of each row
            while($row = $response->fetch_assoc()) {
                echo "<tr><td>".$row["eventName"]."</td><td>".$row["eventDate"]."</td><td>".$row["eventLocation"]."</td><td>".$row["numberOfTickets"]."</td></tr>";
            }
            echo "</table>";
        } else {
            echo "<table><tr><th>Event Name</th><th>Date</th><th>Location</th><th>Quantity</th></tr>";
            echo "<tr><td>No available tickets found.</td><td></td><td></td><td></td></tr>";
            echo "</table>";
        }
        mysqli_close($db);
        ?>
    </div>

    <p></p>

    <?php
    include("../connection.php");

    //Getting seller information
    $sql_query = "SELECT firstName, lastName, username, email, streetAddress, city, zipCode, state, phoneNumber, creditCardNumber FROM User WHERE clientID = " . $TPclientID;
    $response = @mysqli_query($db, $sql_query);
    $row = mysqli_fetch_array($response);
    $firstName = $row['firstName'];
    $lastName = $row['lastName'];
    $username = $row['username'];
    $email = $row['email'];
    $streetAddress = $row['streetAddress'];
    $city = $row['city'];
    $zipCode = $row['zipCode'];
    $state = $row['state'];
    $phoneNumber = $row['phoneNumber'];
    $creditCardNumber = $row['creditCardNumber'];

    mysqli_close($db);
    ?>
    <div id='editProfile'; align = "center"; display="none">
        <h3 align="center">Update Profile</h3>
            <form class="form" action="editProfile.php" method="GET">
                <div class="row">
                    <div class="col-xs-12 col-sm-6">
                        <div class="form-group">
                            <input type="text" class="form-control" name='first_name' id="first_name" required autocomplete="off" value="<?php echo $firstName?>">
                            <p class="help-block text-danger"></p>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-6">
                        <div class="form-group">
                            <input type="text" class="form-control" name="last_name" id="last_name" required autocomplete="off" value="<?php echo $lastName?>">
                            <p class="help-block text-danger"></p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 col-sm-6">
                        <div class="form-group">
                            <input type="text" class="form-control" name="email" id="email" required autocomplete="off" value="<?php echo $email?>">
                            <p class="help-block text-danger"></p>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-6">
                        <div class="form-group">
                            <input type="text" class="form-control" name="phone" id="phone" required autocomplete="off" value="<?php echo $phoneNumber?>">
                            <p class="help-block text-danger"></p>
                        </div>
                    </div>
                </div>


                <div class="row">
                    <div class="col-xs-12 col-sm-6">
                        <div class="form-group">
                            <input type="text" class="form-control" name="username" id="username" placeholder="Username [<?php echo $username?>] can't be changed" disabled=True>
                            <p class="help-block text-danger"></p>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-6">
                        <div class="form-group">
                            <input type="text" class="form-control" name="password" id="password" required autocomplete="off" placeholder="Password">
                            <p class="help-block text-danger"></p>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" onkeypress='return event.charCode >= 48 && event.charCode <= 57' maxlength="16" name="creditcard" id="creditcard" required autocomplete="off" value="<?php echo $creditCardNumber?>">
                    <p class="help-block text-danger"></p>
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" name="street" id="street" required autocomplete="off" value="<?php echo $streetAddress?>">
                    <p class="help-block text-danger"></p>
                </div>

                <div class="row">
                    <div class="col-xs-12 col-sm-6">
                        <div class="form-group">
                            <input type="text" class="form-control" name="city" id="city" required autocomplete="off" value="<?php echo $city?>">
                            <p class="help-block text-danger"></p>
                        </div>
                    </div>

                    <div class="col-sm-3">
                        <input type="text" class="form-control" id="state_initial_delivery" name="state_initial_delivery" value="<?php echo $state?>" maxlength="2">
                    </div>
                    <div class="col-xs-12 col-sm-3">
                        <div class="form-group">
                            <input type="text" class="form-control" name="zip" id="zip" required autocomplete="off" value="<?php echo $zipCode?>">
                            <p class="help-block text-danger"></p>
                        </div>
                    </div>
                    <div class="col-sm-12" align="center">
                        <button id="submit-data" type="submit" class="btn btn-default">Submit</button>
                        <button id="reset-data" type="reset" class="btn btn-default">Reset</button>
                    </div>
            </form>
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
