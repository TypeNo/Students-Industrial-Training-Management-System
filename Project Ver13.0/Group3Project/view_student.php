<?php
session_start(); // Start up your PHP Session

// echo $_SESSION["Login"]; //for session tracking purpose, can delete
// echo $_SESSION["LEVEL"]; //for session tracking purpose, can delete

if ($_SESSION["Login"] != "YES") //if the user is not logged in or has been logged out
header("Location: login.php");

if ($_SESSION["LEVEL"] != 3) {   //only user with access level 1 and 2 can view

?>

<html>

<head>
    <title>View Student Data</title>
    <link rel="stylesheet" href="image/main.css">
</head>

<body>
    <?php
	     require ("config.php"); //read up on php includes https://www.w3schools.com/php/php_includes.asp
	     
	     $sql = "SELECT student.*, user.password FROM student
		 		INNER JOIN user ON student.username = user.username";
		 $result = mysqli_query($conn, $sql); ?>

    <div class="grid-container">
        <div class="logo">
            <a href="mainPage.php">
                <img src="image/utmlogo.png" alt="utmlogo" width="150" height="50">
            </a>
            <h1>View Student Details</h1>
            <button class="borderless-button logout" onclick="window.location.href='logout.php'">LOGOUT</button>
        </div>

        <div class="left-column2">

            <?php
        if ($_SESSION["LEVEL"] == 1) { ?>
            <div class="left-column-up">
                <button class="borderless-button left-column-button" onclick="window.location.href='view_student.php'"
                    style="color:orange;"><img src="image/icon/view.svg" alt="studentlogo" width="25px"
                        height="25px" />VIEW</button>
                <button class="borderless-button left-column-button"
                    onclick="window.location.href='student_form.php'"><img src="image/icon/insert.svg" alt="studentlogo"
                        width="25px" height="25px" />INSERT</button>
            </div>
            <div>
                <button class="borderless-button left-column-button" onclick="window.location.href='mainPage.php'"><img
                        src="image/icon/back.svg" alt="studentlogo" width="25px" height="25px" />BACK</button>
            </div>

            <?php } else if ($_SESSION["LEVEL"] == 2) {?>
            <div class="left-column-up">
                <button class="borderless-button left-column-button"
                    onclick="window.location.href='update_coordinator_form.php'"><img src="image/icon/profile.svg"
                        alt="studentlogo" width="25px" height="25px" />PROFILE</button>
                <button class="borderless-button left-column-button" onclick="window.location.href='view_student.php'"
                    style="color:orange;"><img src="image/icon/student.svg" alt="studentlogo" width="25px"
                        height="25px" />STUDENT</button>
                <button class="borderless-button left-column-button"
                    onclick="window.location.href='view_training_session.php'"><img
                        src="image/icon/training-session.svg" alt="studentlogo" width="25px" height="25px" />TRAINING
                    SESSION</button>
                <button class="borderless-button left-column-button"
                    onclick="window.location.href='view_application.php'"><img src="image/icon/application.svg"
                        alt="studentlogo" width="25px" height="25px" />APPLICATION</button>
            </div>
            <div>
                <button class="borderless-button left-column-button" onclick="window.location.href='mainPage.php'"><img
                        src="image/icon/back.svg" alt="studentlogo" width="25px" height="25px" />BACK</button>
            </div>

            <?php } else if ($_SESSION["LEVEL"] == 3) {?>
            <div class="left-column-up">
                <button class="borderless-button left-column-button" onclick="window.location.href='view_student.php'"
                    style="color:orange;"><img src="image/icon/view.svg" alt="studentlogo" width="25px"
                        height="25px" />VIEW</button>
            </div>
            <div>
                <button class="borderless-button left-column-button" onclick="window.location.href='mainPage.php'"><img
                        src="image/icon/back.svg" alt="studentlogo" width="25px" height="25px" />ACK</button>
            </div>

            <?php }?>
        </div>

        <!-- Right Column -->
        <div class="right-column">
            <div class="scrollbar">
                <?php if (mysqli_num_rows($result) > 0) { 	?>

                <table class="right-column-table">

                    <!-- Print table heading -->
                    <tr>
                        <th>Name</th>
                        <th>IC</th>
                        <th>Matric</th>
                        <th>Gender</th>
                        <th>Contact No</th>
                        <th>Email</th>
                        <th>Year</th>
                        <th>Course</th>
                        <th>GPA</th>

                        <?php if ($_SESSION["LEVEL"] == 1) {?>
                        <th>Username</th>
                        <th>Password</th>
                        <th>Update</th>
                        <th>Delete</th>
                        <?php } ?>

                    </tr>

                    <?php
			// output data of each row
			
			while($rows = mysqli_fetch_assoc($result)) {
		?>

                    <tr>
                        <td style="white-space: nowrap;">
                            <?php echo $rows['lastName'] . ' ' . $rows['firstName']; ?></td>
                        <td><?php echo $rows['IC']; ?></td>
                        <td><?php echo $rows['matric']; ?></td>
                        <td><?php echo $rows['gender']; ?></td>
                        <td><?php echo $rows['contact_no']; ?></td>
                        <td><?php echo $rows['email']; ?></td>
                        <td><?php echo $rows['year']; ?></td>
                        <td><?php echo $rows['course']; ?></td>
                        <td><?php echo $rows['gpa']; ?></td>

                        <?php if ($_SESSION["LEVEL"] == 1) {?>
                        <td><?php echo $rows['username']; ?></td>
                        <td><?php echo $rows['password']; ?></td>
                        <!--only user with access level 1 can view update and delete button-->
                        <td> <button class="borderless-button update"
                                onclick="window.location.href='update_student_form.php?matric=<?php echo $rows['matric']; ?>'"><u>Update</u></button>
                        </td>
                        <td> <button class="borderless-button delete"
                                onclick="window.location.href='delete_student.php?matric=<?php echo $rows['matric']; ?>&username=<?php echo $rows['username']; ?>'"><u>Delete</u></button>
                        </td>
                    </tr>

                    <?php }
		
			}
		} else {
			echo '<h3 style="text-align: center;">There are no records to show</h3>';
			}

	     mysqli_close($conn);
	   ?>

                </table>
            </div>

            <?php }?>
            <br /><br />
        </div>
</body>

</html>