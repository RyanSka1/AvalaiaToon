<?php
    session_start(); // Inicia a sessão

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
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

    // Substitua 'user@example.com' pelo e-mail do usuário.
    $userEmail = $_SESSION['user_email']; // Usa o e-mail armazenado na sessão
    $mail->addAddress($userEmail);

    $mail->Subject = "Validar Email AvalaiaToon";

    // Mensagem
    $mensagem = "<h1> Token </h1>";
    $mensagem .= "<h3> 123456 </h3>";

    $mail->msgHTML($mensagem);
    $mail->send();
?>
