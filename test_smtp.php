<?php
/**
 * Script de PRUEBA SMTP — ELIMINAR en producción
 * Acceder vía: http://localhost/aecaum/test_smtp.php
 */
require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/app/Helpers/MailHelper.php';

// Cambia este correo por uno donde quieras recibir la prueba
$testTo = 'zvzgmzq@gmail.com';

echo '<h2>Prueba de SMTP — ACAEUM</h2>';
echo '<p><strong>Host:</strong> ' . SMTP_HOST . '</p>';
echo '<p><strong>Puerto:</strong> ' . SMTP_PORT . '</p>';
echo '<p><strong>Seguridad:</strong> ' . SMTP_SECURE . '</p>';
echo '<p><strong>Usuario:</strong> ' . SMTP_USER . '</p>';
echo '<p><strong>From:</strong> ' . MAIL_FROM . '</p>';
echo '<p><strong>Destinatario de prueba:</strong> ' . $testTo . '</p>';
echo '<hr>';

$result = \App\Helpers\MailHelper::sendMail(
    $testTo,
    '✅ Prueba SMTP — ACAEUM',
    '<h2>¡Funciona!</h2><p>El servidor SMTP está configurado correctamente.</p>'
);

if ($result) {
    echo '<p style="color:green;font-weight:bold;">✅ Correo enviado exitosamente a ' . $testTo . '</p>';
} else {
    echo '<p style="color:red;font-weight:bold;">❌ Error al enviar el correo.</p>';
    echo '<p><strong>Detalle del error:</strong><br><code>' 
        . htmlspecialchars(\App\Helpers\MailHelper::$lastError) 
        . '</code></p>';
    echo '<hr><h3>Posibles causas:</h3><ul>
        <li>La contraseña de aplicación de Gmail es incorrecta o expiró</li>
        <li>La cuenta Gmail no tiene verificación en 2 pasos activada</li>
        <li>El firewall/ISP bloquea el puerto 465 (prueba con 587/TLS)</li>
        <li>La extensión <code>php_openssl</code> está desactivada en php.ini</li>
    </ul>';
}
