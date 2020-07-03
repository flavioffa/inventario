<main class="content">
    <?php
        renderTitle(
            'Cadastro de Material Carga',
            'Mantenha os dados dos materiais atualizados',
            'icofont-box mr-2'
        );

        include(TEMPLATE_PATH . "/messages.php");
    ?>

    <!-- <div class="container" id="search"> -->
        <div class="row justify-content-between">
            <div class="col-6">
                <a class="btn btn-lg btn-primary"
                    href="save_material.php">Incluir na carga</a>
            </div>
            <div class="col-6 mt-2">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroup-sizing-sm">
                        <i class="icofont-search-2" onclick="typeFilter('global')"></i>
                        </span>
                    </div>
                    <input type="text" class="form-control" name="global" id="filter" value="<?= $filter ?>"
                        placeholder="Pesquisa Geral" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
                    <div class="input-group-append">
                        <button type="button" class="btn btn-outline-secondary" onclick="insertFilterTermInUrl()">Buscar</button>
                        <button type="button" class="btn btn-outline-secondary dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="sr-only">Toggle Dropdown</span>
                        </button>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" id="number_unit" href="javascript:typeFilter('number_unit')">Etiq. CIMAER</a>
                            <a class="dropdown-item" id="number_metallic" href="javascript:typeFilter('number_metallic')">Etiq. Metálica</a>
                            <a class="dropdown-item" id="number_bmp" href="javascript:typeFilter('number_bmp')">Nº BMP</a>
                            <div role="separator" class="dropdown-divider"></div>
                            <a class="dropdown-item" id="room" href="javascript:typeFilter('room')">Sala</a>
                            <div role="separator" class="dropdown-divider"></div>
                            <a class="dropdown-item" id="global" href="javascript:typeFilter('global')">Geral</a>
                        </div>
                    </div>
                </div>
            </div>    
        </div>
    <!-- </div> -->

    <table class="table table-bordered table-hover table-sm">
        <thead class="thead-light">
            <tr>
                <th class="text-center align-middle" rowspan="2">Etiqueta CIMAER</th>
                <th class="text-center align-middle" rowspan="2">Etiqueta Metálica</th>
                <th class="text-center align-middle" rowspan="2">Nº Patrimônio (BMP)</th>
                <th class="text-center align-middle" rowspan="2">Tipo</th>
                <th class="text-center align-middle" rowspan="2">Modelo</th>
                <th class="text-center align-middle" rowspan="2">Fabricante</th>
                <th class="text-center align-middle" rowspan="2">Nº de série</th>
                <th class="text-center align-middle" rowspan="2">Origem</th>
                <th class="text-center align-middle" colspan="3">Localização</th>
                <th class="text-center align-middle" rowspan="2">Status da Carga</th>
                <th class="text-center align-middle" rowspan="2">Condição</th>
                <th class="text-center align-middle" rowspan="2">GMM/Cautela</th>
                <th class="text-center align-middle" rowspan="2">Observação</th>
                <th class="text-center align-middle" rowspan="2">Ações</th> 
            </tr>
            <tr>
                <th class="text-center align-middle">Seção</th>
                <th class="text-center align-middle">Setor</th>
                <th class="text-center align-middle">Sala</th>
            </tr>   
        </thead>
        <tbody>
    <?php if(count($materials['materials']) == 0): ?>
        <tr>
            <td colspan="16">Nenhum material cadastrado.</td>
        </tr>
    <?php endif; ?>
    <?php foreach($materials['materials'] as $material): ?>
        <tr class="<?= $material->color_status == 'white' ? '' : ($material->color_status == 'dark' ? 'bg-secondary text-white' : "table-{$material->color_status}"); ?> <?= $material->color_condition == 'dark' ? '' : "text-{$material->color_condition}"; ?>
        ">
            <td class="align-middle text-center"><?= $material->number_unit; ?></td>
            <td class="align-middle"><?= $material->number_metallic ?></td>
            <td class="align-middle"><?= $material->number_bmp ?></td>
            <td class="align-middle"><?= $material->name_type ?></td>
            <td class="align-middle"><?= $material->name_model ?></td>
            <td class="align-middle"><?= $material->name_manufacturer ?></td>
            <td class="align-middle"><?= $material->number_serial ?></td>
            <td class="align-middle"><?= $material->origin ?></td>
            <td class="align-middle"><?= $material->initials_division ?></td>
            <td class="align-middle"><?= $material->name_part ?></td>
            <td class="align-middle"><?= $material->room ?></td>
            <td class="align-middle"><?= $material->name_status ?></td>
            <td class="align-middle"><?= $material->name_condition ?></td>
            <td class="align-middle"><?= $material->gmm_cautela ?></td>
            <td class="align-middle"><?= $material->obs ?></td>
            <td class="align-middle">
                <a href="save_material.php?update=<?= $material->id ?>" 
                    class="btn btn-warning rounded-circle btn-sm mr-2">
                    <i class="icofont-edit"></i>
                </a>
                <a href="?delete=<?= $material->id ?>"
                    class="btn btn-danger rounded-circle btn-sm"
                    onclick="return confirm('Tem certeza que deseja excluir?')">
                    <i class="icofont-trash"></i>
                </a>
                <!-- <a href="qrcode.php?create=<?= $material->id ?>" 
                    class="btn btn-warning rounded-circle btn-sm mr-2">
                    <i class="icofont-qr-code"></i>
                </a> -->
            </td>
        </tr>
    <?php endforeach?>
    </tbody>
</table>
<?php if(empty($filter)): ?>
<nav aria-label="Navegação de página exemplo">
    <ul class="pagination justify-content-center">
        <li class="<?= $materials['currentPage'] == 1 ? 'page-item disabled' : 'page-item'; ?>">
            <a class="page-link" href="?page=<?= $materials['currentPage']-1; ?>">Anterior</a>
        </li>
        <?php for($q = 0; $q < $materials['pageCount']; $q++): ?>
            <li class="<?= $materials['currentPage'] == ($q+1) ? 'page-item active' : 'page-item'; ?>">
            <a class="page-link" href="?page=<?= $q+1; ?>"><?= $q+1; ?></a>
            </li>
        <?php endfor; ?>
        <li class="<?= $materials['currentPage'] == $materials['pageCount'] ? 'page-item disabled' : 'page-item' ?>">
            <a class="page-link" href="?page=<?= $materials['currentPage']+1; ?>">Próximo</a>
        </li>
    </ul>
</nav>
<?php endif; ?>
</main>
<script>
    // Insere na url o termo de busca e faz o reload da página para o mesmo ser lido pelo controller
    function insertFilterTermInUrl(){
        var filterTerm = document.getElementById("filter").value;
        var typeFilter = document.getElementById("filter").name;
        var html = 'materials.php?filter='+filterTerm+'&type='+typeFilter;
        window.location.href = html;
    }

    function typeFilter(name) {
        document.getElementById("filter").name = name;
        switch (name) {
            case 'number_unit':
                var message = 'Pesquisar etiqueta da unidade';
                break;
            case 'number_bmp':
                var message = 'Pesquisar nº patrimônio BMP';
                break;
            case 'number_metallic':
                var message = 'Pesquisar etiqueta metálica';
                break;
            case 'room':
                var message = 'Pesquisar pela sala';
                break;
            default:
                var message = 'Pesquisa geral';
        }
        document.getElementById("filter").placeholder = message;
    }    
</script>