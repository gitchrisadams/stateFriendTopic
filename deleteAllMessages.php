<?php
// Start the session
require_once('startsession.php');

// Database connection variables:
require_once('dbconnect.php');

$dbcDelete = db_connect();

// Set the encoding...
mysqli_set_charset($dbcDelete, 'utf8');

// Get the current username:
$username = $_SESSION['username'];

// Start by deleting all chat messages to start:
$queryDeleteAllMessages = "DELETE FROM messages 
    WHERE username=" . "'" . $username . "'";

$queryDeleteAllMessagesState = "DELETE FROM messagestate 
WHERE username=" . "'" . $username . "'";

$queryDeleteAllMessagesCity = "DELETE FROM messagescity
WHERE username=" . "'" . $username . "'";

// Run query to delete all messags from user:
mysqli_query($dbcDelete, $queryDeleteAllMessages);
mysqli_query($dbcDelete, $queryDeleteAllMessagesState);
mysqli_query($dbcDelete, $queryDeleteAllMessagesCity);

?>