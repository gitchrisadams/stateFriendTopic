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

  // Auto logout after 5min:
  //require_once('autologout.php')

  // Connect to the database 
  $dbc = db_connect();

  // Set the encoding...
  mysqli_set_charset($dbc, 'utf8');

?>

<div class="FiftyPxPaddingDiv">

<h1>Chat</h1>
<div>
<img class="floatRight" id="imgCoffeeShop600Index" src="images/coffeeShopLaptop600.png"/>

<?php 
    
    // If user is logged in, display link:
    if(isset($_SESSION['user_id'])){
      // Delete all messages to start:
      require_once("deleteAllMessages.php");
  ?>
          <br>
          <a id="ChatLinks" href="state.php"><h3>State chat</h3></a>
          <br>
          <a id="ChatLinks" href="city.php"><h3>City/State Chat</h3></a>
          <br>
          <a id="ChatLinks" href="topics.php"><h3>USA Topic Chat</h3></a>

          <br></div>

          <br class="clearFloat">
  <?php
    }
      // If user is not logged in, just display topic w/ no link:
      else{
  ?>
          <br>
          <h3>State chat</h3>
          <br>
          <h3>City/State Chat</h3>
          <br>
          <h3>USA Chat</h3>
          <br>

    <?php
      }

    ?>
</div>

<?php
  mysqli_close($dbc);

  // Insert the page footer
  require_once('footer.php');
?>