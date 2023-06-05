<?php

include 'db_conn.php';

$userId = $_GET['user'];
$hash = $_GET['hash'];

$sql = "SELECT id FROM users WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $userId);
$stmt->execute();

$result = $stmt->get_result();
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    if (password_verify($row['id'], $hash)) {
        $sql = "UPDATE users SET verified = 1 WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $userId);
        if ($stmt->execute()) {
            echo "Cadastro confirmado com sucesso!";
        } else {
            echo "Erro ao confirmar cadastro.";
        }
    } else {
        echo "Código de confirmação inválido!";
    }
} else {
    echo "Usuário não encontrado!";
}

$conn->close();
?>
