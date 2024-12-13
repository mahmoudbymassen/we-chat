<?php
    include("database.php"); 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="signup.css">
    <title>sign up</title>
</head>
<body>
    
        <h1 >WELCOME TO WE CHAT</h1>
    
    <div class="container">
        <form action="<?php htmlspecialchars(($_SERVER["PHP_SELF"]))?>" method="post" class="form1"><br>
            
                <input type="text" placeholder="Enter your username" name="username"><br>
            
            
                <input type="password" placeholder="Enter your Password" name="password" ><br>
            
            
                <input type="submit" value="signup" name="signup" class="btn1"><br>
            
            
                <a href="login.php">You have an account ? log in</a>
            
    </form>
    <img src="images/bg.jpg" alt="bg">
    </div>
</body>
</html>

<?php
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $username = filter_input(INPUT_POST,"username", FILTER_SANITIZE_SPECIAL_CHARS);
        $password = filter_input(INPUT_POST,"password", FILTER_SANITIZE_SPECIAL_CHARS);
    

    if (empty($username)){
        echo "";
    }
    elseif (empty($password)){
        echo "";
    }
    
    else{
        
        $sql = "INSERT INTO users (username , pwd) 
                VALUES('$username' , '$password')  ";
        mysqli_query($conn, $sql);
        header("Location:chat.php");
    }
}
    // mysqli_close($conn);
?>