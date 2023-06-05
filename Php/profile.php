<?php
    session_start();

    if (!isset($_SESSION['authenticated']) || !$_SESSION['authenticated'] || !isset($_SESSION['two_factor_authenticated']) || !$_SESSION['two_factor_authenticated']) {
        header('Location: login.html');
        exit();
    }

    if (isset($_SESSION['last_activity']) && time() - $_SESSION['last_activity'] > 3600) {
        session_unset();
        session_destroy();
        header('Location: login.html');
        exit();
    }

    $_SESSION['last_activity'] = time();

    // Aqui você pode fazer coisas como buscar informações adicionais do usuário no banco de dados.

    require_once 'db_config.php';

    $stmt = $conn->prepare("SELECT * FROM users WHERE id=? LIMIT 1");
    $stmt->bind_param('i', $_SESSION['user_id']);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    // por exemplo
    echo "Your email is: " . htmlspecialchars($user['email']);

    $stmt->close();
    $conn->close();
?>
