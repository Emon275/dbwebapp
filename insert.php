<?php
session_start();
$action = "";
$name = "";
$contact = "";
$city = "";
$state = 0;
$zip = 0;
$salary = 0.0;
$error = false;
$error_message = "Please fill in the following fields:<br>";

$servername = "localhost:3306";
$username = "root";
$password = "AaryaSingh2005";
$database = "adptestdb";
$conn = new mysqli($servername, $username, $password, $database);
$conn_error = false;
if($conn->connect_error){
    $conn_error = true;
}

if(!isset($_SESSION["username"])){
    header("Location: index.php");
} else {

    if (!empty($_GET["action"])) {
        $action = $_GET["action"];


    }

    if ($action == "logout") {
        session_destroy();
        header("Location: index.php");
    }

    if(isset($_POST["Submit"])){
        $error = true;
        $error_message .= "-Name";
    }else{

    }
}
?>

<html>
    <head>
        <title>SEARCH PAGE</title>
        <style>
            body{
                background-color: #e6f7ff;
            }
            .top-container{
                display: flex;
                background-color: #006699;
                border-radius: 3px;
            }
            .top-item1{
                padding:10px;

                margin: 5px;
                width: 50%;
            }
            .top-item2{
                padding:10px;
 
                margin: 5px;
                width: 50%;
                text-align: right;
            }
            .form-container{
                display: flex;
                background-color: #006699;
                border-radius: 3px;
                width: 15%;
            }
            .form-item1{
                padding:10px;
                margin: 5px;
                width: 12%;
                text-align: left;
            }
            .form-item2{
                padding:10px;
                margin: 5px;
                width: 12%;
                text-align: left;
            }
            span.title{
                font-weight: bold;
                font-size: 26pt;
                color: #ffffff;
            }
            span.title-reg{
                font-size: 12pt;
                color: #ffffff;
            }
            a.link1{
                font-size: 12pt;
                color: #e0ebeb;
            }
            a.link1:hover{
                font-size: 12pt;
                color: purple;
            }
        </style>
    </head>
    <body>
        <div class="top-container">
            <div class="top-item1">
                <span class="title">ADP DB WebApp</span><br>
                <span class="title-reg">Customer Search Page</span>
            </div>
            <div class="top-item2">
                <span class="title-reg">Welcome, <?=$_SESSION["username"]?>.</span><br>
                <span class="title-reg">Click <a href="search.php?action=logout" class="link1">here</a> to logout.</span><br>
            </div>
        </div>
        <br><br>
        <form method="POST" action="insert.php">
        <div class="form-container">
            <div class="form-item1">
                Name: 
            </div><br>
            <div class="form-item2">
                <input type="text" name="name" value=""><br>
            </div>
        </div>
        <div class="form-container">
            <div class="form-item1">
                Contact:
            </div><br>
            <div class="form-item2">
                <input type="text" name="contact" value=""><br>
            </div>
        </div>
        <div class="form-container">
            <div class="form-item1">
                City:
            </div><br>
            <div class="form-item2">
                <input type="text" name="city" value=""><br>
            </div>
        </div>
        <div class="form-container">
            <div class="form-item1">
                State: 
            </div>
            <div class="form-item2">
            <select name = "state">
                    <?php
                        if($conn_error == false){
                            $sql = "SELECT * FROM adptestdb.state;";
                            $result = $conn->query($sql);
                            while($row = $result->fetch_assoc()){
                                ?>
                                <option value="<?=$row["state_id"]?>"><?=$row["state_name"]?></option>
                                <?php
                            }
                        }
                    ?>
                    <select>
            </div><br>
        </div>
        <div class="form-container">
            <div class="form-item1">
                Zip:
            </div><br>
            <div class="form-item2">
                <input type="text" name="zip" value=""><br>
            </div><br>
        </div>
        <div class="form-container">
            <div class="form-item1">
                Salary:
            </div>
            <div class="form-item2">
                <input type="text" name="salary" value=""><br>
            </div>
            <br>
        </div>
        <div class="form-container">
            <input type="submit" name="Submit" value="Submit"><br>
        </div>
        </form>
    </body>
</html>
<?php
    $conn->close();
?>