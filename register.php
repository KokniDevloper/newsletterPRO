<?php
session_start();
$conn = mysqli_connect('localhost', 'root', '', 'newsletterpro');
$query = 'SELECT * FROM admin';
$result = mysqli_query($conn, $query);
if (mysqli_num_rows($result) != 0) {
    header("Location: login.php");
    exit;
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $pass = $_POST['password'];
    $prep =  mysqli_prepare($conn, "INSERT INTO `admin` (`email`, `password`) VALUES (?, ?)");
    mysqli_stmt_bind_param($prep, "ss", $email, $pass);
    mysqli_stmt_execute($prep);
    mysqli_close($conn);
    $_SESSION['loggedin'] = true;
    header('Location: app.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="main">
        <header>
            <nav>
                <h3>
                    <a class="primary-text" href="index.html">Newsletter Pro</a>
                </h3>
            </nav>
        </header>
        <div class="hero">
            <form method="POST" class="primary-text">
                <fieldset>
                    <legend>Register</legend>
                    <label for="email">Email: </label><br>
                    <input type="email" name="email" id="email" required><br><br>
                    <label for="password">Password: </label><br>
                    <input type="password" name="password" id="password" minlength="8" required><br><br>
                    <input type="submit" value="Register">
                </fieldset>
            </form>
        </div>
    </div>
</body>

</html>