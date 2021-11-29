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
   echo "<div style='display: flex; background-color:#90CAF9; justify-content: space-around; align-items:center'>";
   echo "<form align='center' method='GET' action= index.php> <input type='submit' class ='navbtn' value='Logout'> </form>";
   echo "<form align='center' method='POST' action= deptStats.php> <input type='submit' class='navbtn' value='Department Statistics'> </form>";
   echo "<form align='center' method='POST' action= 'map.html'> <input type='submit' class='navbtn' value='Student Location Heatmap'> </form>";
   echo "</div>";

    if ($_SESSION['sessionMode'] == "student"){
        // Display student's courses and grades
        $sql = "SELECT * FROM student WHERE studentNo = ". $_SESSION["sessionID"].";";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
        echo "<h2>Displaying Course History for: ";
        echo $row['fName']. " ". $row['lName']. " (Student Number: ". $row['studentNo']. ")</h2>";

        echo "<table>";
        echo "<tr>";
        echo "<th>Course Code</th> <th>Mark Achieved</th> <th>Season</th> <th>Year</th> <th>Class Type</th>";
        echo "</tr>";

        $query = "SELECT SECTIONS.course_code, ENROLLED.mark, SECTIONS.season, SECTIONS.year, SECTIONS.type
        FROM student
        JOIN ENROLLED on STUDENT.studentNo = ENROLLED.studentNo
        JOIN SECTIONS on ENROLLED.CRN = SECTIONS.CRN
        WHERE Enrolled.studentNo = ".$_SESSION["sessionID"]." ORDER BY SECTIONS.year ASC, sections.season ;";
        $qresult = mysqli_query($conn, $query);

        if ($qresult){
            while($row = mysqli_fetch_array($qresult, MYSQLI_ASSOC)){
                $cc = $row['course_code'];
                $mark = $row['mark'];
                $season = $row['season'];
                $year = $row['year'];
                $type = $row['type'];

                echo "<tr>";
                echo "<td>". $cc. "</td>";
                echo "<td>". $mark. "</td>";
                echo "<td>". $season. "</td>";
                echo "<td>". $year. "</td>";
                echo "<td>". $type. "</td>";
                echo "</tr>";
            }
        }
        else{
            echo "<tr>";
            echo "<td>ERROR: NO MATCHING RECORDS!</td>";
            echo "</tr>";
        }
        echo "</table>";
        echo "<br>";

        // View 9
        $query = "SELECT avg(mark) AS GPA FROM Enrolled
        JOIN STUDENT on ENROLLED.studentNo = STUDENT.studentNo
        JOIN SECTIONS on ENROLLED.CRN = SECTIONS.CRN
        WHERE STUDENT.studentNo = ". $_SESSION["sessionID"] .";";
        
        $qresult = mysqli_query($conn, $query);
        $avg = mysqli_fetch_assoc($qresult);
        $avgstring = $avg['GPA'];
    
        echo "<h4>Eligible for Co-op/Internship?:</h4>";
        echo "<table>";
        echo "<tr>";
        echo "<th>GPA</th> <th>Eligible?</th>";
        echo "</tr>";
        echo "<tr>";
        echo "<td>".$avgstring . "</td>";
        if ($avgstring >= 67){
            echo "<td> YES </td>";
        }
        else{
            echo "<td> NO </td>";
        }
        echo "</tr>";
        echo "</table>";
        echo "<br>";
    
    }
    elseif($_SESSION['sessionMode'] == "staff"){
        $sql = "SELECT * FROM STAFF WHERE staffNo = ". $_SESSION["sessionID"].";";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
        echo "<h2>Records Department for: ";
        echo $row['fName']. " ". $row['lName']. ", (Staff Number: ". $row['staffNo']. ")<h2>";
        echo "<br>";
        echo "<h3>Assigned Sections for Current Year</h3>";
        echo "<table>";
        echo "<tr>";
        echo "<th>Course Code</th> <th>CRN</th> <th>Section Number</th> <th>Season</th> <th>Year</th> <th>Class Type</th> <th>Class Size</th>";
        echo "</tr>";
        // Display professor's course sections for current year
        $query = "SELECT course_code, CRN, sectionNo, season, year, type, size
        FROM SECTIONS
        WHERE profNo = ". $_SESSION["sessionID"]." AND year = YEAR(CURRENT_TIMESTAMP) 
        ORDER BY course_code ASC, CRN ASC, sectionNo ASC;
        ";
        $qresult = mysqli_query($conn, $query);

        if ($qresult){
            while($row = mysqli_fetch_array($qresult, MYSQLI_ASSOC)){
                $cc = $row['course_code'];
                $crn = $row['CRN'];
                $sectNo = $row['sectionNo'];
                $season = $row['season'];
                $year = $row['year'];
                $type = $row['type'];
                $size = $row['size'];

                echo "<tr>";
                echo "<td>". $cc. "</td>";
                echo "<td>". $crn. "</td>";
                echo "<td>". $sectNo. "</td>";
                echo "<td>". $season. "</td>";
                echo "<td>". $year. "</td>";
                echo "<td>". $type. "</td>";
                echo "<td>". $size. "</td>";
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

  

        //View 1 
        echo "<h3>Student Performance by Highschool</h3>";
        $query="SELECT STUDENT.highschool, STUDENT.studentNo, ENROLLED.mark, ENROLLED.CRN, SECTIONS.course_code, SECTIONS.profNo
        FROM STUDENT
        JOIN ENROLLED on STUDENT.studentNo = ENROLLED.studentNo
        JOIN SECTIONS on ENROLLED.CRN = SECTIONS.CRN
        JOIN STAFF on SECTIONS.profNo = STAFF.staffNo
        WHERE ENROLLED.mark is not NULL
        ORDER BY SECTIONS.course_code ASC, STUDENT.studentNo ASC, STUDENT.highschool;";

        $qresult = mysqli_query($conn, $query);
        echo "<table>";
        echo "<tr>";
        echo "<th>Highschool</th><th>Student Number</th><th>Mark</th><th>CRN</th><th>Course Code</th><th>Professor Staff Number</th>";
        echo "</tr>";
        if ($qresult){
            while($row = mysqli_fetch_array($qresult, MYSQLI_ASSOC)){
                $highschool = $row['highschool'];
                $studentNo = $row['studentNo'];
                $mark = $row['mark'];
                $crn = $row['CRN'];
                $cc = $row['course_code'];
                $profNo = $row['profNo'];

                echo "<tr>";
                echo "<td>". $highschool. "</td>";
                echo "<td>". $studentNo. "</td>";
                echo "<td>". $mark. "</td>";
                echo "<td>". $crn. "</td>";
                echo "<td>". $cc. "</td>";
                echo "<td>". $profNo. "</td>";
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

        // View 5
        echo "<h3>Students in Software Engineering on Academic Probation</h3>";
        $query = "SELECT *
        FROM STUDENT
        WHERE Program = 'Software Engineering' and studentNo NOT IN (
            SELECT studentNo
            FROM STUDENT
            WHERE academicStanding = 'Clear')";
    
        $qresult = mysqli_query($conn, $query);
        echo "<table>";
        echo "<tr>";
        echo "<th>Student Number</th><th>First Name</th><th>Last Name</th><th>Program</th><th>Academic Standing</th>";
        echo "</tr>";
        if ($qresult){
            while($row = mysqli_fetch_array($qresult, MYSQLI_ASSOC)){
                $studentNo = $row['studentNo'];
                $fName = $row['fName'];
                $lName = $row['lName'];
                $program = $row['Program'];
                $astand = $row['academicStanding'];

                echo "<tr>";
                echo "<td>". $studentNo. "</td>";
                echo "<td>". $fName. "</td>";
                echo "<td>". $lName. "</td>";
                echo "<td>". $program. "</td>";
                echo "<td>". $astand. "</td>";
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

        //View 7 Sort Students by GPA
        echo "<h3>Students with GPA 3.7 or Higher</h3>";
        $query = "Select * from
(select s.studentNo, fName, lName, avg(e.mark) as studentAvg
from enrolled as e
left join student as s on s.studentNo = e.studentNo
GROUP BY e.studentNo)as averages where averages.studentAvg >= 80;";
        
        $qresult = mysqli_query($conn, $query);
        echo "<table>";
        echo "<tr>";
        echo "<th>Student Number</th><th>First Name</th><th>Last Name</th><th>Grade</th>";
        echo "</tr>";
        if ($qresult){
            while($row = mysqli_fetch_array($qresult, MYSQLI_ASSOC)){
                $studentNo = $row['studentNo'];
                $fName = $row['fName'];
                $lName = $row['lName'];
                $mark = $row['studentAvg'];


                echo "<tr>";
                echo "<td>". $studentNo. "</td>";
                echo "<td>". $fName. "</td>";
                echo "<td>". $lName. "</td>";
                echo "<td>". $mark. "</td>";

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
        

        // View 8
        echo "<h3>Residence Details by Highschool</h3>";
        $query="SELECT STUDENT.highschool, count(STUDENT.inResidence)
FROM STUDENT 
where STUDENT.inResidence = true
group by highschool;";
        $qresult = mysqli_query($conn, $query);
        echo "<table>";
        echo "<tr>";
        echo "<th>Highschool</th><th>in Residence?</th>";
        echo "</tr>";

        if ($qresult){
            while($row = mysqli_fetch_array($qresult, MYSQLI_ASSOC)){
                // Stores details of table array in variables for output.
                $highschool = $row['highschool'];
                $residence = $row['count(STUDENT.inResidence)'];

                echo "<tr>";
                echo "<td>". $highschool. "</td>";
                echo "<td>". $residence. "</td>";
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

        //view 3
        echo "<h3>Grades of Students in your Past Courses</h3>";
    $query="select CRN, studentNo, mark
from enrolled as outside
where exists(
SELECT course_code, CRN, sectionNo, season, year, type, size
        FROM SECTIONS
        WHERE profNo = 55 AND year < YEAR(CURRENT_TIMESTAMP) and outside.crn =sections.crn
        ORDER BY course_code ASC, CRN ASC, sectionNo ASC);";
    $qresult = mysqli_query($conn, $query);
    echo "<table>";
    echo "<tr>";
    echo "<th>CRN</th><th>Student number</th><th>mark</th>";
    echo "<tr>";

    if ($qresult){
        while($row = mysqli_fetch_array($qresult, MYSQLI_ASSOC)){
            // Stores details of table array in variables for output.
            $crn = $row['CRN'];
            $cc = $row['studentNo'];
            $mark = $row['mark'];


            echo "<tr>";
            echo "<td>". $crn. "</td>";
            echo "<td>". $cc. "</td>";
            echo "<td>". $mark. "</td>";
            echo "<tr>";
        }
    }
    else{
        echo "<tr>";
        echo "<td>ERROR: NO MATCHING RECORDS!</td>";
        echo "</tr>";
    }
    echo "</table>";
    echo"<br>";



    }
?>
<html lang ="en">
<head>
    <title>Records</title>
    <link rel="stylesheet" type="text/css" href="style/enrollment.css">
    <?php include_once("components/fonts.php") ?>
</head>
    <body>
        <div>
            <form id="back" method="POST" action= "home.php">
                <input type="submit" class="bckbutton" value="BACK">
            </form>
        </div>
    
    </body>

</html>