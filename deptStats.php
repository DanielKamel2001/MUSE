<?php 
    // Include and call function to connect to db
    include_once 'components/imports.php';
    include_once 'components/dbConnection.php';

    $conn = getConnection();

    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    session_start();

    //start printing non-sensitive views
    //Dep
    echo "<h3>Program Statistics<h3>";
    //Select all students and group by programName, count studentID
    $query = "select program, count(*) from student group by program";// = 'Software Engineering'";
    $qresult = mysqli_query($conn, $query);
    
    echo "<table>";
    echo "<tr>";
    echo "<th>header1</th><th>header2</th>";

    if ($qresult){
        while($row = mysqli_fetch_array($qresult, MYSQLI_ASSOC)){
            // Stores details of table array in variables for output.
            //$variable = $row['fName'];

            echo "<tr>";
            echo "<td>".$row['program']."<td>";
            echo "<td>".$row['count(*)']."<td>";
            echo "<tr>";
        }
    }
    else{
        echo "<tr>";
        echo "<td>ERROR: NO MATCHING RECORDS!<td>";
        echo "</tr>";
    }
    echo "</table>";
?>
<html lang ="en">
    <body>
        <div>
            <form id="back" method="POST" action= "home.php">
                <input type="submit" value="BACK">
            </form>
        </div>
    
    </body>

</html>