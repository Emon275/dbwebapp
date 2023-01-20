<html>
    <body>
        <?php
            if($_SERVER["REQUEST_METHOD"] == "POST"){
                echo "Method: Post<br><br>";
                if(empty($_POST["Firstname"])){
                    echo "No first name provided!";
                }else{
                echo "First Name: ". $_POST["firstname"];
                }
                if(empty($_POST["lastname"])){
                    echo "No last name provided!";
                }else{
                echo "Last Name: ". $_POST["lastname"];
                }
                if(empty($_POST["password"])){
                    echo "No password provided!";
                }else{
                echo "Password: ". $_POST["password"];
                }
                if(empty($_POST["member"])){
                    echo "Not a member!<br>";
                }else{
                echo "Is a member: <br>";
                }
            }else{
                echo "Method: Get";
            }
        ?>
    <body>
<html>