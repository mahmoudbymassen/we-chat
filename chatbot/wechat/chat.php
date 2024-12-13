<?php
    include("database.php"); 
    session_start(); 

    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        $_SESSION['chat_history'] = []; 
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST["question"])) {
        $question = $_POST["question"];
        $question = mysqli_real_escape_string($conn, $question);

        $sql = "SELECT * FROM programmingqa WHERE question = LOWER('$question')";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $reply = $row["reply"];
        } else {
            $reply = "Sorry, I can't understand your question.";
        }

        $_SESSION['chat_history'][] = [
            "user" => $question,
            "bot" => $reply
        ];
    }

    mysqli_close($conn);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="chat.css">
    <title>Chat</title>
</head>
<body>
    <h1>WE CHAT</h1>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
    <div>
        <?php if (!empty($_SESSION['chat_history'])): ?>
            <?php foreach ($_SESSION['chat_history'] as $chat): ?>
                <div class="message user">
                    <div class="bubble"><?php echo htmlspecialchars($chat["user"]); ?></div>
                    <div class="avatar">ME</div>
                </div>
                <div class="message bot">
                    <div class="avatar">AI</div>
                    <div class="bubble"><?php echo htmlspecialchars($chat["bot"]); ?></div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>

    <div class="qr">
        <input type="text" name="question" placeholder="Type something here.." class="data" required>
        <input type="submit" name="send" value="Send" class="btn2">
    </div>
    </form>
</body>
</html>
