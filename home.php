<?php //echo "hi" ;
// Include and call function to connect to db
include_once 'components/dbConnection.php';
$conn = getConnection();

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
session_start();

/*
if ($_SESSION['sessionMode'] == "student"){
    $sql = "SELECT * FROM student WHERE studentNo = ". $_SESSION["sessionID"].";";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    echo "<table style='border-style: solid'>";
    echo "<tr>";
    echo "<th>Num</th><th>Name</th>";
    echo "</tr>";
    echo "<tr>";
    echo "<td>".$row['studentNo']."</td><td>".$row['fName']." ".$row['lName']."</td>";
    echo "</tr>";
    echo "</table>";
}
*/
// Print welcome message at top of screen when logged in
echo "<h2> Welcome ";

if ($_SESSION['sessionMode'] == "student"){
    $sql = "SELECT * FROM student WHERE studentNo = ". $_SESSION["sessionID"].";";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    echo $row['fName']. " ". $row['lName']. ", (Student Number: ". $row['studentNo']. ")<h2>";
}
elseif($_SESSION['sessionMode'] == "staff"){
    $sql2 = "SELECT * FROM staff WHERE staffNo = ". $_SESSION["sessionID"].";";
    $result2 = mysqli_query($conn, $sql2);
    $row = mysqli_fetch_array($result2, MYSQLI_ASSOC);
    echo $row['fName']. " ". $row['lName']. ", (Staff Number:". $row['staffNo']. ")<h2>";
}

?>
<html lang ="en">
    <body>
        <div>
            <form id="logout" method="GET" action= index.php>
                 <input type="submit" value="Logout">
            </form>

            <form id="sRecords" method="POST" action= records.php>
                <input type="submit" value="View Records">
            </form>

            <form id="pInfo" method="POST" action= deptStats.php>
                 <input type="submit" value="Department Statistics">
            </form>

            <form id="pInfo" method="POST" heatmap.php>
                <input type="submit" value="Student Location Heatmap">
            </form>

        </div>
    </body>

</html>
