<?php
session_start(); // Start up your PHP Session

if ($_SESSION["Login"] != "YES") {
    header("Location: login.php");
}

if ($_SESSION["LEVEL"] == 1) {
    ?>

<html>

<head>
    <title>Inserting Organization Data</title>
    <link rel="stylesheet" href="image/main.css">
</head>

<body>

    <div class="grid-container">
        <div class="logo">
            <a href="mainPage.php">
                <img src="image/utmlogo.png" alt="utmlogo" width="150" height="50">
            </a>
            <h1>Organization Data Form</h1>
            <button class="borderless-button logout" onclick="window.location.href='logout.php'">LOGOUT</button>
        </div>

        <div class="left-column2">

            <?php
        if ($_SESSION["LEVEL"] == 1) { ?>
            <div class="left-column-up">
                <button class="borderless-button left-column-button"
                    onclick="window.location.href='view_organization.php'"><img src="image/icon/view.svg"
                        alt="studentlogo" width="25px" height="25px" />VIEW</button>
                <button class="borderless-button left-column-button"
                    onclick="window.location.href='organization_form.php'" style="color:orange;"><img
                        src="image/icon/insert.svg" alt="studentlogo" width="25px" height="25px" />INSERT</button>
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
                <form name="form1" method="POST" action="insert_organization.php">
                    <table border="0">
                        <tr>
                            <td><strong>Organization Name</strong></td>
                            <td><input type="text" name="name" size="50" style="text-transform:uppercase; width: 375px;"
                                    required>
                            </td>
                        </tr>
                        <tr>
                            <td><strong>Address</strong></td>
                            <td><textarea name="address" rows="4" cols="50"
                                    style="text-transform:capitalize; width: 375px;"></textarea></td>

                        </tr>
                        <tr>
                            <td><strong>Type</strong></td>
                            <td>
                                <select name="type" required>
                                    <option value="Gaming">Gaming</option>
                                    <option value="IT">IT</option>
                                    <option value="System Builders">System Builders</option>
                                    <option value="E-commerce">E-commerce</option>
                                    <option value="Repair and Support">Repair and Support</option>
                                </select>
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
    <!--  -->
</body>

</html>

<?php
} else {
    echo "<p>Wrong User Level! You are not authorized to view this page</p>";
    echo "<p><a href='mainPage.php'>Go back to the main page</a></p>";
    echo "<p><a href='logout.php'>LOGOUT</a></p>";
}
?>