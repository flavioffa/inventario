<main class="content">
    <?php
        renderTitle(
            'Cadastro de Fabricante',
            'Crie e atualize o Fabricante',
            'icofont-industries-5'
        );

        include(TEMPLATE_PATH . "/messages.php");
    ?>
    <form action="#" method="post">
        <input type="hidden" name="id" value="<?= $id ?>">
        <div class="form-row">
            <div class="form-group col-md-8">
                <label for="name_manufacturer">Nome do Fabricante</label>
                <input type="text" id="name_manufacturer" name="name_manufacturer" placeholder="Informe o nome do fabricante"
                    class="form-control <?= $errors['name_manufacturer'] ? 'is-invalid' : '' ?>"
                    value="<?= $name_manufacturer ?? '' ?>">
                <div class="invalid-feedback">
                    <?= $errors['name_manufacturer'] ?>
                </div>
            </div>
        </div>
        <div>
            <button class="btn btn-primary btn-lg">Salvar</button>
            <a href="manufacturers.php"
                class="btn btn-secondary btn-lg">Cancelar</a>
        </div>
    </form>    
</main>