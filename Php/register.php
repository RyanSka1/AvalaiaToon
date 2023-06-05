<?php
include 'db_conn.php';

$username = $_POST['username'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);
$email = $_POST['email'];
$cpf = $_POST['cpf'];
$phone = $_POST['phone'];

$sql = "INSERT INTO users (username, password, email, cpf, phone, verified) VALUES (?, ?, ?, ?, ?, 0)";

$stmt = $conn->prepare($sql);
$stmt->bind_param("sssss", $username, $password, $email, $cpf, $phone);

if ($stmt->execute()) {
    $userId = $conn->insert_id;
    $hash = password_hash($userId, PASSWORD_DEFAULT);

    $subject = "Confirmação de cadastro em AvalaiaToon";
    $message = "Clique no link a seguir para confirmar seu cadastro: http://yourwebsite.com/confirm.php?user=$userId&hash=$hash";
    $headers = "From: no-reply@yourwebsite.com";

    // Usando PHPMailer
    use \PHPMailer\src\PHPMailer;
    use \PHPMailer\src\Exception;
    require 'PHPMailer-master/src/Exception.php'; 
    require 'PHPMailer-master/src/PHPMailer.php';
    require 'PHPMailer-master/src/SMTP.php';

    $mail = new PHPMailer();

    // Configuração
    $mail->Mailer = "smtp";
    $mail->IsSMTP(); 
    $mail->CharSet = 'UTF-8';   
    $mail->SMTPDebug = 0;
    $mail->SMTPAuth = true;     
    $mail->SMTPSecure = 'ssl'; 
    $mail->Host = 'smtp.gmail.com'; 
    $mail->Port = 465;

    // Detalhes do envio de E-mail
    $mail->Username = 'avalaiatoon@gmail.com'; 
    $mail->Password = "gjxisuecynbuzeaa";
    $mail->SetFrom('avalaiatoon@gmail.com', 'Avalaia');
    $mail->addAddress($email);
    $mail->Subject = $subject;
    $mail->msgHTML($message);

    if($mail->send()){
        echo "Usuário registrado com sucesso! Por favor, verifique seu e-mail para confirmar seu cadastro.";
    } else {
        echo "Erro ao enviar o e-mail.";
    }
} else {
    echo "Erro: " . $sql . "<br>" . $conn->error;
}

$conn->close();

?>
