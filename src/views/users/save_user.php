<main class="content">
    <?php
        renderTitle(
            'Cadastro de Usuário',
            'Crie e atualize o usuário',
            'icofont-user mr-2'
        );

        include(TEMPLATE_PATH . "/messages.php");
    ?>
    <form action="#" method="post">
        <input type="hidden" name="id" value="<?= $id; ?>">
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="name">Nome</label>
                <input type="text" id="name" name="name" placeholder="Informe o nome"
                    class="form-control <?= $errors['name'] ? 'is-invalid' : '' ?>"
                    value="<?= $name; ?>">
                <div class="invalid-feedback">
                    <?= $errors['name'] ?>
                </div>
            </div>
            <div class="form-group col-md-3">
                <label for="rank">Posto/Graduação</label>
                <select id="rank" name="rank"
                    class="form-control <?= $errors['rank'] ? 'is-invalid' : '' ?>">
                    <option value="">Escolher</option>
                    <?php foreach( $ranks as $pg ): ?>
                        <option value="<?= $pg; ?>" <?=($rank == $pg)?'selected':''?>>
                            <?= $pg; ?>
                        </option>  
                    <?php endforeach ?>
                </select>
                <div class="invalid-feedback">
                    <?= $errors['rank'] ?>
                </div>
            </div>
            <div class="form-group col-md-3">
                <label for="cadre">Quadro/Especialidade</label>
                <input type="text" id="cadre" name="cadre" placeholder="Informe o quadro"
                    class="form-control <?= $errors['cadre'] ? 'is-invalid' : '' ?>"
                    value="<?= $cadre ?>">
                <div class="invalid-feedback">
                    <?= $errors['cadre'] ?>
                </div>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="email">E-mail</label>
                <input type="email" id="email" name="email" placeholder="Informe o email"
                    class="form-control <?= $errors['email'] ? 'is-invalid' : '' ?>"
                    value="<?= $email ?>">
                <div class="invalid-feedback">
                    <?= $errors['email'] ?>
                </div>
            </div>
            <div class="form-group col-md-3">
                <label for="unit_id">Unidade</label>
                <select id="unit_id" name="unit_id"
                    class="form-control <?= $errors['unit_id'] ? 'is-invalid' : '' ?>">
                    <option value="">Escolher</option>
                    <?php foreach( $units as $unit ): ?>
                        <option value="<?= $unit->id; ?>" <?=($unit_id == $unit->id)?'selected':''?>>
                            <?= $unit->initials_unit; ?>
                        </option>  
                    <?php endforeach ?>
                </select>
                <div class="invalid-feedback">
                    <?= $errors['type_id'] ?>
                </div>
            </div>
            <div class="form-group col-md-3">
                <label for="is_admin">Administrador?</label>
                <input type="checkbox" id="is_admin" name="is_admin"
                    class="form-control <?= $errors['is_admin'] ? 'is-invalid' : '' ?>"
                    <?= $is_admin ? 'checked' : '' ?>>
                <div class="invalid-feedback">
                    <?= $errors['is_admin'] ?>
                </div>
            </div>
        </div>
        <?php if(isset($id) && !empty($id)): ?>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="password">Senha</label>
                <input type="password" id="password" name="password" placeholder="Informe a senha"
                    class="form-control <?= $errors['password'] ? 'is-invalid' : '' ?>">
                <div class="invalid-feedback">
                    <?= $errors['password'] ?>
                </div>
            </div>
            <div class="form-group col-md-6">
                <label for="confirm_password">Confirmação de Senha</label>
                <input type="password" id="confirm_password" name="confirm_password"
                    placeholder="Confirme a senha"
                    class="form-control <?= $errors['confirm_password'] ? 'is-invalid' : '' ?>">
                <div class="invalid-feedback">
                    <?= $errors['confirm_password'] ?>
                </div>
            </div>
        </div>
        <?php endif; ?>
        <div>
            <button class="btn btn-primary btn-lg">Salvar</button>
            <a href="/users.php"
                class="btn btn-secondary btn-lg">Cancelar</a>
        </div>
    </form>    
</main>