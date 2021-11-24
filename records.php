<?php 
    // Include and call function to connect to db
    include_once 'components/dbConnection.php';
    $conn = getConnection();

    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    session_start();

    if ($_SESSION['sessionMode'] == "student"){
        // Display student's courses and grades
    
    }
    elseif($_SESSION['sessionMode'] == "staff"){
        // Display professor's course sections, and sensitive views as outlined in Phase II
    
        // gonna need a loop to print out those rows of the table
        //Query just needs to be updated to whatever we want
        echo "<h3>INSERT APPROPRIATE HEADER FOR TABLE HERE<h3>";
        $query="";
        $qresult = mysqli_query($connection, $query);
        // Print out each listing
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
    }
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