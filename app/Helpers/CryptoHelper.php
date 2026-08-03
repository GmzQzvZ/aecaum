<?php
namespace App\Helpers;

class CryptoHelper {

    private static function getKey(): string {
        $secret = $_ENV['JWT_SECRET'] ?? 'default_fallback_secret_key_123';
        // Hacemos hash para asegurar 32 bytes para AES-256
        return hash('sha256', $secret, true);
    }

    public static function encrypt(string $data): string {
        $method = 'aes-256-cbc';
        $ivLength = openssl_cipher_iv_length($method);
        $iv = openssl_random_pseudo_bytes($ivLength);
        
        $encrypted = openssl_encrypt($data, $method, self::getKey(), OPENSSL_RAW_DATA, $iv);
        
        // Retornamos IV + Data encriptada, codificado en base64 con un prefijo
        return 'ENC:' . base64_encode($iv . $encrypted);
    }

    public static function decrypt(string $data): string {
        // Verificar si está encriptado con nuestro prefijo
        if (strpos($data, 'ENC:') !== 0) {
            return $data; // Retorna original si no está encriptado
        }

        $method = 'aes-256-cbc';
        $ivLength = openssl_cipher_iv_length($method);
        
        $decoded = base64_decode(substr($data, 4));
        if ($decoded === false) return $data; // Si falla el decode, retorna original

        $iv = substr($decoded, 0, $ivLength);
        $encrypted = substr($decoded, $ivLength);
        
        $decrypted = openssl_decrypt($encrypted, $method, self::getKey(), OPENSSL_RAW_DATA, $iv);
        
        return $decrypted !== false ? $decrypted : $data;
    }
}
