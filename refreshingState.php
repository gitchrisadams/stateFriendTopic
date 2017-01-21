<html>
<head>
   <!-- refresh every 5 seconds -->
   <meta http-equiv="refresh" content="2">
</head>
<body>   
<?php
// Database connection variables:
require_once('dbconnect.php');

require_once('playSound.js');

// Connect to the database 
$dbc = db_connect();

// Set the encoding...
mysqli_set_charset($dbc, 'utf8');

$currentTopic = $_GET["topic_id"];

// Create query to get all the users logged in:
$queryAllUsersLoggedin = "SELECT DISTINCT messagestate.username, messagestate.topic_id FROM messagestate WHERE topic_id =" . "'" . $currentTopic . "'";


// Query database passing in our query:
$dataStateUsers = mysqli_query($dbc, $queryAllUsersLoggedin);

$arrayUsernames = array();

while($rowState = mysqli_fetch_array($dataStateUsers)){
    // Store all usernames logged in, into an array:
    $arrayUsernames[] = $rowState['username'];
}

// Output users in database:
foreach ($arrayUsernames as $value) {
    echo "username: " . $value . "<br>";
}

// Get a count of the number of users loggedin to this state:
$countUsers = count($arrayUsernames);
echo "Number of users in chat: " . $countUsers;

$currentUsers = 0;

// Get another count of users in database:
$queryAllUsersLoggedin2 = "SELECT DISTINCT messagestate.username, messagestate.topic_id FROM messagestate WHERE topic_id =" . "'" . $currentTopic . "'";
$dataStateUsers2 = mysqli_query($dbc, $queryAllUsersLoggedin2);

while ($dataStateUsers2->fetch_row()) {
    $currentUsers++;
}

if($currentUsers != $countUsers){
    echo '<script type="text/javascript">play_sound();</script>';
}



?>
</body>


</html>