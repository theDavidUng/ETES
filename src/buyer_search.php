
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
    <!-- For datatables CSS -->
    <link rel="stylesheet" type="text/css" href="http://cdn.datatables.net/1.10.13/css/jquery.dataTables.min.css">

    <script src="http://code.jquery.com/jquery-1.12.4.js"></script>
<script src="vendor/jquery/jquery.js"></script>
<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
<script src="https://fonts.googleapis.com/css?family=Playfair+Display|Quicksand:400,700|Open+Sans|PT+Mono"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js"></script>
<script src="js/grayscale.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script type="text/javascript" charset="utf8" src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.7.1.min.js"></script>
<script type="text/javascript" charset="utf8" src="http://cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js"></script>


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
<input type = "text" name="search" style="display: none; position:absolute; TOP:120px; LEFT:150px; WIDTH:210px; HEIGHT:30px;" placeholder="Search Tickets">
   <!--  <h2 class="text-center">Search Page Placeholder</h2> -->

</section>

 
<img src="img/shoppingcart2.png" style="display: none; position:absolute; TOP:90px; RIGHT:170px; " width="70" height="70">




<div class = "container_dropdown" style="display: none; position:absolute; TOP:120px; LEFT:400px;" >
<div class="dropdown">
    <button class="btn btn-default dropdown-toggle" type="button" id="menu1" data-toggle="dropdown">Categories
    <span class="caret"></span></button>
    <ul class="dropdown-menu" role="menu" aria-labelledby="menu1">
      <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Music</a></li>
      <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Sports</a></li>
      <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Art & Theater</a></li>
      <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Family</a></li>
      <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Food</a></li>
      <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Academic & Tech</a></li>
      <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Miscellaneous</a></li>
      <li role="presentation" class="divider"></li>
    </ul>
  </div>
</div>


<?php

include('../connection.php');

$sql = "SELECT productID, eventName, eventDescription, eventCategory, ticketPrice, eventLocation, eventDate FROM Ticket_Products";

$response = mysqli_query($db, $sql);

?>

<table id="scroll" class="display" cellspacing="0" width="100%">
    <thead>
        <tr>
            <th>Ticket Number</th>
            <th>Ticket Name</th>
            <th>Description</th>
            <th>Event Location and Date</th>
            <th>Ticket Price</th>
        </tr>
         
    </thead>

    <tfoot>
        <tr>
            <th>Ticket Number</th>
            <th>Ticket Name</th>
            <th>Description</th>
            <th>Event Location and Date</th>
            <th>Ticket Price</th>
        </tr> 
    </tfoot>

    <tbody>
        <?php
            while($row = mysqli_fetch_array($response)){
                ?>
        <tr style="color:black;">
            <td><?=$row['productID']?></td>
            <td><?=$row['eventName']?></td>
            <td><?=$row['eventDescription'].$row['eventCategory']?></td>
            <td><?=$row['eventDate'].$row['eventLocation']?></td>
            <td><?=$row['ticketPrice']?></td>
        </tr>
        <?php
        }
        ?>
    </tbody>
   
</table>




<script>
    

    $(document).ready(function()
    {
    var table = $('#scroll').DataTable();
     
    $('#scroll tbody').on('click', 'tr', function () {
        var IDdata = table.row( this ).data();
        var realID = IDdata[0];
        //alert( 'You clicked on '+IDdata[0]+'\'s row' );

    location.href = "buyer_check_out.php?productID="+realID;

    });
    });
</script>






</body>

<!-- Footer -->
<footer>
    <div class="container" style="display:none; position:absolute; BOTTOM:0px; text-align:center;">
        <p>Copyright &copy; ETES 2017</p>
    </div>
</footer>
</html>

