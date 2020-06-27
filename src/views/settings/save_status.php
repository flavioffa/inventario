<main class="content">
    <?php
        renderTitle(
            'Cadastro de Status',
            'Crie e atualize o Status',
            'icofont-dashboard'
        );

        include(TEMPLATE_PATH . "/messages.php");
    ?>
    <form action="#" method="post">
        <input type="hidden" name="id" value="<?= $id ?>">
        <div class="form-row">
            <div class="form-group col-md-8">
                <label for="name_status">Nome do Status</label>
                <input type="text" id="name_status" name="name_status" placeholder="Digite o status"
                    class="form-control <?= $errors['name_status'] ? 'is-invalid' : '' ?>"
                    value="<?= $name_status ?? '' ?>">
                <div class="invalid-feedback">
                    <?= $errors['name_status'] ?>
                </div>
            </div>
        </div>
        <div>
            <button class="btn btn-primary btn-lg">Salvar</button>
            <a href="status.php"
                class="btn btn-secondary btn-lg">Cancelar</a>
        </div>
    </form>    
</main>