<?php
session_start(); // Start up your PHP Session

if ($_SESSION["Login"] != "YES") // If the user is not logged in or has been logged out
    header("Location: login.php"); // Redirect user to the login page

if ($_SESSION["LEVEL"] == 1) { // Only user level 1 can access
    ?>
<html>

<head>
    <title>Updating Coordinator Data</title>
    <link rel="stylesheet" href="image/main.css">
    <script src="validation_form.js"></script>
</head>

<body>

    <?php
    $ID = $_GET['id'];

    require("config.php"); // Read up on PHP includes: https://www.w3schools.com/php/php_includes.asp

    // Retrieve data from the database
    $sql = "SELECT c.*, u.password, o.* FROM Coordinator AS c
        INNER JOIN user AS u ON c.username = u.username
        INNER JOIN organization AS o ON c.organization_ID = o.organization_ID
        WHERE c.coordinate_ID='$ID'";
    $result = mysqli_query($conn, $sql);
    $rows = mysqli_fetch_assoc($result);
    ?>

    <div class="grid-container">
        <div class="logo">
            <a href="mainPage.php">
                <img src="image/utmlogo.png" alt="utmlogo" width="150" height="50">
            </a>
            <h1>Update Coordinator Data</h1>
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
            <div class="right-column-distance">
                <br />
                <h3 style="text-align:center;">Please fill in the following information:</h3>
                <form name="form" method="post" action="update_coordinator.php"
                    onsubmit="return validateCoordinator();">
                    <table border="0" cellspacing="5" cellpadding="0">
                        <tr>
                            <td align="left"><input name="id" type="hidden" id="id"
                                    value="<?php echo $rows['coordinate_ID']; ?>"></td>
                        </tr>
                        <tr>
                            <td align="left"><strong>First Name</strong></td>
                            <td align="left"><input name="firstName" type="text" id="firstName" size="30"
                                    value="<?php echo $rows['firstName']; ?>" style="text-transform:uppercase;"
                                    required>
                                <font id="firstNameError" class="error-message"></font>
                            </td>
                        </tr>
                        <tr>
                            <td align="left"><strong>Last Name</strong></td>
                            <td align="left"><input name="lastName" type="text" id="lastName" size="30"
                                    value="<?php echo $rows['lastName']; ?>" style="text-transform:uppercase;" required>
                                <font id="lastNameError" class="error-message"></font>
                            </td>
                        </tr>
                        <tr>
                            <td align="left"><strong>Email</strong></td>
                            <td align="left"><input name="email" type="text" id="email" size="30"
                                    value="<?php echo $rows['email']; ?>" required>
                                <font id="emailError" class="error-message"></font>
                            </td>
                        </tr>
                        <tr>
                            <td align="left"><strong>Organization ID</strong></td>
                            <td align="left">
                                <select name="selected_organization_ID" id="selected_organization_ID" required>
                                    <option value="<?php echo $rows['organization_ID']; ?>" <?php echo 'selected'; ?>>
                                        <?php echo $rows['name']?></option>
                                    <?php
                    require("config.php");
                      
                        $sql = "SELECT DISTINCT name, organization_ID FROM organization";
                        $result = mysqli_query($conn, $sql);
                        while ($row = mysqli_fetch_assoc($result)) {
                            ?>
                                    <option value="<?php echo $row['organization_ID'] ?>"
                                        <?php if(isset($_POST['selected_organization']) && $_POST['selected_organization'] == $row['organization_ID']) echo 'selected'; ?>>
                                        <?php echo $row['name'] ?>
                                    </option>
                                    <?php }
                    
                    ?>
                                </select>
                            </td>
                        </tr>

                        <tr>
                            <td align="left"><strong>Username</strong></td>
                            <td align="left"><?php echo $rows['username']; ?><input name="username" type="hidden"
                                    id="username" value="<?php echo $rows['username']; ?>" required>
                                <font id="usernameError" class="error-message"></font>
                            </td>
                        </tr>
                        <tr>
                            <td align="left"><strong>Password</strong></td>
                            <td align="left"><input name="password" type="text" id="password" size="30"
                                    value="<?php echo $rows['password']; ?>" required>
                                <font id="passwordError" class="error-message"></font>
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td><br /><input type="submit" name="Submit" value="Update"></td>
                        </tr>

                    </table>
                </form>
            </div>
        </div>

</body>

</html>
<?php
    mysqli_close($conn);
} else if ($_SESSION["LEVEL"] == 2) { // only user level 2 can access ?>
<html>

<head>
    <title>Updating Coordinator Data</title>
    <link rel="stylesheet" href="image/main.css">
    <script src="validation_form.js"></script>
</head>

<body>

    <?php
    $username = $_SESSION["USER"];

    require("config.php"); // Read up on PHP includes: https://www.w3schools.com/php/php_includes.asp

    // Retrieve data from the database
    $sql = "SELECT c.*, u.password, o.* FROM Coordinator AS c
        INNER JOIN user AS u ON c.username = u.username
        INNER JOIN organization AS o ON c.organization_ID = o.organization_ID
        WHERE c.username = '$username'";
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
            <?php
        if ($_SESSION["LEVEL"] == 2) { ?>
            <div>
                <button class="borderless-button left-column-button"
                    onclick="window.location.href='update_coordinator_form.php'" style="color:orange;"><img
                        src="image/icon/profile.svg" alt="studentlogo" width="25px" height="25px" />PROFILE</button>
            </div>
            <div>
                <button class="borderless-button left-column-button" onclick="window.location.href='mainPage.php'"><img
                        src="image/icon/back.svg" alt="studentlogo" width="25px" height="25px" />BACK</button>
            </div>
            <?php }?>

        </div>

        <!-- Right Column -->
        <div class="right-column">
            <div class="right-column-distance">
                <form name="form" method="post" action="update_coordinator.php"
                    onsubmit="return validateCoordinator();">
                    <table border="0" cellspacing="5" cellpadding="0">
                        <tr>
                            <td align="left"><input name="id" type="hidden" id="id"
                                    value="<?php echo $rows['coordinate_ID']; ?>"></td>
                        </tr>
                        <tr>
                            <td align="left"><strong>First Name</strong></td>
                            <td align="left"><input name="firstName" type="text" id="firstName" size="30"
                                    value="<?php echo $rows['firstName']; ?>" style="text-transform:uppercase;"
                                    required>
                                <font id="firstNameError" class="error-message"></font>
                            </td>
                        </tr>
                        <tr>
                            <td align="left"><strong>Last Name</strong></td>
                            <td align="left"><input name="lastName" type="text" id="lastName" size="30"
                                    value="<?php echo $rows['lastName']; ?>" style="text-transform:uppercase;" required>
                                <font id="lastNameError" class="error-message"></font>
                            </td>
                        </tr>
                        <tr>
                            <td align="left"><strong>Email</strong></td>
                            <td align="left"><input name="email" type="text" id="email" size="30"
                                    value="<?php echo $rows['email']; ?>" required>
                                <font id="emailError" class="error-message"></font>
                            </td>
                        </tr>
                        <tr>
                            <td align="left"><strong>Organization</strong></td>
                            <td align="left"><?php echo $rows['name']?>
                            </td>
                        </tr>
                        <tr>
                            <td align="left"><strong>Address</strong></td>
                            <td><?php echo $rows['address']; ?></td>
                        </tr>
                        <tr>
                            <td align="left"><strong>Type</strong></td>
                            <td><?php echo $rows['type']; ?></td>
                        </tr>
                        <tr>
                            <td><strong>Username</strong></td>
                            <td><?php echo $rows['username']; ?><input type="hidden" name="username" size="20"
                                    value="<?php echo $rows['username']; ?>"></td>
                            <font id="usernameError" class="error-message"></font>
                        </tr>
                        <tr>
                            <td><strong>Password</strong></td>
                            <td><input type="text" name="password" size="20" value="<?php echo $rows['password']; ?>"
                                    required>
                                <font id="passwordError" class="error-message"></font>
                            </td>
                        </tr>
                        <tr>
                            <td><input name="selected_organization_ID" type="hidden" id="id"
                                    value="<?php echo $rows['organization_ID']; ?>"></td>

                            <td><br /><input type="submit" name="button1" value="Update"></td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>

</body>

</html>

<?php
} else if ($_SESSION["LEVEL"] == 3) { // If the user is not the correct level
    echo "<p>Wrong User Level! You are not authorized to view this page</p>";
    echo "<p><a href='mainPage.php'>Go back to the main page</a></p>";
    echo "<p><a href='logout.php'>LOGOUT</a></p>";
}
?>