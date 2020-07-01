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
            <div class="form-group col-md-12">
            <label for="name_condition">Escolha a cor do texto da condição(Opcional)</label>
                <div class="input-group mb-3">
                    <div class="input-group-prepend" id="button-addon3">
                        <button class="btn btn-outline-primary <?=$color_condition == 'primary' ? 'active' : ''; ?>" id="primary" type="button" onclick="setColor('primary')">Azul</button>
                        <button class="btn btn-outline-success <?=$color_condition == 'success' ? 'active' : ''; ?>" id="success" type="button" onclick="setColor('success')">Verde</button>
                        <button class="btn btn-outline-danger <?=$color_condition == 'danger' ? 'active' : ''; ?>" id="danger" type="button" onclick="setColor('danger')">Vermelho</button>
                        <button class="btn btn-outline-warning <?=$color_condition == 'warning' ? 'active' : ''; ?>" id="warning" type="button" onclick="setColor('warning')">Amarelo</button>
                        <button class="btn btn-outline-dark <?=$color_condition == 'dark' ? 'active' : ''; ?>" id="dark" type="button" onclick="setColor('dark')">Preto</button>
                        <button class="btn btn-outline-secondary <?=$color_condition == 'secondary' ? 'active' : ''; ?>" id="secondary" type="button" onclick="setColor('secondary')">Cinza</button>
                    </div>
                    <input type="hidden" class="form-control" name="color_condition" id="color_condition" value="<?= $color_condition ?? 'white' ?>">
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
<script>
    function setColor(name) {
        var buttonClick = document.getElementById(name);
        var buttonActive = document.getElementById("color_condition").value
        if((buttonClick.className).indexOf('active') == -1) {
            if(buttonActive !== 'white') {
                document.getElementById(buttonActive).className = 'btn btn-outline-'+buttonActive;
            }
            buttonClick.className = (buttonClick.className) + ' active';
            document.getElementById("color_condition").value = name;
        } else {
            buttonClick.className = (buttonClick.className).replace('active', '');
            document.getElementById("color_condition").value = 'white';
        }
    }    
</script>