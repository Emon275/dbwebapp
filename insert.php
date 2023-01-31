<?php
session_start();
$action = "";
$name = "";
$contact = "";
$city = "";
$state = 0;
$zip = "";
$salary = "";
$error = FALSE;
$error_message = "Please fill in the following fields:";
$dberror_message = "The following errors occured:";
$insert_message = "";
$record_insert = FALSE;

$servername = "localhost:3306";
$username = "root";
$password = "AaryaSingh2005";
$database = "adptestdb";
//Create DB Connection
$conn = new mysqli($servername, $username, $password, $database);
$conn_error = FALSE;
if($conn->connect_error){
    $conn_error = TRUE;
}


if(!isset($_SESSION["username"])){
    header("Location: index.php");
}else{

    if(!empty($_GET["action"])){
        $action = $_GET["action"];


    }

    if($action== "logout"){
        session_destroy();
        header("Location: index.php");
    }

    if(isset($_POST["Submit"])){

        if(empty($_POST["name"])){
            $error = TRUE;
            $error_message .= "<br>-Name";
        } else{
            $name = $_POST["name"];
        }

        if(empty($_POST["contact"])){
            $error = TRUE;
            $error_message .= "<br>-Contact";
        } else{
            $contact = $_POST["contact"];
        }

        if(empty($_POST["city"])){
            $error = TRUE;
            $error_message .= "<br>-City";
        } else{
            $city = $_POST["city"];
        }

        if(empty($_POST["state"])){
            $error = TRUE;
            $error_message .= "<br>-State";
        } else{
            $state = $_POST["state"];
        }

        if(empty($_POST["zip"])){
            $error = TRUE;
            $error_message .= "<br>-Zip";
        } else{
            $zip = $_POST["zip"];
        }

        if(empty($_POST["salary"])){
            echo "sal 1";
            $error = TRUE;
            $error_message .= "<br>-Salary";
        } else{
            echo "sal 2";
            if(is_numeric($_POST["salary"])){
                echo "sal 3";
                $salary = $_POST["salary"];
            }else{
                echo "sal 4";
                $error = TRUE;
                $error_message .= "<br>-Salary is NAN.";
            }
        }

        if(!$error){
            if($conn->connect_error){
                $sql = "INSERT INTO salesperson (salesperson_id, salesperson_firstname, salesperson_lastname, salesperson_contact, salesperson_address, salesperson_city, salesperson_state_id, salesperson_zip, salesperson_salary) VALUES('$name','$contact','$city','$state','$zip','$salary')";
                if($conn->query($sql) == TRUE){
                    $record_insert = TRUE;
                    $insert_message = "The following record was inserted into the database:<br>";
                    $insert_message = "Name: ".$name."<br>";
                    $insert_message = "Contact: ".$contact."<br>";
                    $insert_message = "City: ".$city."<br>";
                    $insert_message = "State: ".$state."<br>";
                    $insert_message = "Zip: ".$zip."<br>";
                    $insert_message = "Salary: ".$salary."<br>"; 
                }else{
                    $dberror_message .= "<br>-Error inserting record into database.";
                }
            }else{
                $dberror_message .= "<br>-Could not connect to database.";
            }
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
                width: 300px;
                color: #ffffff;
                font-weight: bold;
            }
            .form-item1{
                padding:10px;
                margin: 5px;
                width: 300px;
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
            span.f1{
                font-weight: bold;
                font-size: 22pt;
                color: #000000;
            }
            span.f2{
                font-size: 16pt;
                color: #000000;
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
                <span class="title-reg">SalesPerson Entry Form</span>
            </div>
            <div class="top-item2">
                <span class="title-reg">Welcome, <?=$_SESSION["username"]?>.</span><br>
                <span class="title-reg">Click <a href="search.php?action=logout" class="link1">here</a> to logout.</span><br>
            </div>
        </div>
        <br><br>
        <span class="f1">
            SalesPerson Entry Form
        </span><br>
        <span class="f2">
            Please fill in the fields below.
        </span><br>
        <?PHP
            if($error){
            echo "<font color=red>" . $error_message . "</font>";
            }
        ?>
        <form method="POST" action="insert.php">    
            <div class="form-container">
                <div class="form-item1">
                    Name:<br>
                    <input type="text" name="name" value="<?=$name?>"><br><br>
                    Contact:<br>
                    <input type="text" name="contact" value="<?=$contact?>"><br><br>
                    City:<br>
                    <input type="text" name="city" value="<?=$city?>"><br><br>
                    State:&nbsp;
                    <select name = "state">
                    <?php
                        if($conn_error == FALSE){
                            $sql = "SELECT * FROM adptestdb.state;";
                            $result = $conn->query($sql);
                            while($row = $result->fetch_assoc()){
                                if($state == $row["state_id"]){
                                    ?>
                                    <option value="<?=$row["state_id"]?>" selected><?=$row["state_name"]?></option>
                                <?php
                                }else{
                                    ?>
                                    <option value="<?=$row["state_id"]?>"><?=$row["state_name"]?></option>
                                <?php
                                }
                            }
                        }
                    ?>
                    </select>
                    <br><br>
                    Zip:<br>
                    <input type="text" name="zip" value="<?=$zip?>"><br><br>
                    Salary:<br>
                    <input type="text" name="salary" value="<?=$salary?>"><br><br>
                    <input type="submit" name="Submit" value="Submit">
                </div>
            </div>
        </form>
    </body>
</html>
<?php
    $conn->close();
}
?>