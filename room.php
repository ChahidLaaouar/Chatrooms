<?php 
    session_start();
    require 'database.php';

     //Check eerst of de informatie van joinroom.php bestaat, dit voorkomt foutmeldingen
     if (!isset($_SESSION["room_id"])){
        exit(1);
    }
 ?> 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Chatrooms</title>
    <link rel="stylesheet" href="Css/style.css">
    <!-- breng de scroller naar beneden als default -->
    <script>
        function scrollBar(){
            document.getElementById('room').scrollTop = 9999999
        }
        window.onload = scrollBar
    </script>
    <meta http-equiv="refresh" content="10">
</head>
<body>
    <div class="header">
        <img class="logo" src="img/cr-logo.png">
        <h1>The Chatrooms</h1>
        <form action="index.php">
            <input type="submit" class="backgroundbutton" value="Home">
        </form>
    </div>

    <div class="container">

    <!-- Maak bepaalde nuttige roominfo zichtbaar voor de gebruiker -->
        <p>Current Username: <?=$_SESSION["username"]?></p>
        <?php
            //Haal info out de database
            $sql = "SELECT * FROM room WHERE id = " . $_SESSION["room_id"];;
            $roominfo = $conn->query($sql);
            foreach ($roominfo as $currentroominfo){
                echo "<p>Current room Name: " . $currentroominfo['name'] . "</p>";
            }
        ?>   
    </div>

    <div class='container' id='room'>
        <?php
            displayChat($conn);
        ?>

        

    </div>
    <form action="database.php" method="post">
            <input type="text" class="texts" name="textfield" maxlength="30" required>
            <br>
            <input type="submit" class="backgroundbutton" name="sendtext" value="Send Text"> 
    </form>
</body>
