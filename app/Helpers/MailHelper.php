<?php
namespace App\Helpers;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class MailHelper {
    
    /**
     * Envía un correo electrónico usando PHPMailer
     * 
     * @param string $to Correo del destinatario
     * @param string $subject Asunto del correo
     * @param string $body Cuerpo del correo (HTML)
     * @return bool True si se envió correctamente, False en caso contrario
     */
    public static function sendMail($to, $subject, $body) {
        $mail = new PHPMailer(true);

        try {
            // Configuración del servidor
            $mail->isSMTP();
            $mail->Host       = \SMTP_HOST;
            $mail->SMTPAuth   = true;
            $mail->Username   = \SMTP_USER;
            $mail->Password   = \SMTP_PASS;
            $mail->SMTPSecure = \SMTP_SECURE;
            $mail->Port       = \SMTP_PORT;

            // Remitente y destinatario
            $mail->setFrom(\MAIL_FROM, \MAIL_FROM_NAME);
            $mail->addAddress($to);

            // Contenido
            $mail->isHTML(true);
            $mail->Subject = $subject;
            $mail->Body    = $body;
            $mail->CharSet = 'UTF-8';

            $mail->send();
            return true;
        } catch (Exception $e) {
            error_log("Error al enviar correo: {$mail->ErrorInfo}");
            return false;
        }
    }
}
