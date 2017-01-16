<html>
<head>
   <!-- refresh every 5 seconds -->
   <meta http-equiv="refresh" content="5">
</head>
<body>   
<?php
// Database connection variables:
require_once('dbconnect.php');

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

foreach ($arrayUsernames as $value) {
    echo "username: " . $value . "<br>";
}
?>
</body>


</html>