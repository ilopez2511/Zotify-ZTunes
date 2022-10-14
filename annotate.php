<?php 
    session_start();
    include 'User.php';
    include 'Song.php';
    include 'helper.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Annotate your song!</h1>
    <?php
        //Save the name of the song we'll annotate in a session variable.
        $song_name = $_POST['annotate'];
        $_SESSION['current_song'] = $song_name;
        echo "<b>$song_name</b>" . "<br>"; 
    ?>
    <div>
        <form action="userpage.php" method="post">
            Write your annotation:<input type="text" name="annotated">
            <br>
            <input type="submit" value="submit">
        </form>
    </div>
        
</body>
</html>