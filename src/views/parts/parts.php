<main class="content">
    <?php
        renderTitle(
            $unit_initials,
            $msgTitle,
            'icofont-cubes'
        );

        include(TEMPLATE_PATH . "/messages.php");
    ?>

    <div class="container" id="search">
        <div class="row justify-content-between">
            <div class="col-6">
                <a class="btn btn-lg btn-primary"
                    href="save_part.php?unit=<?= $unit_initials ?>&division=<?= $division->id ?>">Novo Setor</a>
            </div>
            <div class="col-6 mt-2">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroup-sizing-sm">
                        <i class="icofont-search-2"></i>
                        </span>
                    </div>
                    <input type="text" class="form-control" name="<?= $division->id ?>" id="filter" value="<?= $search ?>"
                        placeholder="Pesquisar" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
                    <div class="input-group-append">
                        <button class="btn btn-outline-secondary" type="button" name="<?= $unit_initials ?>" onclick="insertFilterTermInUrl(this)" id="button-addon2">
                            Buscar
                        </button>
                    </div>
                </div>
            </div>    
        </div>
    </div>
    
    <table class="table table-bordered table-striped table-hover">
        <thead class="thead-light">
            <th>Setores</th>
            <th>Seção</th>
            <th>Ações</th>
        </thead>
        <tbody>
            <?php if(count($parts) == 0): ?>
                <tr>
                    <td colspan="4">Nenhum Setor cadastrado.</td>
                </tr>
            <?php endif; ?>
            <?php foreach($parts as $part): ?>
                <tr>
                    <td class="align-middle"><?= $part->name_part ?></td>
                    <td class="align-middle"><?= $part->initials_division ?></td>
                    <td class="align-middle">
                        <a href="save_part.php?unit=<?= $unit_initials ?>&division=<?= $part->division_id ?>&update=<?= $part->id ?>" 
                            class="btn btn-warning rounded-circle btn-sm mr-2">
                            <i class="icofont-edit"></i>
                        </a>
                        <a href="?unit=<?= $unit_initials ?>&division=<?= $part->division_id ?>&delete=<?= $part->id ?>"
                            class="btn btn-danger rounded-circle btn-sm"
                            onclick="return confirm('Tem certeza que deseja excluir?')">
                            <i class="icofont-trash"></i>
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</main>
<script>
    // Insere na url o termo de busca e faz o reload da página para o mesmo ser lido pelo controller
    function insertFilterTermInUrl(el) {
        var element = document.getElementById("filter");
        var searchTerm = element.value;
        var division = element.name;
        var html = 'parts.php?unit='+el.name+'&division='+division+'&searchTerm='+searchTerm;
        window.location.href = html;
    }
</script>