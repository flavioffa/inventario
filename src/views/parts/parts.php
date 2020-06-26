<main class="content">
    <?php
        renderTitle(
            $unit_initials,
            $msgTitle,
            'icofont-cubes'
        );

        include(TEMPLATE_PATH . "/messages.php");
    ?>
    <?php if(!$scales): ?>
        <a class="btn btn-lg btn-primary mb-3" href="save_part.php?unit=<?= $unit_initials ?>&division=<?= $division->id ?>">
            Novo Setor
        </a>
    <?php endif; ?>
        <table class="table table-bordered table-striped table-hover">
        <thead class="thead-light">
            <th>Nome do Setor</th>
            <th>Ações</th>
        </thead>
        <tbody>
            <?php if(count($parts) == 0): ?>
                <tr>
                    <td colspan="3">Nenhum Setor cadastrado.</td>
                </tr>
            <?php endif; ?>
            <?php foreach($parts as $part): ?>
                <tr>
                    <td class="align-middle"><?= $part->name_part ?></td>
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