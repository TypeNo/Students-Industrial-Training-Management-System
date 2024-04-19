<?php
session_start(); // Start up your PHP Session

if ($_SESSION["Login"] != "YES") {
    header("Location: login.php");
}

if ($_SESSION["LEVEL"] != 3) {   // Only users with access level 1 and 2 can view
    ?>

<html>

<head>
    <title>View Organization Data</title>
    <link rel="stylesheet" href="image/main.css">
</head>

<body>

    <?php
        require("config.php"); // Read up on PHP includes https://www.w3schools.com/php/php_includes.asp

        $sql = "SELECT * FROM Organization";
        $result = mysqli_query($conn, $sql); ?>


    <div class="grid-container">
        <div class="logo">
            <a href="mainPage.php">
                <img src="image/utmlogo.png" alt="utmlogo" width="150" height="50">
            </a>
            <h1>View Organization Details</h1>
            <button class="borderless-button logout" onclick="window.location.href='logout.php'">LOGOUT</button>
        </div>

        <div class="left-column2">

            <?php
        if ($_SESSION["LEVEL"] == 1) { ?>
            <div>
                <button class="borderless-button left-column-button"
                    onclick="window.location.href='view_organization.php'" style="color:orange;"><img
                        src="image/icon/view.svg" alt="studentlogo" width="25px" height="25px" />VIEW</button>
                <button class="borderless-button left-column-button"
                    onclick="window.location.href='organization_form.php'"><img src="image/icon/insert.svg"
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
            <div class="scrollbar"> <?php
            if (mysqli_num_rows($result) > 0) {
            ?>

                <!-- Start table tag -->
                <table class="right-column-table">
                    <!-- Print table heading -->
                    <tr>
                        <th style="width:15%">Organization ID</th>
                        <th>Name</td>
                        <th style="width:40%">Address</th>
                        <th style="width:15%">Type</th>

                        <?php if ($_SESSION["LEVEL"] == 1) { ?>
                        <th>Update</th>
                        <th>Delete</th>
                        <?php } ?>
                    </tr>

                    <?php
                // Output data of each row
                while ($rows = mysqli_fetch_assoc($result)) {
                    ?>

                    <tr>
                        <td><?php echo $rows['organization_ID']; ?></td>
                        <td><?php echo $rows['name']; ?></td>
                        <td><?php echo $rows['address']; ?></td>
                        <td style="width:15%" nowrap><?php echo $rows['type']; ?></td>

                        <?php if ($_SESSION["LEVEL"] == 1) { ?>
                        <!--only users with access level 1 can view update and delete button-->
                        <td align="center"> <button class="borderless-button update"
                                onclick="window.location.href='update_organization_form.php?id=<?php echo $rows['organization_ID']; ?>'"><u>Update</u></button>
                        </td>
                        <td align="center"> <button class="borderless-button delete"
                                onclick="window.location.href='delete_organization.php?id=<?php echo $rows['organization_ID']; ?>'"><u>Delete</u></button>
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
            <br /><br />
        </div>
    </div>

    <?php } // If the user is not the correct level
        else if ($_SESSION["LEVEL"] == 3) {
            echo "<p>Wrong User Level! You are not authorized to view this page</p>";
            echo "<p><a href='mainPage.php'>Back to main page</a></p>";
            echo "<p><a href='logout.php'>LOGOUT</a></p>";
        }
        ?>

</body>

</html>