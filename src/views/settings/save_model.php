<main class="content">
    <?php
        renderTitle(
            'Modelo de Material',
            'Crie e atualize o Modelo',
            'icofont-layers'
        );

        include(TEMPLATE_PATH . "/messages.php");
    ?>
    <form action="#" method="post">
        <input type="hidden" name="id" value="<?= $id ?>">
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="type_id">Tipo do Modelo</label>
                <select id="type_id" name="type_id"
                    class="form-control <?= $errors['type_id'] ? 'is-invalid' : '' ?>">
                    <option value="">Escolher o tipo</option>
                    <?php foreach( $typesMaterials as $type ): ?>
                        <option value="<?= $type->id; ?>" <?=($type_id == $type->id)?'selected':''?>>
                            <?= $type->name_type; ?>
                        </option>  
                    <?php endforeach ?>
                </select>
                <div class="invalid-feedback">
                    <?= $errors['type_id'] ?>
                </div>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-12">
                <label for="name_model">Descrição do Modelo</label>
                <input type="text" id="name_model" name="name_model" placeholder="Informe os detalhes do modelo"
                    class="form-control <?= $errors['name_model'] ? 'is-invalid' : '' ?>"
                    value="<?= $name_model ?? '' ?>">
                <div class="invalid-feedback">
                    <?= $errors['name_model'] ?>
                </div>
            </div>
        </div>
        <div>
            <button class="btn btn-primary btn-lg">Salvar</button>
            <a href="models_materials.php?page=1"
                class="btn btn-secondary btn-lg">Cancelar</a>
        </div>
    </form>    
</main>