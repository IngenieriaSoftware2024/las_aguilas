<?php 

namespace Controllers;

use Exception;
use phpseclib3\Net\SFTP;

class FtpController{
    public static function Conexion() {
        try {
            $sftp = new SFTP($_ENV['FILE_SERVER'], (int)$_ENV['FILE_PORT']);

            if ($sftp->login($_ENV['FILE_USER'], $_ENV['FILE_PASSWORD'])) {
                echo "Conexión Exitosa con FTP local";
            } else {
                echo "No se logró establecer una conexión con FTP local: Error de autenticación.";
            }

        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
}

