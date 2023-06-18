<?php
require 'vendor/autoload.php';
$mail = new PHPMailer\PHPMailer\PHPMailer();
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php'; 
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
include 'db_conn.php';
if ($conn && $conn->connect_error) {
    die("Erro de conexão: " . $conn->connect_error);
}


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $email = $_POST['email'];

    $verification_code = str_pad(mt_rand(0, 999999), 6, '0', STR_PAD_LEFT);

    $sql = "INSERT INTO users (username, password, email, verification_code) VALUES (?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $username, $password, $email, $verification_code);

    if ($stmt->execute()) {
        $mail = new PHPMailer();
        $mail->IsSMTP(); 
        $mail->Host = 'smtp.gmail.com'; 
        $mail->SMTPAuth = true;     
        $mail->Username = 'avalaiatoon@gmail.com'; 
        $mail->Password = 'papisantin1!'; 
        $mail->SMTPSecure = 'tls'; 
        $mail->Port = 587;
        $mail->SetFrom('avalaiatoon@gmail.com', 'AvalaiaToon');
        $mail->addAddress($email);
        $mail->Subject = "Confirmação de cadastro";
        $mail->Body = "Seu código de verificação é: $verification_code";

        if($mail->send()){
            echo "Usuário registrado com sucesso! Por favor, verifique seu e-mail para confirmar seu cadastro.";
        } else {
            echo "Erro ao enviar o e-mail.";
        }
    } else {
        echo "Erro: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>
