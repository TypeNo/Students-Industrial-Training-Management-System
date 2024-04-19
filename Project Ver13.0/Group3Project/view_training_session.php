<?php
session_start();

if ($_SESSION["Login"] != "YES") {
    header("Location: login.php");
}
?>

<html>

<head>
    <title>View Training Sessions</title>
    <link rel="stylesheet" href="image/main.css">
</head>

<body>

    <?php
    require("config.php");

    if($_SESSION["LEVEL"] == 1 || $_SESSION["LEVEL"] == 3) {
        $sql = "SELECT ts.*, o.name AS organization_name
        FROM Training_Session AS ts
        INNER JOIN Organization AS o ON ts.organization_ID = o.organization_ID";
    }
    else {
        $username = $_SESSION["USER"];
        $sql = "SELECT ts.*
        FROM Training_Session AS ts
        INNER JOIN Organization AS o ON ts.organization_ID = o.organization_ID
        WHERE ts.organization_ID = (SELECT organization_ID FROM Coordinator WHERE username = '$username')";
    }
        
    $result = mysqli_query($conn, $sql); ?>

    <div class="grid-container">
        <div class="logo">
            <a href="mainPage.php">
                <img src="image/utmlogo.png" alt="utmlogo" width="150" height="50">
            </a>
            <h1>View Training Sessions</h1>
            <button class="borderless-button logout" onclick="window.location.href='logout.php'">LOGOUT</button>
        </div>

        <div class="left-column2">
            <div>
                <button class="borderless-button left-column-button"
                    onclick="window.location.href='view_training_session.php'" style="color:orange;"><img
                        src="image/icon/view.svg" alt="studentlogo" width="25px" height="25px" />VIEW</button>
                <?php if($_SESSION["LEVEL"] != 3) {?>
                <button class="borderless-button left-column-button"
                    onclick="window.location.href='training_session_form.php'"><img src="image/icon/insert.svg"
                        alt="studentlogo" width="25px" height="25px" />INSERT</button>
                <?php } ?>
            </div>
            <div>
                <button class="borderless-button left-column-button" onclick="window.location.href='mainPage.php'"><img
                        src="image/icon/back.svg" alt="studentlogo" width="25px" height="25px" />BACK</button>
            </div>

        </div>

        <!-- Right Column -->
        <div class="right-column">
            <div class="scrollbar">
                <?php
        if (mysqli_num_rows($result) > 0) {
        ?>

                <table class="right-column-table">
                    <tr>
                        <?php if($_SESSION["LEVEL"] == 1) { ?>
                        <th>Organization Name</th>
                        <?php } ?>
                        <th>Training Session Name</th>
                        <th>Description</th>
                        <th style="width:80px;">Start Date</th>
                        <th style="width:80px;">End Date</th>
                        <th>Required Number</th>
                        <th>Current Number</th>
                        <th>Allowance (RM)</th>
                        <?php if($_SESSION["LEVEL"] != 3) {?>
                        <th>Update</th>
                        <th>Delete</th>
                        <?php } ?>
                    </tr>

                    <?php
            while ($row = mysqli_fetch_assoc($result)) {
                ?>
                    <tr>
                        <?php if($_SESSION["LEVEL"] == 1) { ?>
                        <td><?php echo $row['organization_name']; ?></td>
                        <?php } ?>
                        <td><?php echo $row['name']; ?></td>
                        <td><?php echo $row['description']; ?></td>
                        <td><?php echo $row['startDate']; ?></td>
                        <td><?php echo $row['endDate']; ?></td>
                        <td><?php echo $row['required_amount']; ?></td>
                        <td><?php echo $row['current_amount']; ?></td>
                        <td><?php echo $row['allowance']; ?></td>
                        <?php if($_SESSION["LEVEL"] != 3) {?>
                        <td align="center"><button class="borderless-button update"
                                onclick="window.location.href='update_training_session_form.php?id=<?php echo $row['training_ID']; ?>'"><u>UPDATE</u></button>
                        </td>
                        <td align="center"><button class="borderless-button delete"
                                onclick="window.location.href='delete_training_session.php?id=<?php echo $row['training_ID']; ?>'"><u>DELETE</u></button>
                        </td>
                        <?php } ?>
                    </tr>
                    <?php }
            ?>
                </table>

                <?php } else {
            echo '<h3 style="text-align: center;">No training sessions available</h3>';
        } 

        mysqli_close($conn);
        ?>
            </div>
            <br /><br />
        </div>
    </div>

</body>

</html>