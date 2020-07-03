<main class="content">
    <?php
        renderTitle(
            'Cadastro de Modelos',
            'Mantenha os dados dos modelos atualizados',
            'icofont-layers'
        );

        include(TEMPLATE_PATH . "/messages.php");
    ?>

    <div class="container" id="search">
        <div class="row justify-content-between">
            <div class="col-6">
                <a class="btn btn-lg btn-primary"
                    href="save_model_material.php">Novo Modelo</a>
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
                        <button class="btn btn-outline-secondary" type="button" onclick="insertFilterTermInUrl()" id="button-addon2">
                            Buscar
                        </button>
                    </div>
                </div>
            </div>    
        </div>
    </div>

    <table class="table table-bordered table-striped table-hover">
    <thead class="thead-light">
        <th class="text-center">Nº</th>
        <th>Tipo</th>
        <th>Modelo</th>
        <th>Ações</th>    
    </thead>
    <tbody>
    <?php if(count($modelsMaterials['models']) == 0): ?>
        <tr>
            <td colspan="5">Nenhum modelo cadastrado.</td>
        </tr>
    <?php endif; ?>
    <?php foreach($modelsMaterials['models'] as $model): ?>
        <tr>
        <td class="align-middle text-center"><?= $model->id; ?></td>
        <td class="align-middle"><?= $model->name_type ?></td>
        <td class="align-middle"><?= $model->name_model ?></td>
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
<?php if(empty($filter)): ?>
<nav aria-label="Navegação de página exemplo">
    <ul class="pagination justify-content-center">
        <li class="<?= $modelsMaterials['currentPage'] == 1 ? 'page-item disabled' : 'page-item'; ?>">
            <a class="page-link" href="?page=<?= $modelsMaterials['currentPage']-1; ?>">Anterior</a>
        </li>
        <?php for($q = 0; $q < $modelsMaterials['pageCount']; $q++): ?>
            <li class="<?= $modelsMaterials['currentPage'] == ($q+1) ? 'page-item active' : 'page-item'; ?>">
            <a class="page-link" href="?page=<?= $q+1; ?>"><?= $q+1; ?></a>
            </li>
        <?php endfor; ?>
        <li class="<?= $modelsMaterials['currentPage'] == $modelsMaterials['pageCount'] ? 'page-item disabled' : 'page-item' ?>">
            <a class="page-link" href="?page=<?= $modelsMaterials['currentPage']+1; ?>">Próximo</a>
        </li>
    </ul>
</nav>
<?php endif; ?>
</main>
<script>
    // Insere na url o termo de busca e faz o reload da página para o mesmo ser lido pelo controller
    function insertFilterTermInUrl(){
        var filterTerm = document.getElementById("filter").value;
        var html = 'models_materials.php?filter='+filterTerm;
        window.location.href = html;
    }    
</script>