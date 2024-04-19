<?php
session_start();
if ($_SESSION["Login"] != "YES") {
    header("Location: login.php");
}
?>

<html>

<head>
    <title>Industrial Training Application</title>
    <link rel="stylesheet" href="image/main.css">
    <script>
    //When the page is loaded
    window.addEventListener('load', function() {
        let form = document.getElementById('application_form');
        let typeSelect = document.getElementById('type');
        let organizationSelected = document.getElementById('selected_organization');
        let training_session = document.getElementById('training_session');
        let address = document.getElementById('address');
        typeSelect.addEventListener('change', function() {
            form.submit();
        });
        organizationSelected.addEventListener('change', function() {
            form.submit();
        });
        address.addEventListener('oninput', function() {
            form.submit();
        });
        training_session.addEventListener('change', function() {
            form.submit();
        });

    });

    function updateform() {
        let typeSelect = document.getElementById('type');
        let organizationSelected = document.getElementById('selected_organization');
        let training_session = document.getElementById('training_session');
        let address = document.getElementById('address');
        let form = document.getElementById('application_form')
        if (typeSelect.value !== '' && organizationSelected.value !== '' && address.value !== '' && training_session !==
            '') {
            form.action = 'update_application.php';
        }
        // header("Location: view_application.php");
    }
    </script>
</head>

