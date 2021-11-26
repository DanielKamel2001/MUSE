<?php

include_once 'components/dbConnection.php';

$conn = getConnection();

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
session_start();
$rows= array();
$query = "select address from student where studentNo < 301;";// = 'Software Engineering'";
$qresult = mysqli_query($conn, $query);

while($r = mysqli_fetch_assoc($qresult)) {
    $rows[] = $r;
}

header('Content-Type: text/javascript; charset=utf-8');
print(json_encode($rows));
?>

