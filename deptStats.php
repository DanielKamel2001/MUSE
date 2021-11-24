<?php 
    // Include and call function to connect to db
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
    $query = "";
    $qresult = mysqli_query($connection, $query);
    
    echo "<table>";
    echo "<tr>";
    echo "<th>header1</th><th>header2</th>";

    if ($qresult){
        while($row = mysqli_fetch_array($qresult, MYSQLI_ASSOC)){
            // Stores details of table array in variables for output.
            $variable = $row['value'];

            echo "<tr>";
            echo "<td>". $variable. "<td>";
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