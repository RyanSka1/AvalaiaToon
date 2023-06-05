<?php
include 'db_conn.php';

$email = $_POST['email'];

$sql = "SELECT id FROM users WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();

$result = $stmt->get_result();
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $user_id = $row['id'];

    // Gera um token único
    $token = bin2hex(random_bytes(50));

    // Insere o token no banco de dados
    $sql = "INSERT INTO password_resets (user_id, token) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("is", $user_id, $token);
    $stmt->execute();

    // Envia um e-mail para o usuário com o link de redefinição de senha
    $reset_link = "http://yourwebsite.com/reset_password.php?token=$token";
    $message = "Clique no seguinte link para redefinir sua senha: $reset_link";
    mail($email, "Redefinição de senha", $message);

    echo "Um link de redefinição de senha foi enviado para o seu email!";
} else {
    echo "E-mail não encontrado!";
}

$conn->close();
?>
