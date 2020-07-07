<aside class="sidebar">
    <nav class="menu mt-3">
        <ul class="nav-list  flex-column">
            <li class="nav-item">
                <a href="home.php">
                <i class="icofont-dashboard-web mr-2"></i>
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
            <li class="nav-item">
                <a href="materials.php?page=1">
                    <i class="icofont-box mr-2"></i>
                    Materiais
                </a>
            </li>
            <li class="nav-item">
                <a href="reports.php">
                    <i class="icofont-chart-histogram mr-2"></i>
                    Relatórios
                </a>
            </li>  
            <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" data-target="#menuMaterials">
                    <i class="icofont-ui-settings mr-2"></i>
                    Configurações
                    <i class="icofont-simple-down"></i>
                </a>
                <div class="collapse" id="menuMaterials">
                    <a class="dropdown-item" href="types_materials.php">
                        <i class="icofont-file-psb"></i>
                        Tipo
                    </a>
                    <a class="dropdown-item" href="models_materials.php?page=1">
                        <i class="icofont-layers"></i>
                        Modelo
                    </a>
                    <a class="dropdown-item" href="manufacturers.php?page=1">
                        <i class="icofont-industries-5"></i>
                        Fabricante
                    </a>
                    <a class="dropdown-item" href="status.php">
                        <i class="icofont-dashboard"></i>
                        Status
                    </a>
                    <a class="dropdown-item" href="conditions.php">
                        <i class="icofont-star"></i>
                        Condição
                    </a>
                </div>
            </li>
            <li class="nav-item">
                <a href="users.php">
                    <i class="icofont-users mr-2"></i>
                    Usuários
                </a>
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
                        Seções
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