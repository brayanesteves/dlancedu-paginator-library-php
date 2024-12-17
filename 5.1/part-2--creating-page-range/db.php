<?php
    class Db {
        public static function connect() {
            if(!$link = mysql_connect(DB_HOST, DB_USER, DB_PASS)) {
                die('Error al conectar con el servidor');
            }

            if(!mysql_select_db_db(DB_NAME)) {
                die('Error al seleccionar la base de datos.');
            }

            return $link;
        }
    }
?>