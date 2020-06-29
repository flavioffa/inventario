<main class="content">
    <?php
        renderTitle(
            'Cadastro de Condição',
            'Mantenha os dados dos Condição atualizados',
            'icofont-star'
        );

        include(TEMPLATE_PATH . "/messages.php");
    ?>

    <div class="container" id="search">
        <div class="row justify-content-between">
            <div class="col-6">
                <a class="btn btn-lg btn-primary"
                    href="save_condition.php">Nova Condição</a>
            </div>
            <div class="col-6 mt-2">
                <form method="GET" action="#">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="inputGroup-sizing-sm">
                            <i class="icofont-search-2"></i>
                            </span>
                        </div>
                        <input type="text" class="form-control" name="searchTerm" value="<?= $search ?>"
                            placeholder="Pesquisar" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
                    </div>
                </form>
            </div>    
        </div>
    </div>

    <table class="table table-bordered table-striped table-hover">
        <thead class="thead-light">
            <th class="text-center">Nº</th>
            <th>Condição</th>
            <th>Ações</th>    
        </thead>
        <tbody>
            <?php if(count($conditions) == 0): ?>
                <tr>
                    <td colspan="3">Nenhum condição cadastrada.</td>
                </tr>
            <?php endif; ?>
            <?php foreach($conditions as $key => $value): ?>
                <tr class="<?= $value->color_condition == 'white' ? '' : ($value->color_condition == 'dark' ? 'bg-secondary text-white' : "text-{$value->color_condition}"); ?>">
                    <td class="align-middle text-center"><?= ($key + 1); ?></td>
                    <td class="align-middle">
                        <?= $value->name_condition ?>
                    </td>
                    <td class="align-middle">
                        <a href="save_condition.php?update=<?= $value->id ?>" 
                            class="btn btn-warning rounded-circle btn-sm mr-2">
                            <i class="icofont-edit"></i>
                        </a>
                        <a href="?delete=<?= $value->id ?>"
                            class="btn btn-danger rounded-circle btn-sm"
                            onclick="return confirm('Tem certeza que deseja excluir?')">
                            <i class="icofont-trash"></i>
                        </a>
                    </td>
                </tr>
            <?php endforeach?>
        </tbody>
    </table>
</main>