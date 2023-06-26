package br.cefetmg.paoc.negocio.dao;

import br.cefetmg.paoc.negocio.dto.Equipe;
import java.sql.SQLException;
import java.util.Properties;
import java.util.logging.Level;
import java.util.logging.Logger;
import javax.mail.Authenticator;
import javax.mail.Message;
import javax.mail.MessagingException;
import javax.mail.PasswordAuthentication;
import javax.mail.Session;
import javax.mail.Transport;
import javax.mail.internet.AddressException;
import javax.mail.internet.InternetAddress;
import javax.mail.internet.MimeBodyPart;
import javax.mail.internet.MimeMessage;

public class EmailDAO {

    public static void sendEmail(Equipe equipe) throws SQLException {
        try {
            System.out.println("Chegou no enviar email");
            Properties properties = new Properties();

            properties.put("mail.smtp.auth", "true");
            properties.put("mail.smtp.starttls.enable", "true");
            properties.put("mail.smtp.host", "smtp.gmail.com");
            properties.put("mail.smtp.port", "587");

            String myAccountEmail = "olimpiadasccefetmg@gmail.com";
            String password = "cyhuupuszhzoumln";

            Session session = Session.getInstance(properties, new Authenticator() {
                @Override
                protected PasswordAuthentication getPasswordAuthentication() {
                     System.out.println("Logando!");
                    return new PasswordAuthentication(myAccountEmail, password);
                    
                }
            });

            String nomeEquipe = equipe.getNome();

            String responsavel = equipe.getNome_responsavel();
            String emailResp = equipe.getEmail_responsavel();

            String capitao = equipe.getNome_capitao();
            String emailCap = equipe.getEmail_capitao();

            String integrante1 = equipe.getNome_int1();
            String emailInt1 = equipe.getEmail_int1();

            String integrante2 = equipe.getNome_int2();
            String emailInt2 = equipe.getEmail_int2();

            String integrante3 = equipe.getNome_int3();
            String emailInt3 = equipe.getEmail_int3();

            String integrante4 = equipe.getNome_int4();
            String emailInt4 = equipe.getEmail_int4();

            String integrante5 = equipe.getNome_int5();
            String emailInt5 = equipe.getEmail_int5();

            Message message1 = prepareMessage(session, myAccountEmail,emailInt1,  integrante1, nomeEquipe, capitao,  responsavel,  integrante1,  integrante2,  integrante3,  integrante4,  integrante5);
            Transport.send(message1);
            System.out.println("Mensagem enviada com sucesso!");
            Message message2 = prepareMessage(session, myAccountEmail,emailInt2,  integrante2, nomeEquipe, capitao,  responsavel,  integrante1,  integrante2,  integrante3,  integrante4,  integrante5);
            Transport.send(message2);
            System.out.println("Mensagem enviada com sucesso!");
            Message message3 = prepareMessage(session, myAccountEmail,emailInt3,  integrante3, nomeEquipe, capitao,  responsavel,  integrante1,  integrante2,  integrante3,  integrante4,  integrante5);
            Transport.send(message3);
            System.out.println("Mensagem enviada com sucesso!");
            Message message4 = prepareMessage(session, myAccountEmail,emailInt4,  integrante4, nomeEquipe, capitao,  responsavel,  integrante1,  integrante2,  integrante3,  integrante4,  integrante5);
            Transport.send(message4);
            System.out.println("Mensagem enviada com sucesso!");
            Message message5 = prepareMessage(session, myAccountEmail,emailInt5,  integrante5, nomeEquipe, capitao,  responsavel,  integrante1,  integrante2,  integrante3,  integrante4,  integrante5);
            Transport.send(message5);
            System.out.println("Mensagem enviada com sucesso!");
            Message message6 = prepareMessage(session, myAccountEmail,emailCap,  capitao, nomeEquipe, capitao,  responsavel,  integrante1,  integrante2,  integrante3,  integrante4,  integrante5);
            Transport.send(message6);
            System.out.println("Mensagem enviada com sucesso!");
            Message message7 = prepareMessage(session, myAccountEmail,emailResp,  responsavel, nomeEquipe, capitao,  responsavel,  integrante1,  integrante2,  integrante3,  integrante4,  integrante5);
            Transport.send(message7);
            System.out.println("Mensagem enviada com sucesso!");
        } catch (MessagingException ex) {
            Logger.getLogger(EmailDAO.class.getName()).log(Level.SEVERE, null, ex);
        }
    }

    private static Message prepareMessage(Session session, String myAccountEmail, String recepient, String nomeDest, String equipe, String capitao, String responsavel, String int1, String int2, String int3, String int4, String int5) throws MessagingException {
        try {
            Message message = new MimeMessage(session);
            message.setFrom(new InternetAddress(myAccountEmail));
            message.setRecipient(Message.RecipientType.TO, new InternetAddress(recepient));
            message.setSubject("Olímpiadas do Conhecimento | Equipe cadastrada!");
            MimeBodyPart htmlPart = new MimeBodyPart();
            message.setContent("<h1>Olá, <span>" + nomeDest + "</span>!</h1>   <p>Você acaba de ser inscrito na equipe <strong>" + equipe + "</strong>!</p>   <h3>Informações da equipe:</h3>   <ul>     <li><strong>Nome: </strong>" + equipe + "</li>     <li><strong>Capitão: </strong>" + capitao + ".</li>     <li><strong>Responsável: </strong>" + responsavel + "</li>     <li><strong>Integrantes: " + capitao + ", " + int1 +", " + int2 + ", " + int3 + ", " + int4 + ", " + int5 + "</strong>.</li>     <li><strong>Status: </strong>em análise.</li>   </ul>   <p>Caso você ache que esse e-mail foi enviado de forma equivocada ou você não autorizou a sua inscrição, por gentileza contate a coordenação da <strong>1ª Olímpiada do Conhecimento do CEFET-MG.</strong></p>", "text/html");
            return message;
        } catch (AddressException ex) {
            Logger.getLogger(EmailDAO.class.getName()).log(Level.SEVERE, null, ex);
        }
        return null;
    }
}
