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

$currentTopicID = $_GET["topic_id"];

// Create query to get all the users logged in:
$queryAllUsersLoggedin = "SELECT DISTINCT messages.username, messages.topic_id FROM messages WHERE topic_id =" . $currentTopicID;

// Query database passing in our query:
$data = mysqli_query($dbc, $queryAllUsersLoggedin);

// Array to hold logged in users:
$arrayUsernames = array();

// Loop through and store logged in users in the array:
while($row = mysqli_fetch_array($data)){
    $arrayUsernames[] = $row['username'];
}

// Output each logged in user:
foreach ($arrayUsernames as $value) {
    echo "<h3>user: " . $value . "<br></h3>";
}

// Get a count of the number of users loggedin to this topic:
$countUsers = count($arrayUsernames);

// Get the number of users in chat from Database:
$queryNumUsersInDatabase = "SELECT numUsers FROM chatnumusers WHERE topic_id=" . $currentTopicID;
$NumUsersFromDatabase = mysqli_query($dbc, $queryNumUsersInDatabase);

// Create var to store the current num of users:
$currentUsers = 0;

// Get the number of users in chat from db again
// and keep track of total users in database:
//$result = $dbc->query("SELECT numUsers FROM chatnumusers");
while ($r = $NumUsersFromDatabase->fetch_row()) {
    echo "Number of users in chat: " . $r[0];
    $currentUsers = $r[0];

}

// If the number of users in database is 0
// then topic is not in the database yet so
// create it:
if($currentUsers == 0){
    $queryNumUsersInsert = 
    "INSERT INTO chatnumusers(`id`, `numUsers`, `topic_id`) VALUES (NULL, '0', " . $currentTopicID . ")";
    mysqli_query($dbc, $queryNumUsersInsert);
}

if($currentUsers != $countUsers){
    echo '<script type="text/javascript">play_sound();</script>';
}

// Update database with new number of users in chat:
$queryNumUsers = 
'UPDATE chatnumusers SET numUsers=' . $countUsers . ' WHERE topic_id=' . $currentTopicID;

mysqli_query($dbc, $queryNumUsers);




?>
</body>




</html>