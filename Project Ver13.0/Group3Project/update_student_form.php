<?php
session_start(); // Start up your PHP Session


// echo $_SESSION["Login"]; //for session tracking purpose, can delete
// echo $_SESSION["LEVEL"]; //for session tracking purpose, can delete


if ($_SESSION["Login"] != "YES") //if the user is not logged in or has been logged out..
header("Location: login.php");   //send user to login page
 
if ($_SESSION["LEVEL"] == 1) {  //only user level 1 can access


?>
<html>

<head>
    <title>Updating Student Data</title>
    <link rel="stylesheet" href="image/main.css" />
    <script src="validation_form.js"></script>

    <head>

    <body>


        <?php
                 
        $matric = $_GET['matric'];
         require ("config.php");
         
         // Retrieve data from database
        //  $sql="SELECT * FROM student WHERE matric='$matric'";


         $sql = "SELECT student.*, user.password FROM student
         INNER JOIN user ON student.username = user.username
         WHERE student.matric ='$matric'";


         $result = mysqli_query($conn, $sql);
         $rows=mysqli_fetch_assoc($result);
       
?>

        <div class="grid-container">
            <div class="logo">
                <a href="mainPage.php">
                    <img src="image/utmlogo.png" alt="utmlogo" width="150" height="50">
                </a>
                <h1>Update Student Data Form</h1>
                <button class="borderless-button logout" onclick="window.location.href='logout.php'">LOGOUT</button>
            </div>

            <div class="left-column2">
                <div class="left-column-up">
                    <button class="borderless-button left-column-button"
                        onclick="window.location.href='view_student.php'"><img src="image/icon/view.svg"
                            alt="studentlogo" width="25px" height="25px" />VIEW</button>
                    <button class="borderless-button left-column-button"
                        onclick="window.location.href='student_form.php'"><img src="image/icon/insert.svg"
                            alt="studentlogo" width="25px" height="25px" />INSERT</button>
                </div>
                <div>
                    <button class="borderless-button left-column-button"
                        onclick="window.location.href='mainPage.php'"><img src="image/icon/back.svg" alt="studentlogo"
                            width="25px" height="25px" />BACK</button>
                </div>
            </div>

            <!-- Right Column -->
            <div class="right-column">
                <div class="right-column-distance">
                    <br />
                    <h3 style="text-align:center;">Please fill in the following information:</h3>
                    <form name="form" method="POST" action="update_student.php" onsubmit="return validateStudent();">
                        <table border="0">


                            <tr>
                                <td><strong>Student's First Name</strong></td>
                                <td><input type="text" name="firstName" size="50"
                                        value="<?php echo $rows['firstName']; ?>" style="text-transform:uppercase;"
                                        required>
                                    <font id="firstNameError" class="error-message"></font>
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Student's Last Name</strong></td>
                                <td><input type="text" name="lastName" size="50"
                                        value="<?php echo $rows['lastName']; ?>" style="text-transform:uppercase;"
                                        required>
                                    <font id="lastNameError" class="error-message"></font>
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Matric Number</strong></td>
                                <td><?php echo $rows['matric']; ?><input type="hidden" name="matric" size="20"
                                        value="<?php echo $rows['matric']; ?>">
                                    <font id="matricError" class="error-message"></font>
                                </td>
                            </tr>
                            <tr>
                                <td><strong>IC Number</strong></td>
                                <td><input type="text" name="IC" size="20" value="<?php echo $rows['IC']; ?>" required>
                                    <font id="ICError" class="error-message"></font>
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Gender</strong></td>
                                <td>
                                    <input type="radio" name="gender" id="Male" value="Male"
                                        <?php if($rows['gender'] == 'Male') echo 'checked'; ?>>
                                    <label for="Male">Male</label>
                                    <input type="radio" name="gender" id="Female" value="Female"
                                        <?php if($rows['gender'] == 'Female') echo 'checked'; ?>>
                                    <label for="Female">Female</label>
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Contact Number</strong></td>
                                <td><input type="text" name="contactNo" size="20"
                                        value="<?php echo $rows['contact_no']; ?>" required>
                                    <font id="contactNoError" class="error-message"></font>
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Email</strong></td>
                                <td><input type="text" name="email" size="50" value="<?php echo $rows['email']; ?>"
                                        required>
                                    <font id="emailError" class="error-message"></font>
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Year</strong></td>
                                <td>
                                    <select name="year" required>
                                        <option value="1" <?php if ($rows['year'] == '1') echo 'selected'; ?>>Year 1
                                        </option>
                                        <option value="2" <?php if ($rows['year'] == '2') echo 'selected'; ?>>Year 2
                                        </option>
                                        <option value="3" <?php if ($rows['year'] == '3') echo 'selected'; ?>>Year 3
                                        </option>
                                        <option value="4" <?php if ($rows['year'] == '4') echo 'selected'; ?>>Year 4
                                        </option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Course</strong></td>
                                <td><input type="text" name="course" size="50" style="text-transform:uppercase;"
                                        value="<?php echo $rows['course']; ?>" required>
                                    <font id="courseError" class="error-message"></font>
                                </td>

                                </td>
                            </tr>
                            <tr>
                                <td><strong>GPA</strong></td>
                                <td><input type="text" name="gpa" size="20" value="<?php echo $rows['gpa']; ?>"
                                        required>
                                    <font id="GPAError" class="error-message"></font>
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Username</strong></td>
                                <td><?php echo $rows['username']; ?><input type="hidden" name="username" size="20"
                                        value="<?php echo $rows['username']; ?>">
                                    <font id="usernameError" class="error-message"></font>
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Password</strong></td>
                                <td><input type="text" name="password" size="20"
                                        value="<?php echo $rows['password']; ?>" required>
                                    <font id="passwordError" class="error-message"></font>
                                </td>
                            </tr>

                            <tr>
                                <td></td>
                                <td align="left"><br /><input type="submit" name="button1" value="Update"></td>
                            </tr>
                        </table>

                    </form>
                </div>
            </div>

            <?php mysqli_close($conn);

    } else if ($_SESSION["LEVEL"] == 3) { // only user level 3 can access ?>

            <html>

            <head>
                <title>Updating Student Data</title>
                <link rel="stylesheet" href="image/main.css">
                <script src="validation_form.js"></script>
            </head>

<body>
    <?php
    $username = $_SESSION["USER"];
    require("config.php");

    $sql = "SELECT student.*, user.password FROM student
			INNER JOIN user ON student.username = user.username
            WHERE student.username = '$username'";

    $result = mysqli_query($conn, $sql);
    $rows = mysqli_fetch_assoc($result);
    ?>

    <div class="grid-container">
        <div class="logo">
            <a href="mainPage.php">
                <img src="image/utmlogo.png" alt="utmlogo" width="150" height="50">
            </a>
            <h1>Own Profile</h1>
            <button class="borderless-button logout" onclick="window.location.href='logout.php'">LOGOUT</button>
        </div>

        <div class="left-column2">
            <div class="left-column-up">
                <button class="borderless-button left-column-button"
                    onclick="window.location.href='update_student_form.php'" style="color:orange;"><img
                        src="image/icon/profile.svg" alt="studentlogo" width="25px" height="25px" />PROFILE</button>
            </div>
            <div>
                <button class="borderless-button left-column-button" onclick="window.location.href='mainPage.php'"><img
                        src="image/icon/back.svg" alt="studentlogo" width="25px" height="25px" />BACK</button>
            </div>
        </div>

        <!-- Right Column -->
        <div class="right-column">
            <div class="right-column-distance">
                <form name="form" method="POST" action="update_student.php" onsubmit="return studentValidateStudent();">

                    <table border="0" cellspacing="5" cellpadding="0">
                        <tr>
                            <td><strong>Student's First Name</strong></td>
                            <td><?php echo $rows['firstName']; ?></td>
                        </tr>
                        <tr>
                            <td><strong>Student's Last Name</strong></td>
                            <td><?php echo $rows['lastName']; ?></td>
                        </tr>
                        <tr>
                            <td><strong>Matric Number</strong></td>
                            <td><?php echo $rows['matric']; ?></td>
                        </tr>
                        <tr>
                            <td><strong>IC Number</strong></td>
                            <td><?php echo $rows['IC']; ?></td>
                        </tr>
                        <tr>
                            <td><strong>Gender</strong></td>
                            <td>
                                <?php echo $rows['gender']; ?>
                            </td>
                        </tr>
                        <tr>
                            <td><strong>Contact Number</strong></td>
                            <td><input type="text" name="contactNo" size="20" value="<?php echo $rows['contact_no']; ?>"
                                    required>
                                <font id="contactNoError" class="error-message"></font>
                            </td>
                        </tr>
                        <tr>
                            <td><strong>Email</strong></td>
                            <td><input type="text" name="email" size="50" value="<?php echo $rows['email']; ?>"
                                    required>
                                <font id="emailError" class="error-message"></font>
                            </td>
                        </tr>
                        <tr>
                            <td><strong>Year</strong></td>
                            <td>
                                <?php echo $rows['year']; ?>
                            </td>
                        </tr>
                        <tr>
                            <td><strong>Course</strong></td>
                            <td><?php echo $rows['course']; ?></td>

                            </td>
                        </tr>
                        <tr>
                            <td><strong>GPA</strong></td>
                            <td><?php echo $rows['gpa']; ?></td>
                        </tr>
                        <tr>
                            <td><strong>Username</strong></td>
                            <td><?php echo $rows['username']; ?><input type="hidden" name="username" size="20"
                                    value="<?php echo $rows['username']; ?>"></td>
                        </tr>
                        <tr>
                            <td><strong>Password</strong></td>
                            <td><input type="text" name="password" size="20" value="<?php echo $rows['password']; ?>"
                                    required>
                                <font id="passwordError" class="error-message"></font>
                            </td>
                        </tr>

                        <tr>
                            <td></td>
                            <td align="left"><br /><input type="submit" name="button1" value="Update"></td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>

</body>

</html>
<?php
             
         mysqli_close($conn);
       
// If the user is not correct level
}
else if ($_SESSION["LEVEL"] != 1 && $_SESSION["LEVEL"] != 3) {
    echo "<p>Wrong User Level! You are not authorized to view this page</p>";
    echo "<p><a href='mainPage.php'>Go back to the main page</a></p>";
    echo "<p><a href='logout.php'>LOGOUT</a></p>";
}
 
?>