<?php
    $activate = false;

    if ($activate) {

        $conexion = Db::connect();

        $stmt = $conexion->prepare("INSERT INTO `usuarios` VALUES (null, ?)");

        if ($stmt === false) {
            die('Error en la preparación de la consulta: ' . $conexion->error);
        }

        // Bucle para insertar los datos
        for ($i = 1; $i <= 55; $i++) {
            $nombre = "nombres-$i";
            $stmt->bind_param("s", $nombre);
            $stmt->execute();
        }

        $stmt->close();
    }
?>