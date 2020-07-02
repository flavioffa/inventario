<main class="content">
    <?php
        renderTitle(
            'Cadastro de Condição',
            'Crie e atualize a Condição',
            'icofont-star'
        );

        include(TEMPLATE_PATH . "/messages.php");
    ?>
    <form action="#" method="post">
        <input type="hidden" name="id" value="<?= $id ?>">
        <div class="form-row">
            <div class="form-group col-md-8">
                <label for="name_condition">Nome da Condição</label>
                <input type="text" id="name_condition" name="name_condition" placeholder="Digite a condição"
                    class="form-control <?= $errors['name_condition'] ? 'is-invalid' : '' ?>"
                    value="<?= $name_condition ?? '' ?>">
                <div class="invalid-feedback">
                    <?= $errors['name_condition'] ?>
                </div>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-8">
                <label for="name_condition">Escolha a cor do texto da condição(Opcional)</label>
                <div class="btn-group btn-group-toggle" data-toggle="buttons">
                    <label class="btn btn-outline-primary <?=$color_condition == 'primary' ? 'active' : ''; ?>">
                        <input type="radio" name="color_condition" id="option1" autocomplete="off" value="primary"> Azul
                    </label>
                    <label class="btn btn-outline-success <?=$color_condition == 'success' ? 'active' : ''; ?>">
                        <input type="radio" name="color_condition" id="option2" autocomplete="off" value="success"> Verde
                    </label>
                    <label class="btn btn-outline-danger <?=$color_condition == 'danger' ? 'active' : ''; ?>">
                        <input type="radio" name="color_condition" id="option3" autocomplete="off" value="danger"> Vermelho
                    </label>
                    <label class="btn btn-outline-warning <?=$color_condition == 'warning' ? 'active' : ''; ?>">
                        <input type="radio" name="color_condition" id="option3" autocomplete="off" value="warning"> Amarelo
                    </label>
                    <label class="btn btn-outline-dark <?=$color_condition == 'dark' ? 'active' : ''; ?>">
                        <input type="radio" name="color_condition" id="option3" autocomplete="off" value="dark"> Preto
                    </label>
                    <label class="btn btn-outline-secondary <?=$color_condition == 'secondary' ? 'active' : ''; ?>">
                        <input type="radio" name="color_condition" id="option3" autocomplete="off" value="secondary"> Cinza
                    </label>
                </div>
            </div>
        </div>
        <div>
            <button class="btn btn-primary btn-lg">Salvar</button>
            <a href="conditions.php"
                class="btn btn-secondary btn-lg">Cancelar</a>
        </div>
    </form>    
</main>