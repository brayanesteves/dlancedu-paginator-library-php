<?php
    $activate = true;

    if ($activate) {
        // Conectar a la base de datos
        $conexion = Db::connect();

        // Consultar el ID máximo en la tabla usuarios
        $resultado = $conexion->query("SELECT MAX(id) AS max_id FROM `usuarios`");
        $fila = $resultado->fetch_assoc();
        $max_id = $fila['max_id'] ?? 0; // Si no hay registros, comenzamos desde 0

        // Limitar hasta el ID 55
        $limite = 55;

        // Verificar si podemos insertar
        if ($max_id < $limite) {
            // Preparar la consulta
            $stmt = $conexion->prepare("INSERT INTO `usuarios` VALUES (null, ?)");
            if ($stmt === false) {
                die('Error en la preparación de la consulta: ' . $conexion->error);
            }

            // Insertar desde el siguiente ID
            for ($i = $max_id + 1; $i <= $limite; $i++) {
                $nombre = "nombres-$i";
                $stmt->bind_param("s", $nombre);
                $stmt->execute();
            }

            $stmt->close();
        }
    }
?>