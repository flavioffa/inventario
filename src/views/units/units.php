<main class="content">
    <?php
        renderTitle(
            $title,
            $msgTitle,
            'icofont-ui-home'
        );

        include(TEMPLATE_PATH . "/messages.php");
    ?>
    <?php if(!$divisions): ?>
        <a class="btn btn-lg btn-primary mb-3" href="save_unit.php">
            Nova Unidade
        </a>
    <?php endif; ?>
        <table class="table table-bordered table-striped table-hover">
        <thead class="thead-light">
            <th>Nome da Unidade</th>
            <th>Sigla</th>
            <th>Ações</th>
        </thead>
        <tbody>
            <?php if(count($units) == 0): ?>
                <tr>
                    <td colspan="4">Nenhuma Unidade cadastrada.</td>
                </tr>
            <?php endif; ?>
            <?php foreach($units as $unit): ?>
                <tr>
                    <td class="align-middle"><?= $unit->name_unit ?></td>
                    <td class="align-middle"><?= $unit->initials_unit ?></td>
                    <td class="align-middle">
                        <?php if(!$divisions): ?>
                            <a href="save_unit.php?update=<?= $unit->id ?>" 
                                class="btn btn-warning rounded-circle btn-sm mr-2">
                                <i class="icofont-edit"></i>
                            </a>
                            <a href="?delete=<?= $unit->id ?>"
                                class="btn btn-danger rounded-circle btn-sm"
                                onclick="return confirm('Tem certeza que deseja excluir?')">
                                <i class="icofont-trash"></i>
                            </a>
                        <?php else: ?>
                            <a class="btn btn-primary btn-sm" href="divisions.php?unit=<?= $unit->id ?><?= $parts ?><?= $scales ?>">
                                Seções
                            </a>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</main>