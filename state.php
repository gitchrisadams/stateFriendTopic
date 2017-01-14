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
  // $query = 
  // "SELECT mismatch_topic.name, mismatch_user_topic.topic_id, COUNT(*) 
  // FROM mismatch_user_topic 
  // INNER JOIN mismatch_topic
  // ON mismatch_user_topic.topic_id = mismatch_topic.topic_id
  // GROUP BY mismatch_user_topic.topic_id
  // ORDER BY COUNT(*) DESC";
  
  $queryStates = "SELECT DISTINCT state FROM mismatch_user ORDER BY state";
  $queryAllSates = "SELECT state FROM mismatch_user ORDER BY state";


  // Query database passing query to function in dbconnect.php:
  $data = mysqli_query($dbc, $queryStates);
  $data2 = mysqli_query($dbc, $queryAllSates);

  $statesArray = array();
  $nextItem = 0;
  while($row2 = mysqli_fetch_array($data2)){
    $statesArray[$nextItem] = $row2['state'];
    $nextItem++;
  }

  // // Loop through and display array for testing:
  // foreach ($statesArray as $value) {
  //   echo "The value is: " . $value . "<br>";
  // }


?>
<div class="TenPxPaddingDiv jumbotron">
<h1>States</h1>


<?php 
  
  while($row = mysqli_fetch_array($data)){
    $usersInState=0;
    // If user is logged in, display link:
    if(isset($_SESSION['user_id'])){

    echo $row['state']; 

    // Loop through and display array for testing:
    foreach ($statesArray as $value) {
      if($value == $row['state']){
        $usersInState++;
      }
    }
    //echo " (" . $usersInState . ")" . "<br>";

    echo '<a href="stateViewTopic.php?state=' . $row['state'] . '">' . "(" .  $usersInState . ")" . "</a>" . "<br>";

    }
      // If user is not logged in, just display topic w/ no link:
      else{

        echo $row['name']; ?><?php echo "(" . $row["COUNT(*)"] . ")"; 


      }
  }
    ?>

</div>

<?php
  mysqli_close($dbc);

  // Insert the page footer
  require_once('footer.php');
?>