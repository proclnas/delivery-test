<?php 
    $pagina = $_GET['page'] ?? 'home';
    $pageToInclude = 'home-partial.html';
    switch ($pagina) {
        case 'home':
            $pageToInclude = 'home-partial.html';
            break;
        case 'clientes':
            $pageToInclude = 'upload-partial.html';
            break;
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Delivery</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="css/main.css" rel="stylesheet" type="text/css" />
    </head>
    <body>
        <div class="container-fluid">
            <div class="row content">
                <div class="col-sm-3 sidenav">
                    <h4>Delivery</h4>
                    <ul class="nav nav-pills nav-stacked">
                        <li class="<?= $pagina == 'home' ? 'active' : ''; ?>">
                            <a href="/?page=home">HOME</a>
                        </li>
                        <li class="<?= $pagina == 'clientes' ? 'active' : ''; ?>">
                            <a href="/?page=clientes">UPLOAD CLIENTES</a>
                        </li>
                    </ul><br>
                    <hr>
                </div>

                <div class="col-sm-9">
                    <h4>
                        <small>Delivery Test - v1.0.0</small>
                    </h4>
                    <hr>
                    <div id="include-container">
                        <?= require $pageToInclude; ?>
                    </div>
                </div>
            </div>
        </div>

        <footer class="container-fluid">
            <p><?= (new DateTime)->format('Y'); ?></p>
        </footer>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert"></script>

    </body>
</html>
