<?php
session_start();
$action = "";

$servername = "localhost:3306";
$username = "root";
$password = "AaryaSingh2005";
$database = "adptestdb";
//Create DB Connection
$conn = new mysqli($servername, $username, $password, $database);
$conn_error = false;
if($conn->connect_error){
    $conn_error = true;
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
            a.tnav{
                font-size: 11pt;
                color: #666666;
            }
            a.tnav:hover{
                font-size: 11pt;
                color: #D6EEEE;
            }
            table {
                border-collapse: collapse;
                width: 100%;
            }
            th{
                text-align: left;
                padding: 8px;
                background-color: #93d2d2;
                font-weight: bold;
            }
            td {
                text-align: left;
                padding: 8px;
            }
            tr:nth-child(odd) {
                background-color: #D6EEEE;
            }
            span.f2{
                font-size: 16pt;
                color: #000000;
            }
            a.f2link{
                font-size: 16pt;
                color: #004466;
            }
            a.f2link:hover{
                font-size: 16pt;
                color: #4dc3ff;
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
        <a href="insert.php">Go to insert page</a>
            <?php
                if($conn_error == false){
                    $sql = "SELECT * FROM adptestdb.salesperson LEFT JOIN adptestdb.state on salesperson_state_id=state_id;";
                    $result = $conn->query($sql);
                    if($result->num_rows > 0){
                        ?>
                        <table bgcolor="#333333" width="80%">
                            <tr bgcolor="#CCCCCC">
                                <td>Name</td>
                                <td>Contact</td>
                                <td>City</td>
                                <td>State</td>
                                <td>Zip</td>
                                <td>Salary</td>
                                <td>Edit/Delete</td>
                            </tr>
                        <?php
                        while($row = $result->fetch_assoc()){
                        ?>
                            <tr bgcolor="#f2f2f2">
                                <td><?=$row["salesperson_name"]?></td>
                                <td><?=$row["salesperson_contact"]?></td>
                                <td><?=$row["salesperson_city"]?></td>
                                <td><?=$row["state_name"]?></td>
                                <td><?=$row["salesperson_zip"]?></td>
                                <td>$<?=$row["salesperson_salary"]?></td>
                                <td>
                                    <a href="update.php?id=<?=$row["salesperson_id"]?>">Edit</a> / <a href="delete.php?id=<?=$row["salesperson_id"]?>">Delete</a>
                                </td>
                            </tr>
                        <?php
                        }
                        ?>
                        </table>
                        <?php
                    }else{
                        echo "0 results";
                    }
                }else{
                    echo "No results to display due to connection error.";
                }
            ?>
    </body>
</html>
<?php
}
?>