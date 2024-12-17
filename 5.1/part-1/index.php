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
        $pagina = $_GET['pagina'];

        print_r($paginador->paginar("SELECT * FROM `usuarios`;", $pagina));
        // print_r($paginador->getPaginacion());

        $params = $paginador->getPaginacion();
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
        <?php for($i = 1; $i <= $params['total']; $i++): ?>
            <?php if($params['actual'] != $i): ?>
                <a href="?pagina=<?php echo $i; ?>"><?php echo $i; ?></a>
            <?php else: ?>
                <?php echo $i; ?>
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