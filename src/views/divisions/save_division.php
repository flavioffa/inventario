<main class="content">
    <?php
        renderTitle(
            'Divisão',
            'Crie e atualize a Divisão',
            'icofont-cube'
        );

        include(TEMPLATE_PATH . "/messages.php");
    ?>
    <form action="#" method="post">
        <input type="hidden" name="id" value="<?= $id ?>">
        <input type="hidden" name="division_unit_id" value="<?= $unit_id ?>">
        <div class="form-row">
            <div class="form-group col-md-8">
                <label for="name_division">Nome</label>
                <input type="text" id="name_division" name="name_division" placeholder="Informe o nome da divisão"
                    class="form-control <?= $errors['name_division'] ? 'is-invalid' : '' ?>"
                    value="<?= $name_division ?>">
                <div class="invalid-feedback">
                    <?= $errors['name_division'] ?>
                </div>
            </div>
            <div class="form-group col-md-4">
                <label for="initials_division">Sigla</label>
                <input type="text" id="initials_division" name="initials_division" placeholder="Informe a sigla da divisão"
                    class="form-control <?= $errors['initials_division'] ? 'is-invalid' : '' ?>"
                    value="<?= $initials_division ?>">
                <div class="invalid-feedback">
                    <?= $errors['initials_division'] ?>
                </div>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="chief_division_id">Chefe</label>
                <select id="chief_division_id" name="chief_division_id"
                    class="form-control <?= $errors['chief_division_id'] ? 'is-invalid' : '' ?>">
                    <option value="">Escolha o Chefe</option>
                    <?php foreach($users as $user): ?>
                        <option value="<?= $user->id; ?>"  <?=($chief_division_id == $user->id)?'selected':''?>>
                            <?= $user->rank; ?> <?= $user->name; ?>
                        </option>  
                    <?php endforeach ?>
                </select>
                <div class="invalid-feedback">
                    <?= $errors['chief_division_id'] ?>
                </div>
            </div>
            <!-- <div class="form-group col-md-6">
                <label for="city_unit">Cidade</label>
                <select id="city_unit" name="city_unit"
                    class="form-control <?= $errors['city_unit'] ? 'is-invalid' : '' ?>">
                    <option value="">Escolha a cidade</option>
                    <?php foreach($cities as $city): ?>
                        <option value="<?= $city['city'] ?>" <?=($city_unit == $city['city'])?'selected':''?>>
                            <?= $city['city'] ?>
                        </option>  
                    <?php endforeach ?>
                </select>
                <div class="invalid-feedback">
                    <?= $errors['city_unit'] ?>
                </div>
            </div> -->
        </div>
        <div>
            <button class="btn btn-primary btn-lg">Salvar</button>
            <a href="divisions.php?unit=<?= $unit_id ?>"
                class="btn btn-secondary btn-lg">Cancelar</a>
        </div>
    </form>    
</main>