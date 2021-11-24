<?php //echo "hi" ;
// Include and call function to connect to db
include_once 'components/dbConnection.php';
$conn = getConnection();

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
session_start();

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


?>
