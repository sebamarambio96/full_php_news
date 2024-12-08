<?php

trait AuthToken
{
    // Método para encriptar el user_id
    public static function encrypt($data)
    {
        // Generar un IV aleatorio (vector de inicialización)
        $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length('aes-256-cbc'));

        // Encriptar el user_id con AES-256-CBC
        $encryptedData = openssl_encrypt(
            $data,
            'aes-256-cbc',
            $_ENV['SECRET_KEY'],
            0,
            $iv
        );

        // Devolver el IV y el dato encriptado en un solo string (separado por ":")
        return base64_encode($encryptedData . '::' . $iv);
    }

    // Método para desencriptar el user_id
    public static function decrypt($data)
    {
        // Separar el IV del dato encriptado
        list($encryptedData, $iv) = explode('::', base64_decode($data), 2);

        // Desencriptar el dato usando AES-256-CBC
        return openssl_decrypt(
            $encryptedData,
            'aes-256-cbc',
            $_ENV['SECRET_KEY'],
            0,
            $iv
        );
    }
}
