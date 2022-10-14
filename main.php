<?php 
    session_start();
    include 'User.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LandingPage</title>
</head>
<body>
    <div>
        <?php
            //Password Validation Code:           
            $user = $pass = $error_msg = "";
            //Check that the server got a request for a POST method.
            if($_SERVER["REQUEST_METHOD"] == "POST") {
                //Gather credentials and initialize a user via unserialization.
                $key = $_POST['username'];
                $pass = $_POST['password'];
                //Check if the user exists otherwise prompt for a sing up of a new user.
                if(isset($_SESSION[$key])) {
                    $user = unserialize($_SESSION[$key]);
                    //Authenticate the password input with the users real password.
                    if($user->auth_password($pass) < 1) {
                        $error_msg = "Please input correct password.";
                    }
                    else {
                        //Save the POST array into a sessions variable and redirect to the user home page.
                        $_SESSION['post'] = $_POST;    
                        header("Location: userpage.php");
                    }    
                }
                else {
                    echo "User not created please sing up.";
                }
            }
        ?>
        <h1> User Login </h1>
        <form method="POST">
            Username: <input type="text" name="username">
            <br>
            Password: <input type="text" name="password">
            <span class="error"> <?php echo $error_msg;?></span>
            <br>
            <input type="submit" value="Login">
        </form>
        <?php
            echo '<a href="signup.php"> Signup!';
        ?>
    </div>
</body>
</html>