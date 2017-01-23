<!-- External stylesheet -->
<link rel="stylesheet" type="text/css" href="style.css">

<!-- Fonts: -->
<link href="https://fonts.googleapis.com/css?family=Chewy" rel="stylesheet">
<?php
  // Start the session
  require_once('startsession.php');

  // Insert the page header
  $page_title = 'FriendTopic';
  require_once('header.php');

  // Constants:
  require_once('appvars.php');

  // Database connection variables:
  require_once('dbconnect.php');

  // Connect to the database 
  $dbc = db_connect();

  // Set the encoding...
  mysqli_set_charset($dbc, 'utf8');

?>
<div class="wrapper">

<?php 
    
    // If user is logged in, display link:
    if(isset($_SESSION['user_id'])){
      // Delete all messages to start:
      require_once("deleteAllMessages.php");
  ?>

<!-- Stack the columns on mobile by making one full-width and the other half-width -->
<div class="row">
  <div id="div1" class="col-xs-12 col-md-8">
    <h1>Chat</h1>
    <a id="ChatLinks" href="state.php"><h3>State chat</h3></a>
    <a id="ChatLinks" href="city.php"><h3>City/State Chat</h3></a>
    <a id="ChatLinks" href="topics.php"><h3>USA Topic Chat</h3></a>
  </div>

  <div class="col-xs-6 col-md-4">  
    <img id="imgCoffeeShop600Index" src="images/coffeeShopLaptop600.png"/>
  </div>
</div>

<!-- Columns start at 50% wide on mobile and bump up to 33.3% wide on desktop -->
<div class="row">
  <div class="col-xs-6 col-md-4">

  </div>

  <div class="col-xs-6 col-md-4">

  </div>
  <div class="col-xs-6 col-md-4"></div>
</div>

<!-- Columns are always 50% wide, on mobile and desktop -->
<div class="row">
  <div class="col-xs-6"></div>
  <div class="col-xs-6"></div>
</div>
</div>

</div>

  <?php
    }
      // If user is not logged in, just display topic w/ no link:
      else{
  ?>


<!-- Stack the columns on mobile by making one full-width and the other half-width -->
<div class="row">
  <div id="div1" class="col-xs-12 col-md-8">
    <h1>Chat</h1>
    <h3>State chat</h3>
    <h3>City/State Chat</h3>
    <h3>USA Topic Chat</h3>
  </div>

  <div class="col-xs-6 col-md-4">  
    <img id="imgCoffeeShop600Index" src="images/coffeeShopLaptop600.png"/>
  </div>
</div>

<!-- Columns start at 50% wide on mobile and bump up to 33.3% wide on desktop -->
<div class="row">
  <div class="col-xs-6 col-md-4">

  </div>

  <div class="col-xs-6 col-md-4">

  </div>
  <div class="col-xs-6 col-md-4"></div>
</div>

<!-- Columns are always 50% wide, on mobile and desktop -->
<div class="row">
  <div class="col-xs-6"></div>
  <div class="col-xs-6"></div>
</div>
</div>

</div>

    <?php
      }

    ?>


<?php
  mysqli_close($dbc);

  // Insert the page footer
  require_once('footer.php');
?>

