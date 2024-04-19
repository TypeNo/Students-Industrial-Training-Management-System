<?php
session_start(); // Start up your PHP Session

// echo $_SESSION["Login"]; //for session tracking purpose, can delete
// echo $_SESSION["LEVEL"]; //for session tracking purpose, can delete

// If the user is not logged in, send them to the login form
if ($_SESSION["Login"] != "YES") {
    header("Location: login.php");
}

if ($_SESSION["LEVEL"] == 1) {
?>

<html>

<head>
    <title>Inserting Coordinator Data</title>
    <link rel="stylesheet" href="image/main.css">
    <script src="validation_form.js"></script>
</head>

<body>

    <div class="grid-container">
        <div class="logo">
            <a href="mainPage.php">
                <img src="image/utmlogo.png" alt="utmlogo" width="150" height="50">
            </a>
            <h1>Coordinator Data Form</h1>
            <button class="borderless-button logout" onclick="window.location.href='logout.php'">LOGOUT</button>
        </div>

        <div class="left-column2">
            <?php
                if ($_SESSION["LEVEL"] == 1) { ?>
            <div class="left-column-up">
                <button class="borderless-button left-column-button"
                    onclick="window.location.href='view_coordinator.php'"><img src="image/icon/view.svg"
                        alt="studentlogo" width="25px" height="25px" />VIEW</button>
                <button class="borderless-button left-column-button"
                    onclick="window.location.href='coordinator_form.php'" style="color:orange;"><img
                        src="image/icon/insert.svg" alt="studentlogo" width="25px" height="25px" />INSERT</button>
            </div>
            <div>
                <button class="borderless-button left-column-button" onclick="window.location.href='mainPage.php'"><img
                        src="image/icon/back.svg" alt="studentlogo" width="25px" height="25px" />BACK</button>
            </div>
            <?php } ?>

        </div>

        <!-- Right Column -->
        <div class="right-column">
            <div class="right-column-distance">
                <br />
                <h3 style="text-align:center;">Please fill in the following information:</h3>

                <form name="form" method="POST" action="insert_coordinator.php"
                    onsubmit="return validateCoordinator();">
                    <table border="0">
                        <tr>
                            <td><strong>Coordinator's First Name</strong></td>
                            <td><input type="text" name="firstName" size="50" style="text-transform:uppercase;"
                                    required>
                                <font id="firstNameError" class="error-message"></font>
                            </td>
                        </tr>
                        <tr>
                            <td><strong>Coordinator's Last Name</strong></td>
                            <td><input type="text" name="lastName" size="50" style="text-transform:uppercase;" required>
                                <font id="lastNameError" class="error-message"></font>
                            </td>
                        </tr>
                        <tr>
                            <td><strong>Email</strong></td>
                            <td><input type="text" name="email" size="50" required>
                                <font id="emailError" class="error-message"></font>
                            </td>
                        </tr>
                        <tr>
                            <td><strong>Organization</strong></td>
                            <td>
                                <select name="selected_organization_ID" id="selected_organization_ID" required>
                                    <option value=""
                                        <?php if (!isset($_POST['selected_organization'])) echo 'selected'; ?>>None
                                    </option>
                                    <?php
                                        require("config.php");


                                        $sql = "SELECT DISTINCT name, organization_ID FROM organization";
                                        $result = mysqli_query($conn, $sql);
                                        while ($row = mysqli_fetch_assoc($result)) {
                                        ?>
                                    <option value="<?php echo $row['organization_ID'] ?>"
                                        <?php if (isset($_POST['selected_organization']) && $_POST['selected_organization'] == $row['organization_ID']) echo 'selected'; ?>>
                                        <?php echo $row['name'] ?>
                                    </option>
                                    <?php }

                                        ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td><strong>Username</strong></td>
                            <td><input type="text" name="username" size="30" required>
                                <font id="usernameError" class="error-message"></font>
                            </td>
                        </tr>
                        <tr>
                            <td><strong>Password</strong></td>
                            <td><input type="password" name="password" size="30" required>
                                <font id="passwordError" class="error-message"></font>
                            </td>
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
    // If the user is not the correct level
} else if ($_SESSION["LEVEL"] != 1) {
    echo "<p>Wrong User Level! You are not authorized to view this page</p>";
    echo "<p><a href='mainPage.php'>Go back to main page</a></p>";
    echo "<p><a href='logout.php'>LOGOUT</a></p>";
}
?>