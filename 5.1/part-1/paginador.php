<?php
    class Paginador {
        private $_datos;
        private $_paginacion;

        public function __construct() {
            $this->_datos      = array();
            $this->_paginacion = array();
        }

        public function paginar($query, $pagina = false, $limite = false) {
            if($limite && is_numeric($limite)) {
                $limite = $limite;
            } else {
                $limite = 10;
            }

            if($pagina && is_numeric($pagina)) {
                $pagina = $pagina;
                $inicio = ($pagina - 1) * $limite;
            } else {
                $pagina = 1;
                $inicio = 0;
            }

            $consulta  = mysql_query($query, Db::connect());
            $registros = mysql_num_rows($consulta);
            $total     = ceil($registros / $limite);

            $query     = $query . " LIMIT $inicio, $limite;";
            $consulta  = mysql_query($query, Db::connect());

            while($regs = mysql_fetch_assoc($consulta)) {
                $this->_datos[] = $regs;
            }

            $paginacion = array();

            $paginacion['actual'] = $pagina;
            $paginacion['total']  = $total;

            if($pagina > 1) {
                $paginacion['primero']  = 1;
                $paginacion['anterior'] = $pagina - 1;
            } else {
                $paginacion['primero']  = '';
                $paginacion['anterior'] = '';
            }

            if($pagina < $total) {
                $paginacion['ultimo']    = $total;
                $paginacion['siguiente'] = $pagina + 1;
            } else {
                $paginacion['ultimo']    = '';
                $paginacion['siguiente'] = '';
            }

            $this->_paginacion = $paginacion;

            return $this->_datos;
        }

        public function getPaginacion() {
            if($this->_paginacion) {
                return $this->_paginacion;
            } else {
                return false;
            }
        }
    }
?>