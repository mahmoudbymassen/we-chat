<?php
include("database.php"); 

$error = ""; 

if (isset($_POST["login"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];

    
    $username = mysqli_real_escape_string($conn, $username);
    $password = mysqli_real_escape_string($conn, $password);

    $sql = "SELECT * FROM users WHERE username = '$username' AND pwd = '$password'";
    $result = mysqli_query($conn, $sql);
    $count = mysqli_num_rows($result);

    if ($count > 0) {
        header("Location: chat.php");
        exit();
    } else {
        $error = "Username or password is incorrect";
    }
}
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="login.css">
    <title>Log In</title>
</head>
<body>
    <h1>WELCOME TO WE CHAT</h1>
    
    <div class="container">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" class="form1"><br>
            <input type="text" placeholder="Enter your username" name="username" required><br>
            <input type="password" placeholder="Enter your Password" name="password" required><br>
            <input type="submit" value="Log In" name="login" class="btn1"><br>
            
            <?php if (!empty($error)): ?>
                <p class="error"><?php echo $error; ?></p>
            <?php endif; ?>
            <a href="signup.php">Don't have an account? Sign Up</a>
        </form>
        <img src="images/bg.jpg" alt="bg">
    </div>
</body>
</html>



