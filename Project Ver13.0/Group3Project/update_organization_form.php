<?php
session_start(); // Start up your PHP Session

if ($_SESSION["Login"] != "YES") {
    header("Location: index.php");
}

if ($_SESSION["LEVEL"] == 1) { // Only user level 1 can access
    ?>
<html>

<head>
    <title>Updating Organization Data</title>
    <link rel="stylesheet" href="image/main.css">
</head>

<body>

    <?php
    $ID = $_GET['id'];

    require("config.php"); // Read up on PHP includes: https://www.w3schools.com/php/php_includes.asp

    // Retrieve data from the database
    $sql = "SELECT * FROM Organization WHERE organization_ID='$ID'";
    $result = mysqli_query($conn, $sql);
    $rows = mysqli_fetch_assoc($result);
    ?>

    <div class="grid-container">
        <div class="logo">
            <a href="mainPage.php">
                <img src="image/utmlogo.png" alt="utmlogo" width="150" height="50">
            </a>
            <h1>Update Organization Data</h1>
            <button class="borderless-button logout" onclick="window.location.href='logout.php'">LOGOUT</button>
        </div>

        <div class="left-column2">

            <?php
        if ($_SESSION["LEVEL"] == 1) { ?>
            <div>
                <button class="borderless-button left-column-button"
                    onclick="window.location.href='view_organization.php'">VIEW</button>
                <button class="borderless-button left-column-button"
                    onclick="window.location.href='organization_form.php'">INSERT</button>
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
                <form name="form1" method="post" action="update_organization.php">
                    <table border="0" cellspacing="5" cellpadding="0">
                        <tr>
                            <td align="center"><input name="id" type="hidden" id="id"
                                    value="<?php echo $rows['organization_ID']; ?>"></td>
                        </tr>
                        <tr>
                            <td><strong>Name</strong></td>
                            <td align="center"><input name="name" type="text" id="name" size="30" style='width: 375px;'
                                    value="<?php echo $rows['name']; ?>" required></td>
                        </tr>
                        <tr>
                            <td><strong>Address</strong></td>
                            <td align="center">
                                <textarea name="address" id="address" rows="4" cols="30"
                                    style="text-transform:capitalize; width: 375px;"
                                    required><?php echo $rows['address']; ?></textarea>
                            </td>

                        </tr>
                        <tr>
                            <td><strong>Type</strong></td>
                            <td>
                                <select name="type" id="type" required>
                                    <option value="<?php echo $rows['type']; ?>" <?php echo 'selected'; ?>>
                                        <?php echo $rows['type']?></option>
                                    <option value="Gaming">Gaming</option>
                                    <option value="IT">IT</option>
                                    <option value="System Builders">System Builders</option>
                                    <option value="E-commerce">E-commerce</option>
                                    <option value="Repair and Support">Repair and Support</option>
                            </td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td><br /><input type="submit" name="Submit" value="Update"></td>
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
} else if ($_SESSION["LEVEL"] != 1) { // If the user is not the correct level
    echo "<p>Wrong User Level! You are not authorized to view this page</p>";
    echo "<p><a href='mainPage.php'>Go back to the main page</a></p>";
    echo "<p><a href='logout.php'>LOGOUT</a></p>";
}
?>