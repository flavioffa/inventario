<main class="content">
    <?php
        renderTitle(
            'Setor',
            'Crie e atualize o Setor',
            'icofont-ui-home'
        );

        include(TEMPLATE_PATH . "/messages.php");
    ?>
    <form action="#" method="post">
        <input type="hidden" name="id" value="<?= $id ?>">
        <input type="hidden" name="division_id" value="<?= $division_id ?>">
        <div class="form-row">
            <div class="form-group col-md-8">
                <label for="name_part">Nome do Setor</label>
                <input type="text" id="name_part" name="name_part" placeholder="Informe o nome do Setor"
                    class="form-control <?= $errors['name_part'] ? 'is-invalid' : '' ?>"
                    value="<?= $name_part ?>">
                <div class="invalid-feedback">
                    <?= $errors['name_part'] ?>
                </div>
            </div>
        </div>
        <div>
            <button class="btn btn-primary btn-lg">Salvar</button>
            <a href="parts.php?unit=<?= $unit_initials ?>&division=<?= $division_id ?>"
                class="btn btn-secondary btn-lg">Cancelar</a>
        </div>
    </form>    
</main>