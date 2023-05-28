<?php
include 'db_conn.php';
session_start(); // Inicia a sessão

$username = $_POST['username'];
$password = $_POST['password'];

$sql = "SELECT id, username, password FROM users WHERE username = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $username);
$stmt->execute();

$result = $stmt->get_result();
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    if (password_verify($password, $row['password'])) {
        // Armazena os dados do usuário na sessão
        $_SESSION['user_id'] = $row['id'];
        $_SESSION['username'] = $row['username'];
        echo "Login efetuado com sucesso!";
    } else {
        echo "Senha incorreta!";
    }
} else {
    echo "Usuário não encontrado!";
}

$conn->close();
?>
