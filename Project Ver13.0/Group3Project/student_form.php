<?php
session_start(); // Start up your PHP Session


// echo $_SESSION["Login"]; //for session tracking purpose, can delete
// echo $_SESSION["LEVEL"]; //for session tracking purpose, can delete


// If the user is not logged in send him/her to the login form
if ($_SESSION["Login"] != "YES")
    header("Location: login.php");


if ($_SESSION["LEVEL"] == 1) {
?>


<html>

<head>
    <title>Inserting Student Data</title>
    <link rel="stylesheet" href="image/main.css">
    <script src="validation_form.js"></script>
</head>

<body>

    <div class="grid-container">
        <div class="logo">
            <a href="mainPage.php">
                <img src="image/utmlogo.png" alt="utmlogo" width="150" height="50">
            </a>
            <h1>Student Data Form</h1>
            <button class="borderless-button logout" onclick="window.location.href='logout.php'">LOGOUT</button>
        </div>

        <div class="left-column2">
            <div>
                <button class="borderless-button left-column-button"
                    onclick="window.location.href='view_student.php'"><img src="image/icon/view.svg" alt="studentlogo"
                        width="25px" height="25px" />VIEW</button>
                <button class="borderless-button left-column-button" onclick="window.location.href='student_form.php'"
                    style="color:orange;"><img src="image/icon/insert.svg" alt="studentlogo" width="25px"
                        height="25px" />INSERT</button>
            </div>
            <div>
                <button class="borderless-button left-column-button" onclick="window.location.href='mainPage.php'"><img
                        src="image/icon/back.svg" alt="studentlogo" width="25px" height="25px" />BACK</button>
            </div>
        </div>

        <!-- Right Column -->
        <div class="right-column">
            <div class="right-column-distance">

                <br />
                <h3 style="text-align:center;">Please fill in the following information:</h3>

                <form name="form" method="POST" action="insert_student.php" onsubmit="return validateStudent();">
                    <table border="0">
                        <tr>
                            <td><strong>Student's First Name</strong></td>
                            <td><input type="text" name="firstName" size="50" style="text-transform:uppercase;"
                                    required>
                                <font id="firstNameError" class="error-message"></font>
                            </td>
                        </tr>
                        <tr>
                            <td><strong>Student's Last Name</strong></td>
                            <td><input type="text" name="lastName" size="50" style="text-transform:uppercase;" required>
                                <font id="lastNameError" class="error-message"></font>
                            </td>
                        </tr>
                        <tr>
                            <td><strong>Matric Number</strong></td>
                            <td><input type="text" name="matric" size="20" style="text-transform:uppercase;" required>
                                <font id="matricError" class="error-message"></font>
                            </td>
                        </tr>
                        <tr>
                            <td><strong>IC Number</strong></td>
                            <td><input type="text" name="IC" size="20" required>
                                <font id="ICError" class="error-message"></font>
                            </td>
                        </tr>
                        <tr>
                            <td><strong>Gender</strong></td>
                            <td>
                                <input type="radio" name="gender" value="Male" required><label>Male</label>
                                <input type="radio" name="gender" value="Female" required><label>Female</label>
                            </td>
                        </tr>
                        <tr>
                            <td><strong>Contact Number</strong></td>
                            <td><input type="text" name="contactNo" size="20" required>
                                <font id="contactNoError" class="error-message"></font>
                            </td>
                        </tr>
                        <tr>
                            <td><strong>Email</strong></td>
                            <td><input type="text" name="email" size="50" required>
                                <font id="emailError" class="error-message"></font>
                            </td>
                        </tr>
                        <tr>
                            <td><strong>Year</strong></td>
                            <td>
                                <select name="year" required>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td><strong>Course</strong></td>
                            <td><input type="text" name="course" size="50" style="text-transform:uppercase;" required>
                                <font id="courseError" class="error-message"></font>
                            </td>
                        </tr>
                        <tr>
                            <td><strong>GPA</strong></td>
                            <td><input type="text" name="gpa" size="20" step="0.01" min="0" max="4" required>
                                <font id="GPAError" class="error-message"></font>
                            </td>
                        </tr>
                        <tr>
                            <td><strong>Username</strong></td>
                            <td><input type="text" name="username" size="20" required>
                                <font id="usernameError" class="error-message"></font>
                            </td>
                        </tr>
                        <tr>
                            <td><strong>Password</strong></td>
                            <td><input type="text" name="password" size="20" required>
                                <font id="passwordError" class="error-message"></font>
                            </td>
                        </tr>
                        <tr>
                            <td><strong>Level</strong></td>
                            <td>
                                <span>3</span>
                                <input type="hidden" name="level" value="3">

                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td align="left"><input type="submit" name="button1" value="Submit"></td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>
    </div>
</body>

</html>


<?php
    // If the user is not correct level
} else if ($_SESSION["LEVEL"] != 1) {

    echo "<p>Wrong User Level! You are not authorized to view this page</p>";

    echo "<p><a href='mainPage.php'>Go back to main page</a></p>";

    echo "<p><a href='logout.php'>LOGOUT</a></p>";
}