<?php
// Configuração do PHPMailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';

$mail = new PHPMailer;

$mail->isSMTP();
$mail->Host = 'smtp-relay.sendinblue.com'; // Ou outro servidor SMTP
$mail->SMTPAuth = '927frtHBaDTqn6mj';
$mail->Username = 'papptrl@gmail.com'; // Seu e-mail
$mail->Password = 'papptrl123'; // Sua senha
$mail->SMTPSecure = 'tls';
$mail->Port = 587;

// Conteúdo do e-mail
$mensagem = "Olá,\n\nClique no link a seguir para alterar sua senha:\n\n\nO link expira em 24 horas.\n\nAtenciosamente,\nSua equipe de suporte";

$mail->setFrom('papptrl@gmail.com', 'Array');
$mail->addAddress("jamajsjsi@gmail.com"); // Endereço de e-mail do utilizador
$mail->Subject = 'Alteração de senha';
$mail->Body = $mensagem;

// Envia o e-mail
if (!$mail->send()) {
    echo 'Erro ao enviar e-mail: ' . $mail->ErrorInfo;
} else {
    echo 'E-mail enviado com sucesso';
}
