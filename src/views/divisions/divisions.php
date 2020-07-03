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
        <a class="btn btn-lg btn-primary mb-3" href="save_division.php?unit=<?= $unit->id ?>">
            Nova Seção
        </a>
    <?php endif; ?>
        <table class="table table-bordered table-striped table-hover">
        <thead class="thead-light">
            <th>Nome da Seção</th>
            <th>Sigla</th>
            <th>Ações</th>
        </thead>
        <tbody>
            <?php if(count($divisions) == 0): ?>
                <tr>
                    <td colspan="3">Nenhuma Seção cadastrada.</td>
                </tr>
            <?php endif; ?>
            <?php foreach($divisions as $division): ?>
                <tr>
                    <td class="align-middle"><?= $division->name_division ?></td>
                    <td class="align-middle"><?= $division->initials_division ?></td>
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