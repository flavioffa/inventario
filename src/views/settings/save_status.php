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
            <div class="form-group col-md-12">
            <label for="name_status">Escolha a cor de fundo do Status(Opcional)</label>
                <div class="input-group mb-3">
                    <div class="input-group-prepend" id="button-addon3">
                        <button class="btn btn-outline-primary <?=$color_status == 'primary' ? 'active' : ''; ?>" id="primary" type="button" onclick="setColor('primary')">Azul</button>
                        <button class="btn btn-outline-success <?=$color_status == 'success' ? 'active' : ''; ?>" id="success" type="button" onclick="setColor('success')">Verde</button>
                        <button class="btn btn-outline-danger <?=$color_status == 'danger' ? 'active' : ''; ?>" id="danger" type="button" onclick="setColor('danger')">Vermelho</button>
                        <button class="btn btn-outline-warning <?=$color_status == 'warning' ? 'active' : ''; ?>" id="warning" type="button" onclick="setColor('warning')">Amarelo</button>
                        <button class="btn btn-outline-dark <?=$color_status == 'dark' ? 'active' : ''; ?>" id="dark" type="button" onclick="setColor('dark')">Preto</button>
                        <button class="btn btn-outline-secondary <?=$color_status == 'secondary' ? 'active' : ''; ?>" id="secondary" type="button" onclick="setColor('secondary')">Cinza</button>
                    </div>
                    <input type="hidden" class="form-control" name="color_status" id="color_status" value="<?= $color_status ?? 'white' ?>">
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
<script>
    function setColor(name) {
        var buttonClick = document.getElementById(name);
        var buttonActive = document.getElementById("color_status").value
        if((buttonClick.className).indexOf('active') == -1) {
            if(buttonActive !== 'white') {
                document.getElementById(buttonActive).className = 'btn btn-outline-'+buttonActive;
            }
            buttonClick.className = (buttonClick.className) + ' active';
            document.getElementById("color_status").value = name;
        } else {
            buttonClick.className = (buttonClick.className).replace('active', '');
            document.getElementById("color_status").value = 'white';
        }
    }    
</script>