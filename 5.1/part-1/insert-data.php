<?php
    $activate = true;

    if ($activate) {
        // Conectar a la base de datos
        $conexion = Db::connect();

        // Consultar el ID máximo en la tabla usuarios
        $resultado = mysql_query("SELECT MAX(id) AS max_id FROM `usuarios`", $conexion);
        $fila = mysql_fetch_assoc($resultado);
        $max_id = $fila['max_id'];

        // Si max_id es null, significa que la tabla está vacía
        if ($max_id === null) {
            $max_id = 0; // Si no hay registros, comenzamos desde 0
        }

        // Calcular el límite para la inserción
        $limite = 55;

        // Comprobar si el ID máximo es menor que 55
        if ($max_id < $limite) {
            // Insertar desde el siguiente ID
            for ($i = $max_id + 1; $i <= $limite; $i++) {
                mysql_query("INSERT INTO `usuarios` VALUES(null, 'nombres-$i')", $conexion);
            }
        } else {
            echo "No se pueden insertar registros, el ID máximo es 55 o mayor.";
        }
    }
?>