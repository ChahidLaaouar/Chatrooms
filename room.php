<?php 
    session_start();
    require 'database.php';
 ?> 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Chatrooms</title>
    <link rel="stylesheet" href="Css/style.css">
</head>
<body>
    <div class="header">
        <img class="logo" src="img/cr-logo.png">
        <h1>The Chatrooms</h1>
        <form action="info.php">
            <input type="submit" class="backgroundbutton" value="Info">
        </form>
    </div>


    <div class='container'>
        <?php
            displayChat($conn);
        ?>

        <form action="database.php" method="post">
            <input type="text" name="textfield" maxlength="30" required>
            <input type="submit" name="sendtext"> 
        </form>

    </div>
