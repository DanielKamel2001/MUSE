<?php

$error = "";

// Check if this is a post request
if ($_SERVER["REQUEST_METHOD"] == "POST") {


    // Include and call function to connect to db
    include_once 'components/dbConnection.php';
    $conn = getConnection();

    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    session_start();

    // Get post request variables
    //$email = $_POST["email"];
    $password = $_POST["password"];
    $mode = $_POST["mode"];
    //$firstName = $_POST["firstName"];
    //$lastName = $_POST["lastName"];
    $idNo = $_POST["idNo"];

    //check for escape strings
    $idNo = $conn->real_escape_string($idNo);
    $password = $conn->real_escape_string($password);


//    // Make a sql query to see if the user exists (This is useful for both login and signup)
//    $sql = "SELECT studentNo FROM enrolement_records.student WHERE studentNo = '$idNo';";
//
//    if (mysqli_query($conn, $sql)->num_rows > 0) {
//        $userExists = true;
//    } else {
//        $userExists = false;
//    }

    if ($mode == "student") {
        // Make sure the user exists
//        if ($userExists) {

            // Get a user matching the email/password pair
            $sql = "SELECT studentNo,password FROM student WHERE studentNo = '$idNo' AND password = '$password';";
            $result = mysqli_query($conn, $sql);
            // If nothing was returned, the password is wrong
            if ($result->num_rows == 0) {
                $error = "Wrong password!";
            } else {
                while ($row = $result->fetch_assoc()) {
                    $_SESSION['sessionID'] = $row['studentNo'];
                    $_SESSION['sessionMode'] = "student";
                    //echo "your User id is ".$row['id']."<br>" ."session id is the same: ".$_SESSION['sessionID'];
                    header("Location:home.php");

                }
            }
//        } else {
//            $error = "User not found! Check your email address and try again.";
//        }
    } else if ($mode == "faculty") {
        // Check if the user exists
//        if ($userExists) {
////            $error = "A user already exists with that username.";
////        } else {
//            // Insert the new info into the database
//            $sql = "INSERT INTO user (username, passwordHash) VALUES ('$username','$password');";
//            mysqli_query($conn, $sql);
//            // Log the user in as the newly created user
//            $_SESSION['sessionID'] = $conn->insert_id;
//            header("Location:index.php");
////        }
         $sql = "SELECT staffNo,password FROM staff WHERE staffNo = '$idNo' AND password = '$password';";
            $result = mysqli_query($conn, $sql);
            // If nothing was returned, the password is wrong
            if ($result->num_rows == 0) {
                $error = "Wrong password!";
            } else {
                while ($row = $result->fetch_assoc()) {
                    $_SESSION['sessionID'] = $row['studentNo'];
                    $_SESSION['sessionMode'] = "staff";
                    //echo "your User id is ".$row['id']."<br>" ."session id is the same: ".$_SESSION['sessionID'];
                    header("Location:index.php");

                }
            }
    }
}


?>

<html>
<head>
    <title>Login Form</title>
    <link rel="stylesheet" type="text/css" href="style/loginStyle.css">
    <script type="text/javascript" src="components/scripts.js" async></script>
    <?php include_once("components/imports.php") ?>
</head>
<body>
<div id="loginBox" >
    <div id="splitHeader">
        <button type="button" class="headerButton" id="studentLoginButton" onclick="studentMode()">Student Log In</button>
        <button type="button" class="headerButton" id="staffLoginButton" onclick="staffMode()">Staff Log In</button>
    </div>
    <div id="formBody" >
        <h1 class="formHeader" id="loginTitle">Student Enrollment Records Login</h1>
        <!-- Form posts to itself -->
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <!--
            <label for="firstName" class="signup">First Name</label>
            <input type="text" id="firstName" class="signup" name="firstName">

            <label for="lastName" class="signup">Last Name</label>
            <input type="text" id="lastName" class="signup" name="lastName">
            -->

            <label for="studentNo" class="login">ID Number</label>
            <input type="text" id="studentNo" class="login" name="idNo" required>

            <!--
            <label for="email">Email</label>
            <input type="email" id="email" name="email" required>
            -->

            <label for="password">Password(*)</label>
            <input type="password" id="password" name="password" required>

            <input type="text" value="student" id="mode" name="mode" hidden>

            <input type="submit" id="submit">
            <p class="error"><?php echo $error; ?></p>
        </form>
    </div>
</div>
</body>
</html>
