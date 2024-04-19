<?php
    if (isset($_GET['Message'])) {
        echo '<script>alert("' . $_GET['Message'] . '")</script>';
    }
?>

<html>

<head>
    <title>Login</title>
    <link rel="stylesheet" href="image/login.css">
</head>

<body class="center">
    <div>
        <div class="login">
            <b>Welcome to our system! Please log in</b>
            <br><br>
            <form method="post" action="index.php">
                <p>Username: <input type="text" name="username" placeholder="username" required /></p>
                <p>Password: <input type="password" name="password" placeholder="password" required /></p>
                <p><input type="submit" value="LOG IN" /></p>
            </form>
        </div>
    </div>
</body>

</html>