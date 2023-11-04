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