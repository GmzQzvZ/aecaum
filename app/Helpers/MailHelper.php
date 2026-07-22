<?php
namespace App\Helpers;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class MailHelper {

    /** Guarda el último error para diagnóstico */
    public static $lastError = '';

    /**
     * Envía un correo electrónico usando PHPMailer
     *
     * @param string $to      Correo del destinatario
     * @param string $subject Asunto del correo
     * @param string $body    Cuerpo del correo (HTML)
     * @return bool True si se envió correctamente, False en caso contrario
     */
    public static function sendMail($to, $subject, $body) {
        $mail = new PHPMailer(true);

        try {
            // Nivel de debug: 0=ninguno, 2=servidor (solo en desarrollo)
            $mail->SMTPDebug  = 0;
            $mail->Debugoutput = function($str, $level) {
                error_log("PHPMailer [$level]: $str");
            };

            // Configuración del servidor SMTP
            $mail->isSMTP();
            $mail->Host       = \SMTP_HOST;
            $mail->SMTPAuth   = true;
            $mail->Username   = \SMTP_USER;
            $mail->Password   = \SMTP_PASS;
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; // 'ssl' para puerto 465
            $mail->Port       = \SMTP_PORT;

            // Tiempo de espera (segundos)
            $mail->Timeout    = 30;

            // Remitente — debe ser la misma cuenta Gmail autenticada
            $mail->setFrom(\MAIL_FROM, \MAIL_FROM_NAME);
            $mail->addAddress($to);

            // Contenido
            $mail->isHTML(true);
            $mail->Subject = $subject;
            $mail->Body    = $body;
            $mail->AltBody = strip_tags($body); // versión texto plano como fallback
            $mail->CharSet = 'UTF-8';

            $mail->send();
            self::$lastError = '';
            return true;

        } catch (Exception $e) {
            self::$lastError = $mail->ErrorInfo;
            error_log("MailHelper — Error al enviar correo a [{$to}]: " . $mail->ErrorInfo);
            return false;
        }
    }
}

