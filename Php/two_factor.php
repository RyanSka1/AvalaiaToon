<?php
    session_start();
    include 'session_manager.php';
    require_once 'db_config.php';
    require_once 'vendor/autoload.php';
    
    $username = $_SESSION['username'];
    $two_factor_code = $_POST['two_factor_code'];

    $stmt = $conn->prepare("SELECT * FROM users WHERE username=? LIMIT 1");
    $stmt->bind_param('s', $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    $ga = new PHPGangsta_GoogleAuthenticator();
    $checkResult = $ga->verifyCode($user['secret'], $two_factor_code, 2);

    if ($checkResult) {
        $_SESSION['two_factor_authenticated'] = true;
        $_SESSION['last_activity'] = time();
        header('Location: profile.html');
    } else {
        echo "Invalid two factor code";
    }

    $stmt->close();
    $conn->close();
?>
