<?php
session_start();

if ($_SESSION["Login"] != "YES") {
    header("Location: index.php");
}

if ($_SESSION["LEVEL"] == 1 || $_SESSION["LEVEL"] == 2) {
    ?>
<html>

<head>
    <title>Updating Training Session Data</title>
    <link rel="stylesheet" href="image/main.css">
    <script src="validation_form.js"></script>
</head>

<body>
    <?php
    $trainingID = $_GET['id'];

    require("config.php");

    // Retrieve data from the database
    $sql = "SELECT * FROM Training_Session WHERE training_ID='$trainingID'";
    $result = mysqli_query($conn, $sql);
    $rows = mysqli_fetch_assoc($result);
    ?>

    <div class="grid-container">
        <div class="logo">
            <a href="mainPage.php">
                <img src="image/utmlogo.png" alt="utmlogo" width="150" height="50">
            </a>
            <h1>Update Training Session Data</h1>
            <button class="borderless-button logout" onclick="window.location.href='logout.php'">LOGOUT</button>
        </div>

        <div class="left-column2">
            <div>
                <button class="borderless-button left-column-button"
                    onclick="window.location.href='view_training_session.php'"><img src="image/icon/view.svg"
                        alt="studentlogo" width="25px" height="25px" />VIEW</button>
                <button class="borderless-button left-column-button"
                    onclick="window.location.href='training_session_form.php'"><img src="image/icon/insert.svg"
                        alt="studentlogo" width="25px" height="25px" />INSERT</button>
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
                <form name="form" method="post" action="update_training_session.php"
                    onsubmit="return validateTrainingSession();">
                    <table border="0" cellspacing="5" cellpadding="0">
                        <tr>
                            <td><input name="trainingID" type="hidden" value="<?php echo $rows['training_ID']; ?>"></td>
                        </tr>
                        <tr>
                            <td><strong>Name</strong></td>
                            <td align="left"><input name="name" type="text" size="50"
                                    style='text-transform:uppercase; width: 375px;' value="<?php echo $rows['name']; ?>"
                                    required></td>
                        </tr>
                        <tr>
                            <td><strong>Description</strong></td>
                            <td align="left">
                                <textarea name="description" rows="5" cols="50" style='width: 375px;'
                                    required><?php echo $rows['description']; ?></textarea>
                            </td>

                        </tr>
                        <tr>
                            <td><strong>Start Date</strong></td>
                            <td align="left"><input name="startDate" type="date"
                                    value="<?php echo $rows['startDate']; ?>" required></td>
                        </tr>
                        <tr>
                            <td><strong>End Date</strong></td>
                            <td align="left"><input name="endDate" type="date" value="<?php echo $rows['endDate']; ?>"
                                    required>
                            </td>
                        </tr>
                        <tr>
                            <td><strong>Required Number</strong></td>
                            <td align="left"><input name="requiredAmount" type="number"
                                    value="<?php echo $rows['required_amount']; ?>" required> (Person)
                                <font id="requiredAmountError" class="error-message"></font>
                            </td>
                        </tr>
                        <tr>
                            <td><strong>Allowance(RM)</strong></td>
                            <td align="left"><input name="allowance" type="number"
                                    value="<?php echo $rows['allowance']; ?>" required>
                                <font id="allowanceError" class="error-message"></font>
                            </td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td align="left"><br /><input type="submit" name="Submit" value="Update"></td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>
    </div>

</body>

</html>
<?php
    mysqli_close($conn);
} else {
    echo "<p>Wrong User Level! You are not authorized to view this page</p>";
    echo "<p><a href='view_training_session.php'>Go back to the view training session page</a></p>";
    echo "<p><a href='mainPage.php'>Go back to the main page</a></p>";
    echo "<p><a href='logout.php'>LOGOUT</a></p>";
}
?>