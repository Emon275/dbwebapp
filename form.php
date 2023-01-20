<?php
$fname = "Bob";
$lname = "Ross";
$email = "paint@stuff.com";
$error = 0; // 0 means no error
$error_message = "Please fix the following fields";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    echo "Method: Post<br><br>";
    if (empty($_POST["firstname"])) {
        $error = 1;
        $error_message .= "<br>&middot;First Name";
    } else {
        $fname = $_POST["firstname"];
    }
    if (empty($_POST["lastname"])) {
        $error = 1;
        $error_message .= "<br>&middot;Last Name";
    } else {
        $fname = $_POST["lastname"];
    }
    if (empty($_POST["email"])) {
        $error = 1;
        $error_message .= "<br>&middot;Email";
    } else {
        $fname = $_POST["email"];
    }
}else{
    //Possible invalid request/access
}

if($error == 0){
    header("Location: index.php");
}
?>

<html>
    <head>
        <title>PHP From Test</title>
    </head>
    <body>
        <h3>Customer Form</h3>
        <?php
            if($error == 1){
            echo "<font color = red>" . $error_message . "</font>";
            }
        ?>
        <form method="get" action="form.php">
            <span>First name:</span><br>
            <input type="text" name="firstname" value="<?=$fname?>"><br>
            <span>Last name:</span><br>
            <input type="text" name="lastname" value="<?=$lname?>"><br>
            <span>Email:</span><br>
            <input type="email" name="email" value="<?=$email?>"><br><br>
            <input type="submit" name="Submit">
        </form>
    </body>
</html>