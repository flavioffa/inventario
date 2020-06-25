<main class="content">
    <?php
        renderTitle(
            'Cadastro de Usuários',
            'Mantenha os dados dos usuários atualizados',
            'icofont-users'
        );

        include(TEMPLATE_PATH . "/messages.php");
    ?>

    <a class="btn btn-lg btn-primary mb-2" href="save_user.php">Novo Usuário</a>

    <table class="table table-bordered table-striped table-hover">
        <thead class="thead-light">
            <th class="text-center">Posto/Graduação</th>
            <th>Nome</th>
            <th>Email</th>
            <th>Ações</th>    
        </thead>
        <tbody>
            <?php foreach($users as $user): ?>
                <tr>
                    <td class="align-middle text-center"><?= $user->rank ?></td>
                    <td class="align-middle"><?= $user->name ?></td>
                    <td class="align-middle"><?= $user->email ?></td>
                    <td class="align-middle">
                        <a href="save_user.php?update=<?= $user->id ?>" 
                            class="btn btn-warning rounded-circle btn-sm mr-2">
                            <i class="icofont-edit"></i>
                        </a>
                        <?php if(intval($user->id) !== $loggedId): ?>
                        <a href="?delete=<?= $user->id ?>"
                            class="btn btn-danger rounded-circle btn-sm"
                            onclick="return confirm('Tem certeza que deseja excluir?')">
                            <i class="icofont-trash"></i>
                        </a>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach?>
        </tbody>
    </table>
</main>