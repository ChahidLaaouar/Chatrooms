<?php 
    require 'database.php';
 ?> 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Chatrooms</title>
    <link rel="stylesheet" href="Css/style.css">
    <meta http-equiv="refresh" content="30">
</head>
<body>
    <div class="header">
        <img id="logo" src="img/cr-logo.png">
        <h1>The Chatrooms</h1>
        <form action="info.php">
            <input type="submit" class="backgroundbutton" value="Info">
        </form>
    </div>

    <div class='container'>

        <h2><?=displayRoomsAmount($rooms)?> Rooms</h2>

        <form method="post" action="createroom.php">
            <input class="button" type="submit" name="newroom" value="New Room">
        </form>   
             
        <?php
            displayRooms($rooms);
        ?>
        
    </div>  
    
</body>
</html>