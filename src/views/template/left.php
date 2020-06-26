<aside class="sidebar">
    <nav class="menu mt-3">
        <ul class="nav-list  flex-column">
            <li class="nav-item">
                <a href="home.php">
                    <i class="icofont-chart-flow-1 mr-2"></i>
                    Home
                </a>
            </li>
            <!-- <li class="nav-item">
                <a href="#">
                    <i class="icofont-ui-calendar mr-2"></i>
                    Relatório Mensal
                </a>
            </li> -->
            <!-- ?php if($user->is_admin): ?> -->
            <!-- <li class="nav-item">
                <a href="#">
                    <i class="icofont-chart-histogram mr-2"></i>
                    Criar Escala
                </a>
            </li>
            <li class="nav-item">
                <a href="#">
                    <i class="icofont-chart-histogram mr-2"></i>
                    Gerenciar Escala
                </a>
            </li> -->
            <li class="nav-item">
                <a href="users.php">
                    <i class="icofont-users mr-2"></i>
                    Usuários
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" data-target="#menuScales">
                    <i class="icofont-cube mr-2"></i>
                    Material
                    <i class="icofont-simple-down"></i>
                </a>
                <div class="collapse" id="menuScales">
                    <a class="dropdown-item" href="units.php?divisions=true&parts=true&scales=true">
                        <i class="icofont-ui-add"></i>
                        Criar Nova
                    </a>
                </div>
            </li>            
            <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" data-target="#menuUnits">
                    <i class="icofont-ui-home mr-2"></i>
                    Unidade
                    <i class="icofont-simple-down"></i>
                </a>
                <div class="collapse" id="menuUnits">
                    <a class="dropdown-item" href="units.php">
                        <i class="icofont-ui-home"></i>
                        Unidades
                    </a>
                    <a class="dropdown-item" href="units.php?divisions=true">
                        <i class="icofont-cube"></i>
                        Divisões
                    </a>
                    <a class="dropdown-item" href="units.php?divisions=true&parts=true">
                        <i class="icofont-cubes"></i>
                        Setores
                    </a>
                </div>
            </li>
            <!-- ?php endif ?> -->
        </ul>
    </nav>
</aside>