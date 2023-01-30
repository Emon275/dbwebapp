<?php
session_start();
$action = "";
$servername = "localhost:3306";
$username = "root";
$password = "AaryaSingh2005";
$database = "flights";
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
            <?php
                if($conn_error == false){
                    $sql = "SELECT * FROM flights LIMIT 200;";
                    $result = $conn->query($sql);
                    if($result->num_rows > 0){
                        ?>
                        <table bgcolor="#333333" width="80%">
                            <tr bgcolor="#CCCCCC">
                                <td text 3px>Year</td>
                                <td>Month</td>
                                <td>Day</td>
                                <td>Day of Week</td>
                                <td>Airline</td>
                                <td>Flight Number</td>
                                <td>Tail Number</td>
                                <td>Origin Airport</td>
                                <td>Destination Airport</td>
                                <td>Scheduled Departure</td>
                                <td>Departure Time</td>
                                <td>Departure Delay</td>
                                <td>Scheduled Arrival</td>
                                <td>Arrival Time</td>
                                <td>Arrival Delay</td>
                            </tr>
                        <?php
                        while($row = $result->fetch_assoc()){
                        ?>
                            <tr bgcolor="#f2f2f2">
                            <td><?=$row["YEAR"]?></td>
                            <td><?=$row["MONTH"]?></td>
                            <td><?=$row["DAY"]?></td>
                            <td><?=$row["DAY_OF_WEEK"]?></td>
                            <td><?=$row["AIRLINE"]?></td>
                            <td><?=$row["FLIGHT_NUMBER"]?></td>
                            <td><?=$row["TAIL_NUMBER"]?></td>
                            <td><?=$row["ORIGIN_AIRPORT"]?></td>
                            <td><?=$row["DESTINATION_AIRPORT"]?></td>
                            <td><?=$row["SCHEDULED_DEPARTURE"]?></td>
                            <td><?=$row["DEPARTURE_TIME"]?></td>
                            <td><?=$row["DEPARTURE_DELAY"]?></td>
                            <td><?=$row["SCHEDULED_ARRIVAL"]?></td>
                            <td><?=$row["ARRIVAL_TIME"]?></td>
                            <td><?=$row["ARRIVAL_DELAY"]?></td>
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
