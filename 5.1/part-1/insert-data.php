<?php
    $activate = false;

    if($activate) {
        for($i = 1; $i <= 55; $i++) {
            mysql_query("INSERT INTO `usuarios` VALUES(null, 'nombres-$i')", Db::connect());
        }
    }
?>