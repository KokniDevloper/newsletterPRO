<?php
session_start();
$error = NULL;
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $conn = mysqli_connect('localhost', 'root', '', 'newsletterpro');
    $email = $_POST['email'];
    $pass = $_POST['password'];
    $prep =  mysqli_prepare($conn, "SELECT * from admin WHERE email = ?");
    mysqli_stmt_bind_param($prep, "s", $email);
    mysqli_stmt_execute($prep);
    $result = mysqli_stmt_get_result($prep);
    $row = mysqli_fetch_row($result);
    if ($row) {
        if ($pass == $row[2]) {
            $_SESSION['loggedin'] = true;
            header('Location: app.php');
            exit;
        } else {
            $error = "Wrong Password";
        }
    } else {
        $error = "Wrong Email";
    }
    mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
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
                    <legend>Login</legend>
                    <label for="email">Email: </label><br>
                    <input type="email" name="email" id="email" required><br><br>
                    <label for="password">Password: </label><br>
                    <input type="password" name="password" id="password" minlength="8" required><br><br>
                    <input type="submit" value="Login">
                </fieldset>
            </form>
            <br>
            <h1>
                <?php
                if ($error != NULL)
                    echo $error;
                ?>
            </h1>
        </div>
    </div>
</body>

</html>