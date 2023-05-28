<?php

include 'db_conn.php';

$email = $_POST['email'];

$sql = "SELECT email FROM users WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();

$result = $stmt->get_result();
if ($result->num_rows > 0) {
    echo "Um link de redefinição de senha foi enviado para o seu email!";
} else {
    echo "E-mail não encontrado!";
}

$conn->close();
?>
