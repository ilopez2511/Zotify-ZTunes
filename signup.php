<?php 
    session_start();
    include "User.php";
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
        $u_name = $p_word = $success_message = "";
        $nam_err = $pass_err = "";
        //Clean the input of any undesired characters and protect integrity of the input. The cleanse function was taken from the w3Schools php tutorial.
        function cleanse_input($input) {
            $input = trim($input);
            $input = stripslashes($input);
            $input = htmlspecialchars($input);
            return $input;
        }
        //Check if the post method has been used in order to document a name and password for the user.
        if($_SERVER["REQUEST_METHOD"] == "POST") {
            $u_name = cleanse_input($_POST["name"]);
            $p_word = cleanse_input($_POST["pword"]);
            //Check that the username is not empty and that it does not start with a number. (only names starting with a letter are acceptable.)
            if(strlen($u_name) > 0) {
                if(is_numeric($u_name[0])) {
                    $nam_err = "Username can't start with digit.";
                }
            }
            //Check the password slot has not been left empty else prompt an error.          
            if(strlen($p_word) == 0) {
                $pass_err = "Please input a password.";
            }

            $success_message = "Congratulations user: $u_name has been created";
            //Create a new user set their name and password then initialize an empty library array.
            $user = new User();
            $user->set_username($u_name);
            $user->set_password($p_word);
            $start = array();
            $library = serialize($start);
            $user->set_library($library);
            //Save our newly created user into a session variable of key username then redirect us to the singin page.
            $_SESSION[$u_name] = serialize($user);

            header( "refresh:1;url=main.php");

        }

    ?>
    <h1> Sign Up! </h1>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        Username: <input type="text" name="name">
        <span class="error"><?php echo $nam_err; ?></span>
        <br>
        Password: <input type="text" name="pword">
        <span class="error"><?php echo $pass_err; ?></span>
        <br>
        <span class="success"><?php echo $success_message?></span>
        <br>
        <input type="submit" value="Submit">
    </form>
</body>
</html>