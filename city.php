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

  // Auto logout after 5min:
  //require_once('autologout.php')

  // Connect to the database 
  $dbc = db_connect();

  // Set the encoding...
  mysqli_set_charset($dbc, 'utf8');


  // Create query to get topic names and users in each topic:
  // $query = 
  // "SELECT mismatch_topic.name, mismatch_user_topic.topic_id, COUNT(*) 
  // FROM mismatch_user_topic 
  // INNER JOIN mismatch_topic
  // ON mismatch_user_topic.topic_id = mismatch_topic.topic_id
  // GROUP BY mismatch_user_topic.topic_id
  // ORDER BY COUNT(*) DESC";
  
  $queryCity = "SELECT DISTINCT city, state 
  FROM mismatch_user  
  WHERE city !=" . 
  "\"\"" .   
  " ORDER BY city";

  $queryAllCity = 
  "SELECT city, state 
  FROM mismatch_user  
  WHERE city !=" . 
  "\"\"" .   
  " ORDER BY city";

  // Query database passing query to function in dbconnect.php:
  $data = mysqli_query($dbc, $queryCity);
  $data2 = mysqli_query($dbc, $queryAllCity);

  $cityArray = array();
  $nextItem = 0;
  while($row2 = mysqli_fetch_array($data2)){
    $cityArray[$nextItem] = $row2['city'];
    $nextItem++;
  }

?>
<div class="TenPxPaddingDiv jumbotron">
<h1>Cities</h1>

<?php 
  echo "<table>";
  while($row = mysqli_fetch_array($data)){
    $usersInCity=0;
    // If user is logged in, display link:
    if(isset($_SESSION['user_id'])){
    echo "<tr><td>";
    echo $row['city'] . ", " . $row['state'] . " "; 
    echo "</td>";
    // Loop through and display array for testing:
    foreach ($cityArray as $value) {
      if($value == $row['city']){
        $usersInCity++;
      }
    }
    echo "<td>";
    echo '<a href="cityViewTopic.php?city=' . 
    $row['city'] . 
    '&state=' .
    $row['state'] . 
    '">' . 
    "(" .  $usersInCity . ")" . 
    "</a>" . 
    "<br>";
    echo "</td></tr>";
    }
      // If user is not logged in, just display topic w/ no link:
      else{
        echo "<tr><td>";
        echo $row['city']; ?><?php echo "(" . $row["COUNT(*)"] . ")"; 
        echo "</td></tr>";

      }
  }
  echo "</table>";
    ?>

</div>

<?php
  mysqli_close($dbc);

  // Insert the page footer
  require_once('footer.php');
?>