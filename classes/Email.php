<?php  

namespace Classes;

use PHPMailer\PHPMailer\PHPMailer;

class Email {

    public $email;
    public $nombre;
    public $token;
    public function __construct($email, $nombre, $token){
        $this->email = $email;
        $this->nombre = $nombre;
        $this->token = $token;
    }

    public function sendConfirmation(){
        // create email object
        $mail = new PHPMailer();

        // Config SMTP
        $mail->isSMTP();
        $mail->Host = 'sandbox.smtp.mailtrap.io';
        $mail->SMTPAuth = true;
        $mail->Port = 2525;
        $mail->Username = 'db83d6cd72d216';
        $mail->Password = '008a6098da2dd2';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // o 'tls'

        $mail->setFrom('test@demomailtrap.co', 'BarberStore');
        $mail->addAddress('a21110132@ceti.mx', 'RealState.com');
        $mail->Subject = 'Confirma tu cuenta';

        $mail->isHTML(true);
        $mail->CharSet = 'UTF-8';

        // Define content
        $content = '<html>';
        $content .= '<p><strong>Hola '. $this->nombre .'</strong> Has creado tu cuenta en BarberS. Confirma tu cuenta dando click en el siguiente enlace</p>';
        $content .= "<p>Presiona aqui: <a href='http://localhost:3000/confirm-account?token=" . $this->token . "'>Confirma tu cuenta </a></p>"; 
        $content .= "<p>Si tu no solicitaste esta cuenta, ignora el mensaje.</p>";
        $content .= "</html>";

        $mail->Body = $content;

        // send email
        $mail->send();
    }

    public function sendInstructions(){
        // create email object
        $mail = new PHPMailer();

        // Config SMTP
        $mail->isSMTP();
        $mail->Host = 'sandbox.smtp.mailtrap.io';
        $mail->SMTPAuth = true;
        $mail->Port = 2525;
        $mail->Username = 'db83d6cd72d216';
        $mail->Password = '008a6098da2dd2';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // o 'tls'

        $mail->setFrom('test@demomailtrap.co', 'BarberStore');
        $mail->addAddress('a21110132@ceti.mx', 'RealState.com');
        $mail->Subject = 'Reestablece tu password.';

        $mail->isHTML(true);
        $mail->CharSet = 'UTF-8';

        // Define content
        $content = '<html>';
        $content .= '<p><strong>Hola '. $this->nombre .'</strong>Has solicitado reestablecer tu contraseña. Da click en el siguiente enlace para hacerlo</p>';
        $content .= "<p>Presiona aqui: <a href='http://localhost:3000/recover?token=" . $this->token . "'>Reestablece tu Password.</a></p>"; 
        $content .= "<p>Si tu no solicitaste esta cuenta, ignora el mensaje.</p>";
        $content .= "</html>";

        $mail->Body = $content;

        // send email
        $mail->send();
    }
}