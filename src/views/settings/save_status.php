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
        <div class="form-row">
            <div class="form-group col-md-8">
                <label for="name_condition">Escolha a cor de fundo do Status(Opcional)</label>
                <div class="btn-group btn-group-toggle" data-toggle="buttons">
                    <label class="btn btn-outline-primary <?=$color_status == 'primary' ? 'active' : ''; ?>">
                        <input type="radio" name="color_status" id="option1" autocomplete="off" value="primary"> Azul
                    </label>
                    <label class="btn btn-outline-success <?=$color_status == 'success' ? 'active' : ''; ?>">
                        <input type="radio" name="color_status" id="option2" autocomplete="off" value="success"> Verde
                    </label>
                    <label class="btn btn-outline-danger <?=$color_status == 'danger' ? 'active' : ''; ?>">
                        <input type="radio" name="color_status" id="option4" autocomplete="off" value="danger"> Vermelho
                    </label>
                    <label class="btn btn-outline-warning <?=$color_status == 'warning' ? 'active' : ''; ?>">
                        <input type="radio" name="color_status" id="option5" autocomplete="off" value="warning"> Amarelo
                    </label>
                    <label class="btn btn-outline-dark <?=$color_status == 'dark' ? 'active' : ''; ?>">
                        <input type="radio" name="color_status" id="option6" autocomplete="off" value="dark"> Preto
                    </label>
                    <label class="btn btn-outline-secondary <?=$color_status == 'secondary' ? 'active' : ''; ?>">
                        <input type="radio" name="color_status" id="option7" autocomplete="off" value="secondary"> Cinza
                    </label>
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