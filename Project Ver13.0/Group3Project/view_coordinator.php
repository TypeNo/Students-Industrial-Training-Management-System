<?php
session_start(); // Start up your PHP Session

if ($_SESSION["Login"] != "YES") //if the user is not logged in or has been logged out
    header("Location: login.php");

if ($_SESSION["LEVEL"] == 1) {   //only users with access level 1 and 2 can view
    ?>

<html>

<head>
    <title>View Coordinator Data</title>
    <link rel="stylesheet" href="image/main.css">
</head>

<body>

    <?php
        require("config.php"); 
    
    if($_SESSION["LEVEL"] == 1) {
          ?>

    <div class="grid-container">
        <div class="logo">
            <a href="mainPage.php">
                <img src="image/utmlogo.png" alt="utmlogo" width="150" height="50">
            </a>
            <h1>View Coordinator Details</h1>
            <button class="borderless-button logout" onclick="window.location.href='logout.php'">LOGOUT</button>
        </div>

        <div class="left-column2">
            <?php
        if ($_SESSION["LEVEL"] == 1) { ?>
            <div>
                <button class="borderless-button left-column-button"
                    onclick="window.location.href='view_coordinator.php'" style="color:orange;"><img
                        src="image/icon/view.svg" alt="studentlogo" width="25px" height="25px" />VIEW</button>
                <button class="borderless-button left-column-button"
                    onclick="window.location.href='coordinator_form.php'"><img src="image/icon/insert.svg"
                        alt="studentlogo" width="25px" height="25px" />INSERT</button>
            </div>
            <div>
                <button class="borderless-button left-column-button" onclick="window.location.href='mainPage.php'"><img
                        src="image/icon/back.svg" alt="studentlogo" width="25px" height="25px" />BACK</button>
            </div>
            <?php }?>

        </div>

        <!-- Right Column -->
        <div class="right-column">
            <div class="scrollbar">
                <?php
        $sql = "SELECT c.*, u.password, o.* FROM Coordinator AS c
        INNER JOIN user AS u ON c.username = u.username
        INNER JOIN Organization AS o ON c.organization_ID = o.organization_ID";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            ?>
                <!-- Start table tag -->
                <table class="right-column-table" border="1" cellspacing="0" cellpadding="3">
                    <!-- Print table heading -->
                    <tr>
                        <th>Coordinator ID</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Email</strong></th>
                        <th>Organization Name</th>
                        <?php if ($_SESSION["LEVEL"] == 1) { ?>
                        <th>Username</th>
                        <th>Password</th>
                        <?php } ?>
                        <th>Update</th>
                        <?php if ($_SESSION["LEVEL"] == 1) { ?>
                        <th>Delete</th>
                        <?php } ?>

                    </tr>

                    <?php
                // output data of each row
                while ($rows = mysqli_fetch_assoc($result)) {
                    ?>
                    <tr>
                        <td><?php echo $rows['coordinate_ID']; ?></td>
                        <td><?php echo $rows['firstName']; ?></td>
                        <td><?php echo $rows['lastName']; ?></td>
                        <td><?php echo $rows['email']; ?></td>
                        <td><?php echo $rows['name']; ?></td>
                        <?php if ($_SESSION["LEVEL"] == 1) { ?>
                        <td><?php echo $rows['username']; ?></td>
                        <td><?php echo $rows['password']; ?></td>
                        <?php } ?>

                        <td align="center"> <button class="borderless-button update"
                                onclick="window.location.href='update_coordinator_form.php?id=<?php echo $rows['coordinate_ID']; ?>'"><u>Update</u></button>
                        </td>
                        <td align="center"> <button class="borderless-button delete"
                                onclick="window.location.href='delete_coordinator.php?id=<?php echo $rows['coordinate_ID']; ?>&username=<?php echo $rows['username']; ?>'"><u>Delete</u></button>
                        </td>
                    </tr>

                    <?php

                }
                } else {
                    echo '<h3 style="text-align: center;">There are no records to show</h3>';
                }

                mysqli_close($conn);
                ?>

                </table>
            </div>
            <br /><br />
        </div>
    </div>

    <?php } // If the user is not the correct level
        else {

            echo "<p>Wrong User Level! You are not authorized to view this page</p>";

            echo "<p><a href='mainPage.php'>Back to main page</a></p>";
	
            echo "<p><a href='logout.php'>LOGOUT</a></p>";
         
           }
        }
          ?>
</body>

</html>