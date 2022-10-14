<?php
    session_start();
    include 'User.php';
    include 'Song.php';
    include 'helper.php'
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
    <?php
        //Brings out the post array values and instantiates the current user to welcome them in.
        $post_vals = $_SESSION['post'];   
        $key = $post_vals['username'];
        $user = unserialize($_SESSION[$key]);
        $name = $user->get_username();
        echo "<h2> Welcome $name!</h2>";
    ?>
    <div>
        <h1>My Library</h1>
        <br>
        <?php 
            //unserializes the current user's library and checks that the library is not empty.
            $lib = unserialize($user->get_library());
            if(sizeof($lib) < 1)  {
                print("No songs available currently.");
                echo "<br>";
            }
            else {
                //Prints all songs stored in the current user's library as well as adding or giving the choice to add an annotation to the song.
                foreach($lib as $song) {
                    $tmp_song = unserialize($song);
                    //As songs are printed they are attached with a remove button (to remove them from the list) and an annotate button (to annotate the song.).
                    echo $tmp_song->get_name() . "<button name='remove' style='margin-left: 10px;' form='remove' value='".$tmp_song->get_name()."'>remove</button>".
                    "<button name='annotate' style='margin-left: 10px;' form='annotate' value='".$tmp_song->get_name()."'>Annotate</button><br>";
                    //Checks that an annotation has been made to the song and prints it.
                    if(!is_null($tmp_song->get_annotation())) {
                        echo "Annotation: " . $tmp_song->get_annotation() . "<br>";
                    }
                }
            }
            //check that the remove button has been pressed.
            if(isset($_POST['remove'])) {
                //Gets the name of the song to be removed and removes it using 'remove_song_from_library()'.
                $song = $_POST['remove'];
                $updated_user = remove_song_from_library($song,$user);
                //Updates the user after the above process and refreshes the page to show the changes.
                $_SESSION[$key] = $updated_user;
                header('Location: userpage.php');
            }
            //Check that the annotated button has been pressed.
            if(isset($_POST['annotated'])) {
                //Extracts the song to annotate from the current_song session variable.
                $annotate_base = $_SESSION['current_song'];
                //Extracts the annotated message from the 'annotated' POST variable and annotates the song by calling 'annotate_song();
                $annotation = $_POST['annotated'];
                $song_annotated_user = annotate_song($annotate_base,$user,$annotation);
                //Updates the user who's song was annotated and refreshes the page to show changes.
                $_SESSION[$key] = $song_annotated_user;
                header('Location: userpage.php');
            }
        ?>
        <br>
    </div>
    <div>
        <form action="annotate.php" method="post" id="annotate"></form>
        <form method="post" id="remove"></form>
        <form action="ZTunes.php">
            <input type="submit" value="ZTunes">
        </form>
        <br>
        <form action="Zotify.php">
            <input type="submit" value="Zotify">
        </form>
    </div>
    <br>
    <form action="main.php">
        <input type="submit" value="Log out.">
    </form>  
</body>
</html>