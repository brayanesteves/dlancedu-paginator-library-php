<?php
    require_once 'config.php';
    require_once 'db.php';
    require_once 'paginador.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DLancedu - Paginator</title>
</head>
<body>
    <!--<pre><?php //print_r(get_required_files()); ?></pre>-->
    <pre>
    <?php
        $paginador = new Paginador();

        // Verificar si $_GET['pagina'] está definido y es un número
        $pagina = isset($_GET['pagina']) && is_numeric($_GET['pagina']) ? (int)$_GET['pagina'] : 1;

        print_r($paginador->paginar("SELECT * FROM `usuarios`", $pagina));
        // print_r($paginador->getPaginacion());

        $params = $paginador->getRangoPaginacion();
    ?>
    </pre>

    <ul>
        <li style="display:inline; margin-right:5px;">
        <?php if($params['primero']): ?>
            <a href="?pagina=<?php echo $params['primero']; ?>">Primero</a>
        <?php else: ?>
            Primero
        <?php endif; ?>
        </li>

        <li style="display:inline; margin-right:5px;">
        <?php if($params['anterior']): ?>
            <a href="?pagina=<?php echo $params['anterior']; ?>">Anterior</a>
        <?php else: ?>
            Anterior
        <?php endif; ?>
        </li>

        <li style="display:inline; margin-right:5px;">
        <?php for($i = 0; $i <= count($params['rango']); $i++): ?>
            <?php if($params['actual'] != $params['rango'][$i]): ?>
                <a href="?pagina=<?php echo $params['rango'][$i]; ?>"><?php echo $params['rango'][$i]; ?></a>
            <?php else: ?>
                <?php echo $params['rango'][$i]; ?>
            <?php endif; ?>
        <?php endfor; ?>
        </li>

        <li style="display:inline; margin-right:5px;">
        <?php if($params['siguiente']): ?>
            <a href="?pagina=<?php echo $params['siguiente']; ?>">Siguiente</a>
        <?php else: ?>
            Siguiente
        <?php endif; ?>
        </li>

        <li style="display:inline; margin-right:5px;">
        <?php if($params['ultimo']): ?>
            <a href="?pagina=<?php echo $params['ultimo']; ?>">Último</a>
        <?php else: ?>
            Último
        <?php endif; ?>
        </li>
    </ul>
</body>
</html>