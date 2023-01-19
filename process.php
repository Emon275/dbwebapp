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
            }else{
                echo "Method: Get";
            }
        ?>
    <body>
<html>