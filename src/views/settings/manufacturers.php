<main class="content">
    <?php
        renderTitle(
            'Cadastro de Fabricantes',
            'Mantenha os dados dos fabricantes atualizados',
            'icofont-industries-5'
        );

        include(TEMPLATE_PATH . "/messages.php");
    ?>

    <div class="container" id="search">
        <div class="row justify-content-between">
            <div class="col-6">
                <a class="btn btn-lg btn-primary"
                    href="save_manufacturer.php">Novo Fabricante</a>
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
            <th>Fabricante</th>
            <th>Ações</th>    
        </thead>
        <tbody>
            <?php if(count($manufacturers) == 0): ?>
                <tr>
                    <td colspan="3">Nenhum Fabricante cadastrado.</td>
                </tr>
            <?php endif; ?>
            <?php foreach($manufacturers as $key => $manufacturer): ?>
                <tr>
                    <td class="align-middle text-center"><?= ($key + 1); ?></td>
                    <td class="align-middle"><?= $manufacturer->name_manufacturer ?></td>
                    <td class="align-middle">
                        <a href="save_manufacturer.php?update=<?= $manufacturer->id ?>" 
                            class="btn btn-warning rounded-circle btn-sm mr-2">
                            <i class="icofont-edit"></i>
                        </a>
                        <a href="?delete=<?= $manufacturer->id ?>"
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