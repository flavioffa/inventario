<main class="content">
    <?php
        renderTitle(
            'Cadastro de Usuários',
            'Mantenha os dados dos usuários atualizados',
            'icofont-users'
        );

        include(TEMPLATE_PATH . "/messages.php");
    ?>

    <div class="container" id="search">
        <div class="row justify-content-between">
            <div class="col-6">
                <a class="btn btn-lg btn-primary"
                    href="save_user.php">Novo Usuário</a>
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