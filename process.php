<html>
    <body>
        <?php
            if($_SERVER["REQUEST_METHOD"] == "POST"){
                echo "Method: Post";
            }else{
                echo "Method: Get";
            }
        ?>
    <body>
<html>