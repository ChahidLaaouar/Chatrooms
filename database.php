<?php
//Database connectie
$servername = "localhost";
$username = "root";
$password = "";
$database = "chatrooms";


$conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);

$sql = "SELECT * FROM room";
$rooms = $conn->query($sql);


//Functie om de hele chathistory te laten zien
function displayChat($conn)
{
    
    //Haal informatie van joinroom.php
    $chatid = $_SESSION["room_id"];

    //Haal info out de database
    $sql = "SELECT * FROM room WHERE id = " . $chatid;
    $chat = $conn->query($sql);


    //Ik gebruik een foreach omdat de query een array teruggeeft
    foreach ($chat as $chat)
    {
        //Haal informatie van de Json file en decode het in een array
        $decodedchat = json_decode($chat['history'], true);

        //Loop door de hele Json file
        $allmessages = $decodedchat['messages'];
        for ($i = 0; $i < count($allmessages); $i++) {

            foreach ($allmessages[$i] as $messager => $message) {
                echo $messager . ": " . $message;
                echo "<br>";
            }
        }
    }
}

//Functie om alle rooms te tellen
function displayRoomsAmount($rooms)
{
    echo $rooms->rowCount();
}

//Functie om alle rooms te laten zien
function displayRooms($rooms)
{
    //Zet alle rooms in een tabel
    foreach ($rooms as $room){
        echo "<div>";
        echo "<table>";

            echo "<tr>";
            echo "<td><h3>Name</h3></td>";
            echo "<td>" . $room['name'] . "</td>";
            echo "</tr>";

            echo "<tr>";
            echo "<td><h3>Tag</h3></td>";
            echo "<td>" . $room['tag'] . "</td>";
            echo "</tr>";

            echo "<tr>";
            echo "<td><h3>Total Visits</h3></td>";
            echo "<td>" . $room['popularity'] . "</td>";
            echo "</tr>";
            echo "</table>";

            echo "<form method='post' action='joinroom.php'>";
            echo "<input type='hidden' name='roomid' value=" . $room['id'] . ">";
            echo "<td> <input type='submit' class='backgroundbutton' name='roomsubmit' value='Join'></td>";
            echo "</form>";
            echo "</div>";

    }
}

//createroom.php
//maak een nieuwe room
if (isset($_POST['createroom'])) {
    //haal de informatie om in de nieuwe tabel te stoppen
    $name = $_POST['name'];
    $tag = $_POST['tags'];
    $jsondata = file_get_contents('json/newdata.json');

    //de en encode de data zodat het de goede format heeft
    $decodeddata = json_decode($jsondata, true);
    $encodeddata = json_encode($decodeddata);

    //Maak de nieuwe room
    $sqlCreate = "INSERT INTO `room`(`name`, `popularity`, `tag`, `history`) VALUES ('$name', 0, '$tag', '$encodeddata')";
    $conn->exec($sqlCreate);

    header('Location: index.php');
} else



//room.PHP
//Als een bericht wordt verstuurd, wordt de .json geupdate
if (isset($_POST['sendtext'])) {

    session_start();
    //Haal informatie van de room.php
    $chatmessage = $_POST['textfield'];
    $chatmessager = $_SESSION["username"];
    $chatid = $_SESSION["room_id"];


    //Haal info out de database
    $sql = "SELECT * FROM room WHERE id = " . $chatid;
    $chathistory = $conn->query($sql);

    //Ik gebruik een foreach omdat de query een array teruggeeft
    foreach ($chathistory as $chathistory)
    {
        
        //Haal informatie van de Json file en decode het in een array
        $decodedhistory = json_decode($chathistory['history'], true);

        //Push de informatie in de Json array
        array_push($decodedhistory['messages'], array($chatmessager => $chatmessage));

        // Encode de array weer naar JSON string
        $encodedhistory = json_encode($decodedhistory, JSON_PRETTY_PRINT);

        // Zet de informatie weer terug
        $sqlUpdate= "UPDATE room SET history = '{$encodedhistory}' WHERE id = " . $chatid;
        $conn->exec($sqlUpdate);

    }

    header('Location: room.php');
}