<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
require '../vendor/autoload.php';

class EmailDAO
{

    public static function sendEmail($equipe)
    {
        try {
            echo "Chegou no enviar email\n";

            $myAccountEmail = 'olimpiadasccefetmg@gmail.com';

            // Array containing team members' names and emails
            $teamMembers = array(
                $equipe->getNomeCapitao() => $equipe->getEmailCapitao(),
                $equipe->getNomeInt1() => $equipe->getEmailInt1(),
                $equipe->getNomeInt2() => $equipe->getEmailInt2(),
                $equipe->getNomeInt3() => $equipe->getEmailInt3(),
                $equipe->getNomeInt4() => $equipe->getEmailInt4(),
                $equipe->getNomeInt5() => $equipe->getEmailInt5(),
            );

            foreach ($teamMembers as $name => $email) {
                self::sendEmailToMember($myAccountEmail, $email, $name, $equipe);
            }
        } catch (Exception $ex) {
            throw new negocioException("Não foi possível enviar o e-mail: " . $ex->getMessage());
        }
    }

    private static function sendEmailToMember($myAccountEmail, $recepient, $nomeDest, $equipe)
    {
        $subject = "Olimpíadas do Conhecimento | Equipe cadastrada!";
        $message = "<h1>Olá, <span>$nomeDest</span>!</h1>"
            . "<p>Você acaba de ser inscrito na equipe <strong>{$equipe->getNome()}</strong>!</p>"
            . "<h3>Informações da equipe:</h3>"
            . "<ul>"
            . "<li><strong>Nome: </strong>{$equipe->getNome()}</li>"
            . "<li><strong>Capitão: </strong>{$equipe->getNomeCapitao()}.</li>"
            . "<li><strong>Responsável: </strong>{$equipe->getNomeResponsavel()}</li>"
            . "<li><strong>Integrantes: {$equipe->getNomeCapitao()}, {$equipe->getNomeInt1()}, {$equipe->getNomeInt2()}, {$equipe->getNomeInt3()}, {$equipe->getNomeInt4()}, {$equipe->getNomeInt5()}</strong>.</li>"
            . "<li><strong>Status: </strong>em análise.</li>"
            . "</ul>"
            . "<p>Caso você ache que esse e-mail foi enviado de forma equivocada ou você não autorizou a sua inscrição, por gentileza contate a coordenação da <strong>1ª Olímpiada do Conhecimento do CEFET-MG.</strong></p>";

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
        $mail->Subject = $subject;
        $mail->Body = $message;
        $mail->isHTML(true);

        try {
            $mail->send();
            echo "Mensagem enviada para $nomeDest com sucesso!\n";
        } catch (Exception $ex) {
            throw new negocioException("Falha ao enviar o e-mail para $nomeDest. Erro: " . $mail->ErrorInfo);
        }
    }
}
