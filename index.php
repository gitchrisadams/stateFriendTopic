<!-- External stylesheet -->
<link rel="stylesheet" type="text/css" href="style.css">

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

  // Show the navigation menu
  require_once('navmenu.php');

  // Auto logout after 5min:
  //require_once('autologout.php')

  // Connect to the database 
  $dbc = db_connect();

  // Set the encoding...
  mysqli_set_charset($dbc, 'utf8');


  // Create query to get topic names and users in each topic:
  $query = 
  "SELECT mismatch_topic.name, mismatch_user_topic.topic_id, COUNT(*) 
  FROM mismatch_user_topic 
  INNER JOIN mismatch_topic
  ON mismatch_user_topic.topic_id = mismatch_topic.topic_id
  GROUP BY mismatch_user_topic.topic_id
  ORDER BY COUNT(*) DESC";

  // Query database passing query to function in dbconnect.php:
  $data = mysqli_query($dbc, $query);

?>
<div class="TenPxPaddingDiv jumbotron">
<h1>Chat</h1>


<?php 
    
    // If user is logged in, display link:
    if(isset($_SESSION['user_id'])){
  ?>
          <br>
          <a href="state.php"><h3>State chat</h3></a>
          <br>
          <a href="city.php"><h3>City/State Chat</h3></a>
          <br>
          <a href="topics.php"><h3>USA Topic Chat</h3></a>
          <br>

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