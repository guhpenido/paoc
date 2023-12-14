<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    require_once '../vendor/autoload.php';

    // Dados do formulário
    $equipeDestinataria = $_POST['equipe_destinataria'];
    $remetente = $_POST['rem_email'];
    $assunto = $_POST['assunto_msg'];
    $corpoEmail = $_POST['questionText'];

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
    foreach($admins as $admin){
        if($admin->getNome() === $remetente){
            $emailRemetente = $admin->getEmail();
        }
    }
    foreach ($equipes as $equipe) :
        if($equipe->getNome() === $equipeDestinataria){
            $teamMembers = array(
                $equipe->getNomeCapitao() => $equipe->getEmailCapitao(),
                $equipe->getNomeInt1() => $equipe->getEmailInt1(),
                $equipe->getNomeInt2() => $equipe->getEmailInt2(),
                $equipe->getNomeInt3() => $equipe->getEmailInt3(),
                $equipe->getNomeInt4() => $equipe->getEmailInt4(),
                $equipe->getNomeInt5() => $equipe->getEmailInt5(),
                $equipe->getNomeResponsavel() => $equipe->getEmailResponsavel(),
            );
            foreach ($teamMembers as $name => $email) {
                sendEmailToMember($myAccountEmail, $email, $corpoEmail, $assunto, $emailRemetente);
            }
        }
    endforeach;

}

function sendEmailToMember($myAccountEmail, $recepient, $corpo, $assunto, $emailRemetente)
    {
        $subject = $assunto." | Olimpiadas do Conhecimento do CEFET-MG";
        $message = $corpo;

        // Create a new PHPMailer instance
        $mail = new PHPMailer(true);

        // Set up SMTP configuration
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com'; // Replace with your SMTP server
        $mail->SMTPAuth = true;
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
