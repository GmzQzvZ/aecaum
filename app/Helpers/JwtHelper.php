<?php
namespace App\Helpers;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Exception;

class JwtHelper {
    
    /**
     * Genera un token JWT
     * 
     * @param array $payload Datos a incluir en el token
     * @param int $expiryTime Tiempo de expiración en segundos (por defecto 1 hora)
     * @return string Token JWT
     */
    public static function generateToken($payload, $expiryTime = 3600) {
        $issuedAt = time();
        $expire = $issuedAt + $expiryTime;

        $data = array_merge([
            'iat'  => $issuedAt,
            'exp'  => $expire,
        ], $payload);

        return JWT::encode($data, \JWT_SECRET, 'HS256');
    }

    /**
     * Verifica y decodifica un token JWT
     * 
     * @param string $token
     * @return array|null Devuelve el payload si es válido, o null si es inválido/expirado
     */
    public static function verifyToken($token) {
        try {
            return (array) JWT::decode($token, new Key(\JWT_SECRET, 'HS256'));
        } catch (Exception $e) {
            // Token inválido o expirado
            return null;
        }
    }
}
