<main class="content">
    <?php
        renderTitle(
            'Tipo de Material',
            'Crie e atualize o Tipo',
            'icofont-listing-box'
        );

        include(TEMPLATE_PATH . "/messages.php");
    ?>
    <form action="#" method="post">
        <input type="hidden" name="id" value="<?= $id ?>">
        <div class="form-row">
            <div class="form-group col-md-8">
                <label for="name_type">Nome do Tipo</label>
                <input type="text" id="name_type" name="name_type" placeholder="Informe o nome do tipo"
                    class="form-control <?= $errors['name_type'] ? 'is-invalid' : '' ?>"
                    value="<?= $name_type ?? '' ?>">
                <div class="invalid-feedback">
                    <?= $errors['name_type'] ?>
                </div>
            </div>
        </div>
        <div>
            <button class="btn btn-primary btn-lg">Salvar</button>
            <a href="types_materials.php"
                class="btn btn-secondary btn-lg">Cancelar</a>
        </div>
    </form>    
</main>