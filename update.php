<?php
session_start();
$action = "";
$id = 0;
$name = "";
$contact = "";
$city = "";
$state = 0;
$zip = "";
$salary = "";
$error = FALSE;
$dberror = FALSE;
$error_message = "Please fill in the following fields:";
$dberror_message = "The following errors occured:";
$update_message = "";
$record_update = FALSE;

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
            $error = true;
            $error_message .= "<br>-Salary";
        } else{
            if(is_numeric($_POST["salary"])){
                $salary = $_POST["salary"];
            }else{
                $error = true;
                $error_message .= "<br>-Salary is NAN.";
            }
        }


        if(!$error){
            if($conn->connect_error){
                $sql = "UPDATE salesperson SET salesperson_name='{.$name.}', salesperson_contact='{.$contact.}', salesperson_city='{.$city.}', salesperson_state_id='{.$state.}', salesperson_zip='{.$zip.}', salesperson_salary='{.$salary.}' WHERE salesperson_id={$id}";
                if($conn->query($sql) == TRUE){
                    $record_update = TRUE;
                    $update_message = "The following record was updated in the database:<br>";

                }else{
                    $dberror = TRUE;
                    $dberror_message .= "<br>-Error updating record into database.";
                }
            }else{
                $dberror = TRUE;
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
                <span class="title-reg">SalesPerson Update Form</span>
            </div>
            <div class="top-item2">
                <span class="title-reg">Welcome, <?=$_SESSION["username"]?>.</span><br>
                <span class="title-reg">Click <a href="search.php?action=logout" class="link1">here</a> to logout.</span><br>
            </div>
        </div>
        <br>
        <a href="search.php">Back to search page</a>
        <br>
        <span class="f1">
            SalesPerson Update Form
        </span><br>
        <span class="f2">
            Please update the fields below.
        </span><br>
        <?PHP
            if($error){
            echo "<font color=red>" . $error_message . "</font>";
            }
            if($dberror){
                echo "<font color=red>" . $dberror_message . "</font>";
            }
            if($record_update){
                echo "<font>" . $update_message . "</font>";
            }
        ?>
        <form method="POST" action="update.php">    
            <div class="form-container">
                <input type="hidden" name="id" value="<?=$id?>">
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