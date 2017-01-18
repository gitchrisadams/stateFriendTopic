<html>
<head>
   <!-- refresh every 5 seconds -->
   <meta http-equiv="refresh" content="5">
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

$currentTopicID = $_GET["topic_id"];

// Create query to get all the users logged in:
$queryAllUsersLoggedin = "SELECT DISTINCT messages.username, messages.topic_id FROM messages WHERE topic_id =" . $currentTopicID;

// Query database passing in our query:
$data = mysqli_query($dbc, $queryAllUsersLoggedin);

$arrayUsernames = array();




while($row = mysqli_fetch_array($data)){
    // Store all usernames logged in, into an array:
    $arrayUsernames[] = $row['username'];
}

foreach ($arrayUsernames as $value) {
    echo "<h3>user: " . $value . "<br></h3>";
}

$countUsers = count($arrayUsernames);
$currentUsers = 0;

// Get the users in chat from Database:
$queryNumUsersInDatabase = "SELECT numUsers FROM chatnumusers";

$NumUsersFromDatabase = mysqli_query($dbc, $queryNumUsersInDatabase);
$result = $dbc->query("SELECT numUsers FROM chatnumusers");
while ($r = $result->fetch_row()) {
    echo "Number of users in chat: " . $r[0];
    $currentUsers = $r[0];
}

if($currentUsers != $countUsers){
    echo '<script type="text/javascript">play_sound();</script>';
}


$queryNumUsers = 
'UPDATE chatnumusers SET numUsers=' . $countUsers . ' WHERE id=1';

mysqli_query($dbc, $queryNumUsers);



?>
</body>




</html>