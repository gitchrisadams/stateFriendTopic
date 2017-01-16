<html>
<head>
   <!-- refresh every 5 seconds -->
   <meta http-equiv="refresh" content="2">
</head>
<body>   
<?php
// Database connection variables:
require_once('dbconnect.php');

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
    echo "username: " . $value . "<br>";
}
?>
</body>
</html>