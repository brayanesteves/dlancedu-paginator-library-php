<?php
    class Db {
        public static function connect() {
            $link = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

            if ($link->connect_error) {
                die('Error al conectar con el servidor: ' . $link->connect_error);
            }

            return $link;
        }
    }
?>