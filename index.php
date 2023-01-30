<?php
session_start();

$username = "";
$password = "";
$error = 0;
$processed = 0;
$error_message = "Error Message: ";

if($_SERVER["REQUEST_METHOD"] == "POST"){

    $processed = 1;
    if(empty($_POST["username"])){
        $error = 1;
        $error_message .= "<br>&middot;Please enter a username.";
    }else{
        $username = $_POST["username"];
    }
    if(empty($_POST["password"])){
        $error = 1;
        $error_message .= "<br>&middot;Please enter a password.";
    }else{
        $password = $_POST["password"];
    }

    if($error == 0){
        if($username == "emonbhatt" && $password == "AaryaSingh2005"){
            $_SESSION["username"] = "emonbhatt";
            header("Location: search.php");
        }else{
            $error = 1;
            $error_message .= "<br>&middot;Invalid login.";
        }
    }
}

?>

<html>
    <body>
        <h2>System Login</h2>
        <?php
            if($error == 1 && $processed == 1){
                echo "<font color=red>" . $error_message . "</font>";
            }
        ?>
        <form method="post" action="">
            <span>Username:</span><br>
            <input type="text" name="username" value="<?=$username?>"><br>
            <span>Password:</span><br>
            <input type="password" name="password" value="<?=$password?>"><br><br>
            <input type="submit" value="Submit">
        </form>
    </body>
</html>
