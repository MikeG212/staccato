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
    <!-- <script src=assets/js/script.js></script> -->
</head>
<body>
    <div id="mainContainer">
        <div id="topContainer">
            <?php include("includes/navBarContainer.php"); ?>
            <div id="mainViewContainer">
                <div id="mainContent">