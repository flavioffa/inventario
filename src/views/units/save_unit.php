<main class="content">
    <?php
        renderTitle(
            'Cadastro de Unidade',
            'Crie e atualize a unidade',
            'icofont-ui-home'
        );

        include(TEMPLATE_PATH . "/messages.php");
    ?>
    <form action="#" method="post">
        <input type="hidden" name="id" value="<?= $id ?>">
        <div class="form-row">
            <div class="form-group col-md-8">
                <label for="name_unit">Nome</label>
                <input type="text" id="name_unit" name="name_unit" placeholder="Informe o nome da unidade"
                    class="form-control <?= $errors['name_unit'] ? 'is-invalid' : '' ?>"
                    value="<?= $name_unit ?? '' ?>">
                <div class="invalid-feedback">
                    <?= $errors['name_unit'] ?>
                </div>
            </div>
            <div class="form-group col-md-4">
                <label for="initials_unit">Sigla</label>
                <input type="text" id="initials_unit" name="initials_unit" placeholder="Informe a sigla da unidade"
                    class="form-control <?= $errors['initials_unit'] ? 'is-invalid' : '' ?>"
                    value="<?= $initials_unit ?? '' ?>">
                <div class="invalid-feedback">
                    <?= $errors['initials_unit'] ?>
                </div>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="chief_id">Comandante</label>
                <select id="chief_id" name="chief_id"
                    class="form-control <?= $errors['chief_id'] ? 'is-invalid' : '' ?>">
                    <option value="">Escolha o Comandante</option>
                    <?php foreach($users as $user): ?>
                        <option value="<?= $user->id; ?>"  <?=($chief_id == $user->id)?'selected':''?>>
                            <?= $user->rank; ?> <?= $user->name; ?>
                        </option>  
                    <?php endforeach ?>
                </select>
                <div class="invalid-feedback">
                    <?= $errors['chief_id'] ?>
                </div>
            </div>
        </div>
        <div>
            <button class="btn btn-primary btn-lg">Salvar</button>
            <a href="/units.php"
                class="btn btn-secondary btn-lg">Cancelar</a>
        </div>
    </form>    
</main>