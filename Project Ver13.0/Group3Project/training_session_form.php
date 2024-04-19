<?php
session_start(); // Start up your PHP Session

// If the user is not logged in, send them to the login form
if ($_SESSION["Login"] != "YES") {
    header("Location: login.php");
}

if ($_SESSION["LEVEL"] == 1 || $_SESSION["LEVEL"] == 2) {
    ?>

<html>

<head>
    <title>Inserting Training Session Data</title>
    <link rel="stylesheet" href="image/main.css">
    <script src="validation_form.js"></script>
</head>

<body>

    <div class="grid-container">
        <div class="logo">
            <a href="mainPage.php">
                <img src="image/utmlogo.png" alt="utmlogo" width="150" height="50">
            </a>
            <h1>Training Session Data</h1>
            <button class="borderless-button logout" onclick="window.location.href='logout.php'">LOGOUT</button>
        </div>

        <div class="left-column2">
            <div>
                <button class="borderless-button left-column-button"
                    onclick="window.location.href='view_training_session.php'"><img src="image/icon/view.svg"
                        alt="studentlogo" width="25px" height="25px" />VIEW</button>
                <button class="borderless-button left-column-button"
                    onclick="window.location.href='training_session_form.php'" style="color:orange;"><img
                        src="image/icon/insert.svg" alt="studentlogo" width="25px" height="25px" />INSERT</button>
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

                <form name="form" method="POST" action="insert_training_session.php"
                    onsubmit="return validateTrainingSession();">
                    <table border="0">
                        <tr>
                            <td><strong>Organization Name</strong></td>
                            <td>
                                <?php
                if ($_SESSION["LEVEL"] == 2) {
                    // Connect to the database and retrieve the organization name based on the current user's username
                    require("config.php");

                    $username = $_SESSION['USER'];
                    $sql = "SELECT organization_ID FROM Coordinator WHERE username = '$username'";
                    $result = mysqli_query($conn, $sql);

                    if (mysqli_num_rows($result) > 0) {
                        $row = mysqli_fetch_assoc($result);
                        $organizationID = $row['organization_ID'];

                        $orgSql = "SELECT name FROM Organization WHERE organization_ID = '$organizationID'";
                        $orgResult = mysqli_query($conn, $orgSql);

                        if (mysqli_num_rows($orgResult) > 0) {
                            $orgRow = mysqli_fetch_assoc($orgResult);
                            $organizationName = $orgRow['name'];
                            echo "<input type='hidden' name='selected_organization_ID' value='$organizationID'>";
                            echo "$organizationName";
                        }
                    }

                    mysqli_close($conn);
                }
                ?>
                                <?php if ($_SESSION["LEVEL"] == 1) { ?>
                                <select name="selected_organization_ID" required>
                                    <option value=""
                                        <?php if(!isset($_POST['selected_organization_ID'])) echo 'selected'; ?>>None
                                    </option>
                                    <?php
                        require("config.php");
                        $sql = "SELECT DISTINCT name, organization_ID FROM organization";
                        $result = mysqli_query($conn, $sql);
                        while ($row = mysqli_fetch_assoc($result)) {
                            ?>
                                    <option value="<?php echo $row['organization_ID'] ?>"
                                        <?php if(isset($_POST['selected_organization_ID']) && $_POST['selected_organization_ID'] == $row['organization_ID']) echo 'selected'; ?>>
                                        <?php echo $row['name'] ?>
                                    </option>
                                    <?php }
                        ?>
                                </select>
                                <?php } ?>


                            </td>
                        </tr>
                        <tr>
                            <td><strong>Session Name</strong></td>
                            <td><input type="text" name="name" size="50" required
                                    style='text-transform:uppercase; width: 375px;'></td>
                        </tr>
                        <tr>
                            <td><strong>Description</strong></td>
                            <td><textarea name="description" rows="5" cols="50" style='width: 375px;'
                                    required></textarea></td>
                        </tr>
                        <tr>
                            <td><strong>Start Date</strong></td>
                            <td>
                                <input type="date" name="startDate" required>
                                <span style="padding-left: 32px;">End Date</span>
                                <input type="date" name="endDate" required>
                            </td>
                        </tr>
                        <tr>
                            <td><strong>Required Number</strong></td>
                            <td><input type="number" name="requiredAmount" required> (Person)
                                <font id="requiredAmountError" class="error-message"></font>
                            </td>
                        </tr>
                        <tr>
                            <td><strong>Allowance(RM)</strong></td>
                            <td><input type="number" name="allowance" required>
                                <font id="allowanceError" class="error-message"></font>
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td align="left"><br /><input type="submit" name="button1" value="Submit"></td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>
    </div>

</body>

</html>

<?php
} 
?>