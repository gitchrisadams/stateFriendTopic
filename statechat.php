<?php
// Start the session
require_once('startsession.php');

// Database connection variables:
require_once('dbconnect.php');

require_once('header.php');

require_once("autologout.js");

// Connect to the database 
$dbc = db_connect();

// Set the encoding...
mysqli_set_charset($dbc, 'utf8');

?>

<html>
<head>
<link rel="shortcut icon" href="images/chrisico.png" />

<!-- Latest compiled and minified CSS -->
<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous"> -->

<!-- Optional theme -->
<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous"> -->

<!-- Latest compiled and minified JavaScript -->
<!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script> -->

<!-- External stylesheet -->
<link rel="stylesheet" type="text/css" href="stylesChat.css">
    <title>Messenger</title>
</head>


<body onload="update(); set_interval();"
onmousemove="reset_interval()"
onclick="reset_interval()"
onkeypress="reset_interval()"
onscroll="reset_interval()">
<div id="whitebg"></div>

<?php 
// Get the current topic from GET:
$currentTopic = $_GET["state"];

// Get the current username:
$username = $_SESSION['username'];

require_once("deleteAllMessages.php");

// Display a message that user has entered the chat room:
$userHasEntered = $username . " has entered the chat room.";

$result = $dbc->prepare("INSERT INTO messagestate VALUES('',?,?,?)");
$result->bind_param("sss", $username, $userHasEntered, $currentTopic);
$result->execute();
mysqli_close($dbc);

?>
<script>alert("Warning, logging off, refreshing/leaving page will delete all your chat messages"); </script>

<div class="msg-container">

    <div class="header"><h1><?php echo $currentTopic ?> chat</h1></div>

    <div class="rightSide">
    <?php $refreshing = "refreshingState.php?topic_id=" . $currentTopic; ?>

     <iframe id='dynamic-content' frameborder="1" width="20" height=100 src='<?php echo $refreshing; ?>' ></iframe>
    </div>


    <div class="msg-area" id="msg-area"></div>
    <div class="bottom"><input type="text" name="msginput" class="msginput" id="msginput" onkeydown="if (event.keyCode == 13) sendmsg()" value="" placeholder="Enter your message here ... (Press enter to send message)"></div>
</div>
<script type="text/javascript">

var msginput = document.getElementById("msginput");
var msgarea = document.getElementById("msg-area");

function chooseusername() {
    var user = document.getElementById("cusername").value;
    document.cookie="messengerUname=" + user
    checkcookie()
}

function showlogin() {
    document.getElementById("whitebg").style.display = "inline-block";
    document.getElementById("loginbox").style.display = "inline-block";
}

function hideLogin() {
    document.getElementById("whitebg").style.display = "none";
    document.getElementById("loginbox").style.display = "none";
}

function checkcookie() {
    if (document.cookie.indexOf("messengerUname") == -1) {
        showlogin();
    } else {
        hideLogin();
    }
}

function getcookie(cname) {
    var name = cname + "=";
    var ca = document.cookie.split(';');
    for(var i=0; i<ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0)==' ') c = c.substring(1);
        if (c.indexOf(name) == 0) return c.substring(name.length,c.length);
    }
    return "";
}

function escapehtml(text) {
  return text
      .replace(/&/g, "&amp;")
      .replace(/</g, "&lt;")
      .replace(/>/g, "&gt;")
      .replace(/"/g, "&quot;")
      .replace(/'/g, "&#039;");
}

function update() {
    <?php $username = $_SESSION['username']; ?>

    // Store the username in php session in a javascript variable:
    var username = <?php echo json_encode($username); ?>;


    <?php $topicID = $_GET['state']; ?>
    var currentTopic = <?php echo json_encode($topicID); ?>;

    var xmlhttp=new XMLHttpRequest();
    var output = "";

        xmlhttp.onreadystatechange=function() {
            console.log("ReadyState: " + xmlhttp.readyState + '\n');
            console.log("httpStatus: " + xmlhttp.status + '\n\n');
            if (xmlhttp.readyState==4 && xmlhttp.status==200) {
                var response = xmlhttp.responseText.split("\n")
                var rl = response.length
                var item = "";
                for (var i = 0; i < rl; i++) {
                    item = response[i].split("\\")
                    if (item[1] != undefined) {
                        console.log("Value of item 1: " + item[1] + '\n');
                        console.log("Value of item 0: " + item[0] + '\n\n');
                        if (item[0] == username) {
                            output += "<div class=\"msgc\" style=\"margin-bottom: 30px;\"> <div class=\"msg msgfrom\">" + item[1] + "</div> <div class=\"msgarr msgarrfrom\"></div> <div class=\"msgsentby msgsentbyfrom\">Sent by " + item[0] + "</div> </div>";
                        } else {
                            output += "<div class=\"msgc\"> <div class=\"msg\">" + item[1] + "</div> <div class=\"msgarr\"></div> <div class=\"msgsentby\">Sent by " + item[0] + "</div> </div>";
                        }
                    }
                }

                msgarea.innerHTML = output;
                msgarea.scrollTop = msgarea.scrollHeight;

            }
        }

          xmlhttp.open("GET","get-messagesState.php?username=" + username
            + "&topic_id=" + currentTopic
            ,true);

          xmlhttp.send();
}

function sendmsg() {
    <?php $username = $_SESSION['username']; ?>

    // Store the username in php session in a javascript variable:
    var username = <?php echo json_encode($username); ?>;

    <?php $topicID = $_GET['state']; ?>
    var currentTopic = <?php echo json_encode($topicID); ?>;

    var message = msginput.value;
    if (message != "") {

        var xmlhttp=new XMLHttpRequest();

        xmlhttp.onreadystatechange=function() {
            if (xmlhttp.readyState==4 && xmlhttp.status==200) {
                message = escapehtml(message);
                msgarea.innerHTML += "<div class=\"msgc\" style=\"margin-bottom: 30px;\"> <div class=\"msg msgfrom\">" + message + "</div> <div class=\"msgarr msgarrfrom\"></div> <div class=\"msgsentby msgsentbyfrom\">Sent by " + username + "</div> </div>";
                msginput.value = "";
            }
        }

          xmlhttp.open("GET","update-messagesState.php?username=" + username 
            + "&message=" + message
            + "&topic_id=" + currentTopic
            ,true);

          xmlhttp.send();

    }

}

setInterval(function(){ update() }, 2500);
</script>
</body>
</html>