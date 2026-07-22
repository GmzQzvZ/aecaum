<?php
require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/app/Helpers/MailHelper.php';

echo 'SMTP_HOST: ' . SMTP_HOST . PHP_EOL;
echo 'SMTP_USER: ' . SMTP_USER . PHP_EOL;
echo 'SMTP_PORT: ' . SMTP_PORT . PHP_EOL;
echo 'SMTP_SECURE: ' . SMTP_SECURE . PHP_EOL;
echo 'MAIL_FROM: ' . MAIL_FROM . PHP_EOL;
echo PHP_EOL . 'Enviando correo de prueba...' . PHP_EOL;

$result = \App\Helpers\MailHelper::sendMail(
    SMTP_USER,
    'Prueba SMTP ACAEUM',
    '<h2>Prueba</h2><p>SMTP funciona correctamente.</p>'
);

if ($result) {
    echo 'OK - Correo enviado correctamente.' . PHP_EOL;
} else {
    echo 'ERROR: ' . \App\Helpers\MailHelper::$lastError . PHP_EOL;
}
