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
        $mail->Host = 'live.smtp.mailtrap.io';
        $mail->SMTPAuth = true;
        $mail->Port = 2525;
        $mail->Username = 'smtp@mailtrap.io';
        $mail->Password = '152712f750cf53a0bf7fc9987b132f67';
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
}