<body>

    <div class="grid-container">
        <div class="logo">
            <a href="mainPage.php">
                <img src="image/utmlogo.png" alt="utmlogo" width="150" height="50">
            </a>
            <h1>Application Form</h1>
            <button class="borderless-button logout" onclick="window.location.href='logout.php'">LOGOUT</button>
        </div>

        <div class="left-column2">
            <div>
                <button class="borderless-button left-column-button"
                    onclick="window.location.href='view_application.php'"><img src="image/icon/view.svg"
                        alt="studentlogo" width="25px" height="25px" />VIEW</button>
                <button class="borderless-button left-column-button"
                    onclick="window.location.href='application_form.php'" style="color:orange;"><img
                        src="image/icon/insert.svg" alt="studentlogo" width="25px" height="25px" />APPLY</button>
            </div>
            <div>
                <button class="borderless-button left-column-button"
                    onclick="window.location.href='view_application.php'"><img src="image/icon/back.svg"
                        alt="studentlogo" width="25px" height="25px" />BACK</button>
            </div>

        </div>

        <!-- Right Column -->
        <div class="right-column">
            <div class="right-column-distance">
                <br />
                <h3 style="text-align:center;">Please fill in the following information:</h3>
                <?php
                require_once("config.php");
                if (isset($_GET['id'])) {
                    $application_ID = $_GET['id'];
                    $sql = "SELECT *,a.address,o.type FROM application AS a INNER JOIN organization AS o ON a.organization_ID=o.organization_ID WHERE a.ApplicationID='$application_ID';";
                    $result = mysqli_query($conn, $sql);
                    $row = mysqli_fetch_assoc($result);
                    $_POST['type'] = $row['type'];
                    $_POST['selected_organization'] = $row['organization_ID'];
                    $_POST['training_session'] = $row['training_ID'];
                    $_POST['address'] = $row['address'];
                    $_POST['application_id'] = $application_ID;
                }

                ?>
                <form name="application_form" id="application_form" method="POST" action="application_form.php">
                    <table border="0">
                        <tr>
                            <input type="hidden" name="application_id" id="application_id" value="<?php if (isset($_POST['application_id'])) echo $_POST['application_id'];

                                                                                                    ?>">
                            <td><strong>Industrial Training Type</strong></td>
                            <td>
                                <select name="type" id="type" required>
                                    <option value="" <?php if (!isset($_POST['type'])) echo 'selected'; ?>>None</option>
                                    <?php

                                    $sql = "SELECT DISTINCT type FROM organization;";
                                    $result = mysqli_query($conn, $sql);
                                    while ($row = mysqli_fetch_assoc($result)) {
                                    ?>
                                    <option value="<?php echo $row['type'] ?>"
                                        <?php if (isset($_POST['type']) && $_POST['type'] == $row['type']) echo 'selected'; ?>>
                                        <?php echo $row['type'] ?>
                                    </option>
                                    <?php } ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td><strong>Organization</strong></td>
                            <?php if (isset($_POST['type']) && ($_POST['type'] !== "")) { ?>

                            <td>
                                <select name="selected_organization" id="selected_organization" required>
                                    <option value=""
                                        <?php if (!isset($_POST['selected_organization'])) echo 'selected'; ?>>None
                                    </option>
                                    <?php
                                        require_once("config.php");
                                        if (isset($_POST['type'])) {
                                            $selectedType = $_POST['type'];
                                            $sql = "SELECT DISTINCT name, organization_ID FROM organization WHERE type = '$selectedType';";
                                            $result = mysqli_query($conn, $sql);
                                            while ($row = mysqli_fetch_assoc($result)) {
                                        ?>
                                    <option value="<?php echo $row['organization_ID'] ?>"
                                        <?php if (isset($_POST['selected_organization']) && $_POST['selected_organization'] == $row['organization_ID']) echo 'selected'; ?>>
                                        <?php echo $row['name'] ?>
                                    </option>
                                    <?php }
                                        }
                                        ?>
                                </select>
                            </td>
                            <?php } ?>
                        </tr>
                        <tr>
                            <td><strong>Training Session</strong></td>
                            <?php if (isset($_POST['type']) && ($_POST['type'] !== "") && isset($_POST['selected_organization']) && ($_POST['selected_organization'] !== "")) { ?>

                            <td>
                                <select name="training_session" id="training_session" required>
                                    <option value=""
                                        <?php
                                                            if (isset($_POST['selected_organization'])) {
                                                                $selectedOrganization = $_POST['selected_organization'];
                                                            }
                                                            if (!isset($_POST['training_session'])) echo 'selected'; ?>>None
                                    </option>
                                    <?php
                                        if (isset($_POST['application_id']) && $_POST['application_id'] != '' && $_POST['selected_organization'] != '') {
                                            $application_ID = $_POST['application_id'];
                                            $sql = "SELECT DISTINCT t.training_ID,name 
                          FROM training_session AS t
                          INNER JOIN application AS a
                          ON t.training_ID=a.training_ID
                          WHERE a.organization_ID='$selectedOrganization'
                          AND ApplicationID='$application_ID';";
                                            $result = mysqli_query($conn, $sql);
                                            $row = mysqli_fetch_assoc($result);
                                            $session_name = $row['name'];
                                            $session_id = $row['training_ID'];
                                            if ($session_id != '') {
                                        ?>
                                    <option value="<?php echo $session_id ?>"
                                        <?php if ($_POST['training_session'] == $row['training_ID']) echo 'selected'; ?>>
                                        <?php echo $session_name ?>
                                    </option>
                                    <?php
                                            }
                                        }
                                        require_once("config.php");
                                        if (isset($_POST['selected_organization']) && ($_POST['type'] !== "")) {
                                            $username = $_SESSION['USER'];
                                            $sql = "SELECT matric FROM student WHERE username = '$username';";
                                            $result = mysqli_query($conn, $sql);
                                            $row = mysqli_fetch_assoc($result);
                                            $matric = $row['matric'];
                                            $sql = "SELECT DISTINCT t.training_ID,name 
                                FROM training_session AS t
                                WHERE t.training_ID NOT IN
                                (SELECT DISTINCT a.training_ID
                                FROM application AS a
                                WHERE a.matric='$matric')
                                AND current_amount<>required_amount
                                AND organization_ID='$selectedOrganization';
                                ";
                                            $result = mysqli_query($conn, $sql);

                                            while ($row = mysqli_fetch_assoc($result)) {
                                            ?>
                                    <option value="<?php echo $row['training_ID'] ?>"
                                        <?php if (isset($_POST['training_session']) && $_POST['training_session'] == $row['training_ID']) echo 'selected'; ?>>
                                        <?php echo $row['name'] ?>
                                    </option>
                                    <?php }
                                        }
                                        ?>
                                </select>
                            </td>
                            <?php } ?>
                        </tr>
                        <tr>
                            <td>
                                <strong>Student Current Address</strong>
                            </td>
                            <td>
                                <input type="text" name="address" id="address" size="100"
                                    style="text-transform:capitalize;"
                                    value="<?php if (isset($_POST['address'])) echo $_POST['address']; ?>" required>
                            </td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td></br>
                                <input type="submit" name="submit_button" value="<?php if (isset($_POST['application_id']) && ($_POST['application_id'] !== "")) echo 'Update';
                                                                                    else echo 'Apply'; ?>"
                                    onclick="updateform()">


                            </td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>
    </div>

</body>

</html>