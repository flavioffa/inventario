<main class="content">
    <?php
        renderTitle(
            'Seções',
            $msgTitle,
            'icofont-cube'
        );

        include(TEMPLATE_PATH . "/messages.php");
    ?>

    <?php if(!$parts): ?>
    <div class="container" id="search">
        <div class="row justify-content-between">
            <div class="col-6">
                <a class="btn btn-lg btn-primary"
                    href="save_division.php?unit=<?= $unit->id ?>">Nova Seção</a>
            </div>
            <div class="col-6 mt-2">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroup-sizing-sm">
                        <i class="icofont-search-2"></i>
                        </span>
                    </div>
                    <input type="text" class="form-control" name="<?= $unit->id ?>" id="filter" value="<?= $search ?>"
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
    <?php endif; ?>
    
        <table class="table table-bordered table-striped table-hover">
        <thead class="thead-light">
            <th>Nome da Seção</th>
            <th>Sigla</th>
            <th>Chefe</th>
            <th>Ações</th>
        </thead>
        <tbody>
            <?php if(count($divisions) == 0): ?>
                <tr>
                    <td colspan="4">Nenhuma Seção cadastrada.</td>
                </tr>
            <?php endif; ?>
            <?php foreach($divisions as $division): ?>
                <tr>
                    <td class="align-middle"><?= $division->name_division ?></td>
                    <td class="align-middle"><?= $division->initials_division ?></td>
                    <td class="align-middle"><?= $division->rank.' '.$division->name ?></td>
                    <td class="align-middle">
                    <?php if(!$parts): ?>
                        <a href="save_division.php?unit=<?= $division->division_unit_id ?>&update=<?= $division->id ?>" 
                            class="btn btn-warning rounded-circle btn-sm mr-2">
                            <i class="icofont-edit"></i>
                        </a>
                        <a href="?unit=<?= $division->division_unit_id ?>&delete=<?= $division->id ?>"
                            class="btn btn-danger rounded-circle btn-sm"
                            onclick="return confirm('Tem certeza que deseja excluir?')">
                            <i class="icofont-trash"></i>
                        </a>
                        <?php else: ?>
                            <a class="btn btn-primary btn-sm" href="parts.php?unit=<?= $unit->initials_unit ?>&division=<?= $division->id ?><?= $scales ?>">
                                Setores
                            </a>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</main>
<script>
    // Insere na url o termo de busca e faz o reload da página para o mesmo ser lido pelo controller
    function insertFilterTermInUrl() {
        var element = document.getElementById("filter");
        var searchTerm = element.value;
        var unit = element.name;
        var html = 'divisions.php?unit='+unit+'&searchTerm='+searchTerm;
        window.location.href = html;
    }
</script>