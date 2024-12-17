<?php
    class Paginador {
        private array $_datos;
        private array $_paginacion;

        public function __construct() {
            $this->_datos = [];
            $this->_paginacion = [];
        }

        public function paginar(string $query, int $pagina = 1, int $limite = 10): array {
            // Asegúrate de que $pagina sea un entero.
            $pagina = $pagina ?? 1; // Asignar 1 si es null.
        
            // Validar el límite
            if ($limite <= 0) {
                $limite = 10; // Valor por defecto.
            }
        
            // Calcular el inicio de la consulta.
            $inicio = ($pagina > 1) ? ($pagina - 1) * $limite : 0;
        
            // Conectar a la base de datos.
            $conexion = Db::connect();
        
            // Obtener el total de registros.
            $consulta = $conexion->query($query);
            $registros = $consulta->num_rows;
            $total = ceil($registros / $limite);
        
            // Modificar la consulta para incluir el límite.
            $query .= " LIMIT $inicio, $limite;";
            $consulta = $conexion->query($query);
        
            // Recoger los datos.
            while ($regs = $consulta->fetch_assoc()) {
                $this->_datos[] = $regs;
            }
        
            // Configurar la paginación.
            $this->_paginacion = [
                'actual' => $pagina,
                'total' => $total,
                'primero' => ($pagina > 1) ? 1 : '',
                'anterior' => ($pagina > 1) ? $pagina - 1 : '',
                'ultimo' => ($pagina < $total) ? $total : '',
                'siguiente' => ($pagina < $total) ? $pagina + 1 : ''
            ];
        
            return $this->_datos;
        }

        public function getPaginacion(): array|false {
            return $this->_paginacion ?: false;
        }
    }
?>