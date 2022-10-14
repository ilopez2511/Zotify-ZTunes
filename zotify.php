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
    <h1>Welcome to Zotify</h1>
    <form method="post">
        <p>Song 4<button name="song" value="Song 4" style="margin-left: 10px;">Purchase song</button> </p>
        <p>Song 5<button name="song" value="Song 5" style="margin-left: 10px;">Purchase song</button> </p>
        <p>Song 6<button name="song" value="Song 6" style="margin-left: 10px;">Purchase song</button> </p>
    </form>
    <?php
        if(isset($_POST['song'])) {
            //Create a song instance;
            $song = new Song();
            $song->set_name($_POST['song']);
            //Retrive $_POST array from sessions and create user instance.
            $post_vals = $_SESSION['post'];
            $key = $post_vals['username'];
            $user = unserialize($_SESSION[$key]);
            //Add a new song to the current user library by feeding song and user.
            $updated_user = add_song_to_library($song,$user);
            $_SESSION[$key] = $updated_user;
            echo $song->get_name() . " has been added to playlist.";
        }
    ?>
    <form action="userpage.php">
        <input type="submit" value="User Home">
    </form>
</body>
</html>