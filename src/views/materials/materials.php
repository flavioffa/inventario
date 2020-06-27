<main class="content">
    <?php
        renderTitle(
            'Cadastro de Material Carga',
            'Mantenha os dados dos materiais atualizados',
            'icofont-box mr-2'
        );

        include(TEMPLATE_PATH . "/messages.php");
    ?>

    <div class="container" id="search">
        <div class="row justify-content-between">
            <div class="col-6">
                <a class="btn btn-lg btn-primary"
                    href="save_material.php">Incluir na carga</a>
            </div>
            <div class="col-6 mt-2">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroup-sizing-sm">
                        <i class="icofont-search-2"></i>
                        </span>
                    </div>
                    <input type="text" class="form-control" name="filter" id="filter" value="<?= $filter ?>"
                        placeholder="Pesquisar" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
                        <div class="input-group-append">
                    <button class="btn btn-outline-secondary" type="button" 
                        onclick="insertFilterTermInUrl()" id="button-addon2">
                    Buscar</button>
                </div>
                </div>
            </div>    
        </div>
    </div>

    <table class="table table-bordered table-striped table-hover">
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
                <th class="text-center align-middle" rowspan="2">Status</th>
                <th class="text-center align-middle" rowspan="2">GMM/Cautela</th>
                <th class="text-center align-middle" rowspan="2">Observação</th>
                <th class="text-center align-middle" rowspan="2">Ações</th> 
            </tr>
            <tr>
                <th class="text-center">Divisão</th>
                <th class="text-center">Setor</th>
                <th class="text-center">Sala</th>
            </tr>   
        </thead>
        <tbody>
    <?php if(count($materials) == 0): ?>
        <tr>
            <td colspan="15">Nenhum material cadastrado.</td>
        </tr>
    <?php endif; ?>
    <?php foreach($materials['materials'] as $material): ?>
        <tr>
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
        <td class="align-middle"><?= $material->gmm_cautela ?></td>
        <td class="align-middle"><?= $material->obs ?></td>
        <td class="align-middle">
            <a href="save_model_material.php?update=<?= $model->id ?>" 
                class="btn btn-warning rounded-circle btn-sm mr-2">
                <i class="icofont-edit"></i>
            </a>
            <a href="?delete=<?= $model->id ?>"
                class="btn btn-danger rounded-circle btn-sm"
                onclick="return confirm('Tem certeza que deseja excluir?')">
                <i class="icofont-trash"></i>
            </a>
        </td>
        </tr>
    <?php endforeach?>
    </tbody>
</table>
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
</main>
<script>
    // Insere na url o termo de busca e faz o reload da página para o mesmo ser lido pelo controller
    function insertFilterTermInUrl(){
        var filterTerm = document.getElementById("filter").value;
        var html = 'materials.php?page=1&filter='+filterTerm;
        window.location.href = html;
    }    
</script>