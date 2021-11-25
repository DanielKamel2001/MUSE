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

        //View 1 
        echo "<h3>Student Performance by Highschool</h3>";
        $query="SELECT STUDENT.highschool, STUDENT.studentNo, ENROLLED.mark, ENROLLED.CRN, SECTIONS.course_code, SECTIONS.profNo
        FROM STUDENT
        JOIN ENROLLED on STUDENT.studentNo = ENROLLED.studentNo
        JOIN SECTIONS on ENROLLED.CRN = SECTIONS.CRN
        JOIN STAFF on SECTIONS.profNo = STAFF.staffNo
        ORDER BY CRN ASC";

        $qresult = mysqli_query($conn, $query);
        // Print out each listing
        echo "<table>";
        echo "<tr>";
        echo "<th>Highschool</th><th>Student Number</th><th>Mark</th><th>CRN</th><th>Course Code</th><th>Professor Staff Number</th>";
        if ($qresult){
            while($row = mysqli_fetch_array($qresult, MYSQLI_ASSOC)){
                // Stores details of table array in variables for output.
                $highschool = $row['highschool'];
                $studentNo = $row['studentNo'];
                $mark = $row['mark'];
                $crn = $row['CRN'];
                $cc = $row['course_code'];
                $profNo = $row['profNo'];

                echo "<tr>";
                echo "<td>". $highschool. "<td>";
                echo "<td>". $studentNo. "<td>";
                echo "<td>". $mark. "<td>";
                echo "<td>". $cc. "<td>";
                echo "<td>". $profNo. "<td>";
                echo "<tr>";
            }
        }
        else{
            echo "<tr>";
            echo "<td>ERROR: NO MATCHING RECORDS!<td>";
            echo "</tr>";
        }
        echo "</table>";

        // View 8
        echo "<h3>Residence Details by Highschool</h3>";
        $query="SELECT STUDENT.highschool, STUDENT.address, STUDENT.inResidence FROM STUDENT INNER JOIN ENROLLED ON STUDENT.studentNo = ENROLLED.studentNo ORDER BY inResidence ASC, address ASC, highschool ASC";
        $qresult = mysqli_query($conn, $query);
        echo "<table>";
        echo "<tr>";
        echo "<th>Highschool</th><th>Address</th><th>in Residence?</th>";

        if ($qresult){
            while($row = mysqli_fetch_array($qresult, MYSQLI_ASSOC)){
                // Stores details of table array in variables for output.
                $highschool = $row['highschool'];
                $address = $row['address'];
                $residence = $row['inResidence'];

                echo "<tr>";
                echo "<td>". $highschool. "<td>";
                echo "<td>". $address. "<td>";
                echo "<td>". $residence. "<td>";
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