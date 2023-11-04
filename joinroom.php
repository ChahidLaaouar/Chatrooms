<?php
require 'database.php';
session_start();

//Als de knop is gedrukt wordt de informatie opgeslagen in een globale variabel.
if (isset($_POST['joinroom'])) {
    $_SESSION["room_id"] = $_POST['room_id'];

    header('Location: room.php');
}

//Als de knop niet is gedrukt wordt de gebruiker afgewezen
if (!isset($_POST['roomsubmit'])) {
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
</head>
<body>
    <div class="header">
        <img id="logo" src="img/cr-logo.png">
        <h1>The Chatrooms</h1>
        <form action="index.php">
            <input type="submit" class="backgroundbutton" value="Home">
        </form>
    </div>


    <div class='container'>
        <form method="post" action="">
            <div class="form-container">
                
                <input type="hidden" name="room_id" value="<?=$_POST['roomid'];?>"> 
                <label for="name">Username: </label>
                <input type="text" name="username" maxlength="10" required class="texts"> 

            <input class="backgroundbutton" type="submit" name="joinroom" value="Join Room">
            
        </form>   
    </div>  
    
</body>
</html>