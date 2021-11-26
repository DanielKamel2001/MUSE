<?php 
    // Include and call function to connect to db
    include_once 'components/dbConnection.php';

    $conn = getConnection();

    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    session_start();
    
    //ideally included as componnent
    echo "<div style='display: flex; background-color:#90CAF9; justify-content: space-around; text-align:'center'; align-items:center'>";
    echo "<form align='center' method='GET' action= index.php> <input type='submit' class ='navbtn' value='Logout'> </form>";
    echo "<form align='center''method='POST' action= records.php> <input type='submit' class='navbtn' value='View Records'> </form>";
    echo "<form align='center'' method='POST' action= 'map.html'> <input type='submit' class='navbtn' value='Student Location Heatmap'> </form>";
    echo "</div>";
    
    //start printing non-sensitive views
    echo "<h2>Program Statistics</h2>";
    //Select all students and group by programName, count studentID
    $query = "select program, count(*) from student group by program";// = 'Software Engineering'";
    $qresult = mysqli_query($conn, $query);
    
    echo "<table>";
    echo "<tr>";
    echo "<th>Program</th><th>Students Enrolled</th>";
    echo "</tr>";

    if ($qresult){
        while($row = mysqli_fetch_array($qresult, MYSQLI_ASSOC)){
            echo "<tr>";
            echo "<td>".$row['program']."</td>";
            echo "<td>".$row['count(*)']."</td>";
            echo "</tr>";
        }

        // Query to count total number of students
        $query = "SELECT count(*) FROM STUDENT";
        $qresult = mysqli_query($conn, $query);
        $total = mysqli_fetch_assoc($qresult);
        $totalstring = $total['count(*)'];

        echo "<tr>";
        echo "<td> TOTAL:</td>";
        echo "<td>".$totalstring."</td>";
        echo "</tr>";
    }
    else{
        echo "<tr>";
        echo "<td>ERROR: NO MATCHING RECORDS!<td>";
        echo "</tr>";
    }
    echo "</table>";
    echo "<br>";

    // View 4
    echo "<h3>Professor Department Lookup</h3>";
    $query = "SELECT Staff.fName, Staff.lName, BELONGS_TO.department
    FROM STAFF
    LEFT JOIN BELONGS_TO
    ON STAFF.staffNo = BELONGS_TO.staffNo
    UNION
    SELECT Staff.fName, Staff.lName, BELONGS_TO.department
    FROM STAFF
    RIGHT JOIN BELONGS_TO
    ON STAFF.staffNo = BELONGS_TO.staffNo";

    $qresult = mysqli_query($conn, $query);
    echo "<table>";
    echo "<tr>";
    echo "<th>First Name</th><th>Last Name</th><th>Department</th>";
    if ($qresult){
        while($row = mysqli_fetch_array($qresult, MYSQLI_ASSOC)){
            $fName = $row['fName'];
            $lName = $row['lName'];
            $dept = $row['department'];

            echo "<tr>";
            echo "<td>".$fName."</td>";
            echo "<td>".$lName."</td>";
            echo "<td>".$dept."</td>";
            echo "</tr>";
        }
    }
    else{
        echo "<tr>";
        echo "<td>ERROR: NO MATCHING RECORDS!<td>";
        echo "</tr>";
    }
    echo "</table>";
    echo "</br>";

    // View 10
    echo "<h3>Number of Students Not in Clear Academic Standing by Program</h3>";
    $query = "SELECT STUDENT.Program, count(*) FROM STUDENT WHERE student.academicStanding!='Clear' GROUP BY Program;";
    $qresult = mysqli_query($conn, $query);
    echo "<table>";
    echo "<tr>";
    echo "<th>Program Name</th><th>Number of Students</th>";
    echo "</tr>";

    if ($qresult){
        while($row = mysqli_fetch_array($qresult, MYSQLI_ASSOC)){
            // Stores details of table array in variables for output.
            $program = $row['Program'];
            $number = $row['count(*)'];

            echo "<tr>";
            echo "<td>". $program. "</td>";
            echo "<td>". $number. "</td>";
            echo "</tr>";
        }
    }
    else{
        echo "<tr>";
        echo "<td>ERROR: NO MATCHING RECORDS!<td>";
        echo "</tr>";
    }
    echo "</table>";
    echo "<br>";

    // View 3
//    echo "<h3>Software Engineering Course Sections</h3>";
//    $query="SELECT * FROM sections WHERE course_code IN (SELECT course.course_code FROM course WHERE course.department = 'SOFE')";
//    $qresult = mysqli_query($conn, $query);
//    echo "<table>";
//    echo "<tr>";
//    echo "<th>CRN</th><th>Course Code</th><th>Section Number</th><th>Year</th>";
//    echo "<th>Season</th><th>Size</th><th>Professor Number</th><th>Class Type</th><th>Class Location</th>";
//    echo "<tr>";
//
//    if ($qresult){
//        while($row = mysqli_fetch_array($qresult, MYSQLI_ASSOC)){
//            // Stores details of table array in variables for output.
//            $crn = $row['CRN'];
//            $cc = $row['course_code'];
//            $sectNo = $row['sectionNo'];
//            $year = $row['year'];
//            $season = $row['season'];
//            $size = $row['size'];
//            $ctype = $row['type'];
//            $cloc = $row['location'];
//
//            echo "<tr>";
//            echo "<td>". $crn. "<td>";
//            echo "<td>". $cc. "<td>";
//            echo "<td>". $sectNo. "<td>";
//            echo "<td>". $year. "<td>";
//            echo "<td>". $season. "<td>";
//            echo "<td>". $size. "<td>";
//            echo "<td>". $ctype. "<td>";
//            echo "<td>". $cloc. "<td>";
//            echo "<tr>";
//        }
//    }
//    else{
//        echo "<tr>";
//        echo "<td>ERROR: NO MATCHING RECORDS!<td>";
//        echo "</tr>";
//    }
//    echo "</table>";
//    echo"<br>";

//became redundent after modification to first view 8
    // Modified View 8 to Remove sensitive details (student address)
//    echo "<h2>Enrolled Student Residence Details by Highschool</h2>";
//    $query="SELECT STUDENT.highschool, STUDENT.inResidence FROM STUDENT INNER JOIN ENROLLED ON STUDENT.studentNo = ENROLLED.studentNo ORDER BY inResidence ASC, highschool ASC";
//    $qresult = mysqli_query($conn, $query);
//    echo "<table>";
//    echo "<tr>";
//    echo "<th>Highschool</th><th>in Residence?</th>";
//
//    if ($qresult){
//        while($row = mysqli_fetch_array($qresult, MYSQLI_ASSOC)){
//            // Stores details of table array in variables for output.
//            $highschool = $row['highschool'];
//            $residence = $row['inResidence'];
//
//            echo "<tr>";
//            echo "<td>". $highschool. "<td>";
//            echo "<td>". $residence. "<td>";
//            echo "<tr>";
//        }
//    }
//    else{
//        echo "<tr>";
//        echo "<td>ERROR: NO MATCHING RECORDS!<td>";
//        echo "</tr>";
//    }
//    echo "</table>";
//    echo "<br>";
?>
<html lang ="en">
<head>
    <title>Department Statistics</title>
    <link rel="stylesheet" type="text/css" href="style/enrollment.css">
    <?php include_once("components/fonts.php") ?>
</head>
    <body>
        <div>
            <form id="back" method="POST" action= "home.php">
                <input type="submit" class="bckbutton"  value="BACK">
            </form>
        </div>
    
    </body>

</html>