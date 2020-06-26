<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/icofont.min.css">
    <link rel="stylesheet" href="assets/css/comum.css">
    <link rel="stylesheet" href="assets/css/template.css">
    <script src="https://unpkg.com/imask"></script>    
    <title>Inventário</title>
</head>
<body>
    <header class="header">
        <div class="logo">
            <i class="icofont-box"></i>
            <i class="icofont-login icofont-sm"></i>
            <span class="font-weight-medium mx-2">Inventário</span>
            <i class="icofont-exit icofont-sm"></i>
            <i class="icofont-files-stack"></i>
        </div>
        <div class="menu-toggle mx-3">
            <i class="icofont-navigation-menu icofont-md"></i>
        </div>
        <div class="spacer"></div>
        <div class="dropdown">
            <div class="dropdown-button">
                <i class="icofont-user icofont-md ml-3"></i>
                <span class="ml-2">
                    <?= $_SESSION['user']->rank ?> <?= $_SESSION['user']->name ?>
                </span>
                <i class="icofont-simple-down mx-2"></i>
            </div>
            <div class="dropdown-content">
                <ul class="nav-list">
                    <li class="nav-item">
                        <a href="#" data-toggle="modal" data-target="#change_password">
                            <i class="icofont-ui-password mr-2"></i>
                            Mudar Senha
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="logout.php">
                            <i class="icofont-logout mr-2"></i>
                            Sair
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </header>
    <div class="modal fade" id="change_password">
        <div class="modal-dialog modal-dialog-centered modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Mudar Senha</h5>
                    <button class="close" data-dismiss="modal"><span>&times;</span></button>
                </div>
                <div class="modal-body">...</div>
                <div class="modal-footer">
                    <button class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                    <button class="btn btn-primary">Salvar</button>
                </div>
            </div>
        </div>
    </div>