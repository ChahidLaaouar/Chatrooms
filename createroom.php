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
                <label for="name">Chatroom Name: </label>
                <input type="text" name="name" maxlength="30" required class="texts">
            
                <label for="tags">Add tag:</label>
                <select name="tags" class="texts" required>
                    <option value="Gaming">Gaming</option>
                    <option value="School">School</option>
                    <option value="Hobbies">Hobbies</option>
                    <option value="Life">Life</option>
                    <option value="Technology">Technology</option>
                    <option value="Learning">Learning</option>
                    <option value="Adventure Travel">Adventure Travel</option>
                    <option value="Cooking">Cooking</option>
                    <option value="News">News</option>
                    <option value="Fitness">Fitness</option>
                </select>
            </div>
            
            <br>

            <input class="backgroundbutton" type="submit" name="createroom" value="Create Room">
            
        </form>   
    </div>  
    
</body>
</html>