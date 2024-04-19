<?php
        session_start(); // Start up your PHP Session

        if ($_SESSION["Login"] != "YES") {
            header("Location: login.php");
        } 
        require("config.php");

$welcomeMessage = "Welcome, ";
if ($_SESSION["LEVEL"] == '1') {
    $welcomeMessage .= "admin";
} elseif ($_SESSION["LEVEL"] == '2') {
    // Retrieve the coordinator's name from the database
    $sql = "SELECT CONCAT(firstName, ' ', lastName) AS coordinatorName FROM Coordinator WHERE username = '{$_SESSION['USER']}'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $coordinatorName = $row['coordinatorName'];
    $welcomeMessage .= "Coordinator " . $coordinatorName;
} elseif ($_SESSION["LEVEL"] == '3') {
    // Retrieve the student's name from the database
    $sql = "SELECT CONCAT(firstName, ' ', lastName) AS studentName FROM student WHERE username = '{$_SESSION['USER']}'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $studentName = "Student " . $row['studentName'];
    $welcomeMessage .= $studentName;
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>User Main Page</title>
    <link rel="stylesheet" href="image/main.css">
</head>

<body>
    <div class="grid-container">
        <div class="logo">
            <!-- Your logo content here -->
            <a href="mainPage.php">
                <img src="image/utmlogo.png" alt="utmlogo" width="150" height="50">
            </a>
            <h1>Students' Industrial Training Management System</h1>
            <button class="borderless-button logout" onclick="window.location.href='logout.php'">LOGOUT</button>
            <!-- <a href="logout.php">LOGOUT</a> -->
        </div>

        <div class="left-column1">
            <?php
        if ($_SESSION["LEVEL"] == 1) { ?>

            <button class="borderless-button left-column-button" onclick="window.location.href='view_student.php'"><img
                    src="image/icon/student.svg" alt="studentlogo" width="25px" height="25px" />STUDENT</button>
            <button class="borderless-button left-column-button"
                onclick="window.location.href='view_coordinator.php'"><img src="image/icon/coordinator.svg"
                    alt="coordinatorlogo" width="25px" height="25px" />COORDINATOR</button>
            <button class="borderless-button left-column-button"
                onclick="window.location.href='view_organization.php'"><img src="image/icon/organization.svg"
                    alt="organizationlogo" width="25px" height="25px" />ORGANIZATION</button>
            <button class="borderless-button left-column-button"
                onclick="window.location.href='view_training_session.php'"><img src="image/icon/training-session.svg"
                    alt="trainingsessionlogo" width="25px" height="25px" />TRAINING SESSION</button>
            <button class="borderless-button left-column-button"
                onclick="window.location.href='view_application.php'"><img src="image/icon/application.svg"
                    alt="applicationlogo" width="25px" height="25px" />APPLICATION</button>

            <?php } else if ($_SESSION["LEVEL"] == 2) {?>
            <button class="borderless-button left-column-button"
                onclick="window.location.href='update_coordinator_form.php'"><img src="image/icon/profile.svg"
                    alt="profilelogo" width="25px" height="25px" />PROFILE</button>
            <button class="borderless-button left-column-button" onclick="window.location.href='view_student.php'"><img
                    src="image/icon/student.svg" alt="studentlogo" width="25px" height="25px" />STUDENT</button>
            <button class="borderless-button left-column-button"
                onclick="window.location.href='view_training_session.php'"><img src="image/icon/training-session.svg"
                    alt="trainingsessionlogo" width="25px" height="25px" />TRAINING SESSION</button>
            <button class="borderless-button left-column-button"
                onclick="window.location.href='view_application.php'"><img src="image/icon/application.svg"
                    alt="applicationlogo" width="25px" height="25px" />APPLICATION</button>

            <?php } else if ($_SESSION["LEVEL"] == 3) {?>
            <button class="borderless-button left-column-button"
                onclick="window.location.href='update_student_form.php'"><img src="image/icon/profile.svg"
                    alt="profilelogo" width="25px" height="25px" />PROFILE</button>
            <button class="borderless-button left-column-button"
                onclick="window.location.href='view_training_session.php'"><img src="image/icon/training-session.svg"
                    alt="trainingsessionlogo" width="25px" height="25px" />TRAINING SESSION</button>
            <button class="borderless-button left-column-button"
                onclick="window.location.href='view_application.php'"><img src="image/icon/application.svg"
                    alt="applicationlogo" width="25px" height="25px" />APPLICATION</button>
            <?php }?>
        </div>

        <div class="right-column">
            <div class="right-content">
                <!-- Content for right column -->
                <h1><?php echo $welcomeMessage; ?></h1>
                <!-- <h1>Welcome to the Students' Industrial Training Management System!</h2> -->
                <p>Here, you can access various features and resources to facilitate the practical training process.
                </p></br></br>
                <div class="right-content-1">
                    <p style="text-align: justify;"><img class="right-pic-left" src="image/right-content-1.jpg"
                            width="40%" height="40%" />
                        <font class="right-content-theme">Gain Real-World Experience</font></br>
                        Our Students' Industrial Training Management System provides you with the opportunity to
                        gain practical, hands-on experience in your field of study.
                        By participating in industrial training, you'll have the chance to apply your knowledge and
                        skills in real-world settings, preparing you for your future career.
                    </p>
                </div>
                </br>
                <div class="right-content-2">
                    <p style="text-align: justify;"><img class="right-pic-right" src="image/right-content-2.jpg"
                            width="40%" height="40%" />
                        <font class="right-content-theme">Explore Career Pathway</font></br>
                        Industrial training exposes you to different industries and organizations, allowing you to
                        explore various career pathways.
                        Discover your interests, strengths, and passions as you engage with professionals and work
                        on meaningful projects.
                        This experience can help you make informed decisions about your future career direction.
                    </p>
                </div>
                </br>
                <div class="right-content-3">
                    <p style="text-align: justify;"><img class="right-pic-left" src="image/right-content-3.jpg"
                            width="40%" height="40%" />
                        <font class="right-content-theme">Personal and Professional Growth</font></br>
                        Personal and Professional Growth: Industrial training offers a transformative journey of
                        personal and professional growth.
                        It goes beyond the acquisition of technical skills, as it presents you with opportunities to
                        develop and refine essential qualities that are highly valued in the workplace and life in
                        general.
                        Through industrial training, you are challenged to step out of your comfort zone, confront
                        new and unfamiliar situations, and push the boundaries of your capabilities.
                        </br>
                        One of the key benefits of industrial training is the cultivation of resilience.
                        As you navigate through the challenges and complexities of a real work environment, you
                        build the ability to bounce back from setbacks,
                        adapt to unexpected circumstances, and persevere in the face of adversity.
                    </p>
                </div>
            </div>
        </div>
        <?php if ($_SESSION["LEVEL"] == 3) {?>
        <img class="cat" src="image/addition/cat.png" alt="Cat" />
        <script>
        var minX = window.innerWidth * 0.11;
        var minY = window.innerHeight * 0.50;
        var maxY = window.innerHeight * 0.90;
        var audio = new Audio("image/addition/meow.mp3");

        function randomPosition() {
            var x = Math.random() * minX;
            var y = Math.random() * (maxY - minY) + minY;
            document.querySelector(".cat").style.top = y + "px";
            document.querySelector(".cat").style.left = x + "px";
            if (audio.paused) {
                audio.play();
            } else {
                audio.currentTime = 0;
            }
        }

        document.querySelector(".cat").onclick = randomPosition;
        </script>
        <?php }?>
</body>

</html>