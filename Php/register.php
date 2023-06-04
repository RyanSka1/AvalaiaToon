<?php
include 'php/db_conn.php';
include 'db_conn.php';

$username = $_POST['username'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);
$email = $_POST['email'];

$sql = "INSERT INTO users (username, password, email, cpf, phone, verified) VALUES (?, ?, ?, ?, ?, 0)";

$stmt = $conn->prepare($sql);
$stmt->bind_param("sssss", $username, $password, $email, $cpf, $phone);

if ($stmt->execute()) {
    $userId = $conn->insert_id;
    $hash = password_hash($userId, PASSWORD_DEFAULT);

    $subject = "Confirmação de cadastro em AvalaiaToon";
    $message = "Clique no link a seguir para confirmar seu cadastro: http://yourwebsite.com/confirm.php?user=$userId&hash=$hash";
    $headers = "From: no-reply@yourwebsite.com";

    mail($email, $subject, $message, $headers);

    echo "Usuário registrado com sucesso! Por favor, verifique seu e-mail para confirmar seu cadastro.";
} else {
    echo "Erro: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
