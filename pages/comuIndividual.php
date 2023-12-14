<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    require_once '../vendor/autoload.php';

    // Dados do formulário
    $nomeDestinatario = $_POST['dest_nome'];
    $emailDestinatario = $_POST['dest_email'];
    $remetente = $_POST['remetente_ind'];
    $assunto = $_POST['assunto_email'];
    $corpoEmail = $_POST['questionTextInd'];

    // Buscar informações da equipe
    require_once '../services/Equipe.php';
    require_once '../services/Admin.php';
    require_once '../services/admDao.php';
    require_once '../services/negocioException.php';
    require_once '../services/servicoEquipes.php';

    $equipes = ServicoEquipes::listarEquipes();
    $myAccountEmail = 'olimpiadasccefetmg@gmail.com';
    $admins = admDAO::listarAdmBD();
    $emailRemetente = "";
    foreach ($admins as $admin) {
        if ($admin->getNome() === $remetente) {
            $emailRemetente = $admin->getEmail();
        }
    }

    sendEmailToMember($myAccountEmail, $nomeDestinatario, $emailDestinatario, $corpoEmail, $assunto, $emailRemetente);
}

function sendEmailToMember($myAccountEmail, $nome, $recepient, $corpo, $assunto, $emailRemetente)
{
    $subject = $assunto . " | Olimpiadas do Conhecimento do CEFET-MG";
    $message = $corpo;

    // Create a new PHPMailer instance
    $mail = new PHPMailer(true);
    $mail->CharSet = 'UTF-8';
    $mail->Encoding = 'base64';
    // Set up SMTP configuration
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com'; // Replace with your SMTP server
    $mail->SMTPAuth = true;
    $mail->Body = '<html><head><meta charset="UTF-8"></head><body>' . $message . '</body></html>';
    $mail->Username = $myAccountEmail; // Replace with your SMTP username
    $mail->Password = 'cyhuupuszhzoumln'; // Replace with your SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;

    // Set up email headers and content
    $mail->setFrom($myAccountEmail);
    $mail->addAddress($recepient);
    $mail->addCC($emailRemetente);
    $mail->Subject = $subject;
    $mail->Body = $message;
    $mail->isHTML(true);

    try {
        $mail->send();

        header("Location: comunicacao.php");
        echo "<script>alert('Mensagens enviadas a todos os membros da equipe!')</script>";
    } catch (Exception $ex) {
        throw new negocioException("Falha ao enviar o e-mail para $recepient. Erro: " . $mail->ErrorInfo);
    }
}
