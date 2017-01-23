<?php
  // Start the session
  require_once('startsession.php');

  // Insert the page header
  $page_title = 'View States';
  require_once('header.php');

  require_once('appvars.php');
  
  // Database connection variables:
  require_once('dbconnect.php');

  // Make sure the user is logged in before going any further.
  if (!isset($_SESSION['user_id'])) {
    echo '<p class="login">Please <a href="login.php">log in</a> to access this page.</p>';
    exit();
  }

// Connect to the database 
$dbc = db_connect();

// Store topic name and id from the GET data:
$stateID = $_GET['state'];


?>
<div class="TenPxPaddingDiv">

<!-- Output the name of the current Topic -->
<?php echo '<h1><a href="statechat.php?state=' . $stateID .'">' . 'Chat in ' . $stateID . '<br></a></h1>'; ?>

<h1>Users from <?php echo $stateID; ?>:</h1>

<!-- TODO: List the users from this topic that are in the database: -->
<?php
  // $queryAllUsersTopicAndInfo = 
  //   "SELECT mismatch_user_topic.user_id, mismatch_user_topic.topic_id,
  //     mismatch_user.user_id, mismatch_user.username,
  //     CONCAT_WS(' ', mismatch_user.first_name, mismatch_user.last_name) AS 'whole_name',
  //     mismatch_user.gender, 
  //     CONCAT_WS(', ', mismatch_user.city, mismatch_user.state) AS 'city_state',
  //     mismatch_user.picture, mismatch_user.chat_status
  //     FROM mismatch_user_topic
  //     INNER JOIN mismatch_user
  //     ON mismatch_user_topic.user_id = mismatch_user.user_id
  //     WHERE state =" . $stateID .  " ORDER BY mismatch_user.chat_status DESC, 
  //     mismatch_user.last_name" ;


  $queryAllUsersAndStates = 
  "SELECT states.stateCode,
      mismatch_user.user_id, mismatch_user.username,
      CONCAT_WS(' ', mismatch_user.first_name, mismatch_user.last_name) AS 'whole_name',
      mismatch_user.gender, 
      CONCAT_WS(', ', mismatch_user.city, mismatch_user.state) AS 'city_state',
      mismatch_user.picture, mismatch_user.chat_status
      FROM states
      INNER JOIN mismatch_user
      ON states.stateCode = mismatch_user.state
      WHERE state =" . "'" . $stateID . "' " . "ORDER BY mismatch_user.chat_status DESC, 
      mismatch_user.last_name";

  // Store/execute query:
  $dataAllUsersInTopic = mysqli_query($dbc, $queryAllUsersAndStates);

  while ($row = mysqli_fetch_array($dataAllUsersInTopic)){ 
    echo 'Username: ' . $row['username'] . '<br>';
    echo 'Name: ' . $row['whole_name'] . '<br>';
    echo 'Gender: ' . $row['gender'] . '<br>';
    echo 'city/state: ' . $row['city_state'] . '<br>';

    // Determine chat availability:
    if($row['chat_status']){
      echo '<a href="statechat.php?topic_name=' . $stateID . 
      '">chat status: Online<br></a>'; 
    }else{
      echo "chat status: Offline<br>";
    }

    // If the image is there, display it, otherwise display the placeholder
    // 'no image' image.
    if(!empty($row['picture'])){
      echo '<img class="profile" src="' . MM_UPLOADPATH . $row['picture'] . 
        '" alt="Profile Picture" /><br><br><br>';
    }else{
      echo '<img class="profile" src="' . MM_UPLOADPATH . 'nopic.jpg' . 
        '" alt="No Profile Picture" /><br><br><br>';
    }

  }


?>
</div>
<?php
  // Insert the page footer
  require_once('footer.php');
?>
