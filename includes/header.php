<?php
include("includes/config.php");
include("includes/classes/Artist.php"); 
include("includes/classes/Album.php"); 
include("includes/classes/Song.php"); 

// session_destroy(); //LOGOUT MANUALLY

    if(isset($_SESSION['userLoggedIn'])) {
        $userLoggedIn = $_SESSION['userLoggedIn'];
    }
    else {
        header("Location: register.php");
    }
?>

<html>
<head>
    <title>Welcome to Stacatto</title>
    <link rel="stylesheet" type="text/css" media="screen" href="assets/css/style.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="assets/js/script.js"></script>
</head>
<body>
    <div id="mainContainer">
        <div id="topContainer">
            <?php include("includes/navBar.php"); ?>
            <div id="mainViewContainer">
                <div id="mainContent">