<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<link rel="shortcut icon" href="images/chrisico.png" />

<!-- Google Fonts: -->
<link href="https://fonts.googleapis.com/css?family=Passion+One" rel="stylesheet">

<!-- Bootstrap -->
<link href="assets/css/bootstrap.css" rel="stylesheet">

<!-- Optional Bootstrap theme -->
<!-- <link href="assets/css/bootstrap-theme.css" rel="stylesheet"> -->

<!-- Latest compiled and minified Bootstrap JavaScript -->
<script src="assets/js/bootstrap.min.js"></script>

<!-- Font Awesome: -->
<link href="assets/css/font-awesome.min.css" rel="stylesheet">

<!-- JQuery: -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

<!-- JQuery UI -->
<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

<?php require_once("autologout.js"); ?>


  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<?php
  echo '<title>' . $page_title . '</title>';
?>

  <link rel="stylesheet" type="text/css" href="style.css" />
</head>
<body onload="set_interval()"
onmousemove="reset_interval()"
onclick="reset_interval()"
onkeypress="reset_interval()"
onscroll="reset_interval()">

<?php if (isset($_SESSION['username'])): ?>
<!-- Fixed navbar -->
    <div class="navbar navbar-default navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="index.html">FriendTopic</a>
        </div>
        <div class="navbar-collapse collapse navbar-right">
          <ul class="nav navbar-nav">
            <li class="active"><a href="index.html">HOME</a></li>
            <li><a href="#">CREATE TOPIC</a></li>
            <li><a href="#">PICK TOPICS</a></li>
            <li><a href="#">EDIT PROFILE</a></li>
            <li><a href="#">LOG OUT(test)</a></li>
            <li><a href="#">ABOUT/FAQ</a></li>
            
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </div>

 <?php else: ?> 
<!-- Fixed navbar -->
    <div class="navbar navbar-default navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="index.html">FriendTopic</a>
        </div>
        <div class="navbar-collapse collapse navbar-right">
          <ul class="nav navbar-nav">
            <li class="active"><a href="index.html">HOME</a></li>
            <li><a href="about.html">LOGIN</a></li>
            <li><a href="contact.html">SIGN UP</a></li>
            <li><a href="contact.html">ABOUT</a></li>
            
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </div>
<?php endif; ?>