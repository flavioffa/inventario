<main class="content">
    <?php
        renderTitle(
            'Cadastro de Material Carga',
            'Crie e atualize seus materiais',
            'icofont-box mr-2'
        );

        include(TEMPLATE_PATH . "/messages.php");
    ?>
    <div class="form_ajax" style="display: none;"></div>
    <form action="#" method="post" id="form-material">
        <input type="hidden" name="id" value="<?= $id; ?>">
        <input type="hidden" name="qrcode" value="<?= $qrcode; ?>">
        <div class="form-row">
            <div class="form-group col-md-4">
                <label for="number_unit">Etiqueta CIMAER</label>
                <input type="number" id="number_unit" name="number_unit" min="0" placeholder="0000"
                    class="form-control <?= $errors['number_unit'] ? 'is-invalid' : '' ?>"
                    value="<?= $number_unit; ?>">
                <div class="invalid-feedback">
                    <?= $errors['number_unit'] ?>
                </div>
            </div>
            <div class="form-group col-md-4">
                <label for="number_metallic">Etiqueta Metálica</label>
                <input type="number" id="number_metallic" name="number_metallic" min="0" placeholder="0000"
                    class="form-control <?= $errors['number_metallic'] ? 'is-invalid' : '' ?>"
                    value="<?= $number_metallic; ?>">
                <div class="invalid-feedback">
                    <?= $errors['number_metallic'] ?>
                </div>
            </div>
            <div class="form-group col-md-4">
                <label for="number_bmp">Nº Patrimônio (BMP)</label>
                <input type="number" id="number_bmp" name="number_bmp" min="0" placeholder="0000"
                    class="form-control <?= $errors['number_bmp'] ? 'is-invalid' : '' ?>"
                    value="<?= $number_bmp; ?>">
                <div class="invalid-feedback">
                    <?= $errors['number_bmp'] ?>
                </div>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-3">
                <label for="type_material_id">Tipo</label> 
                <select id="type_material_id" name="type_material_id"
                    class="form-control <?= $errors['type_material_id'] ? 'is-invalid' : '' ?>">
                    <option value="">Escolher</option>
                    <?php foreach( $typeMaterial as $type ): ?>
                        <option value="<?= $type->id; ?>" <?=($type_material_id == $type->id)?'selected':''?>>
                            <?= $type->name_type; ?>
                        </option>  
                    <?php endforeach ?>
                </select>
                <div class="invalid-feedback">
                    <?= $errors['type_material_id'] ?>
                </div>
            </div>
            <div class="form-group col-md-9">
                <label for="model_id">Modelo</label>
                <span class="loading-model">Aguarde, carregando...</span>
                <select id="model_id" name="model_id"
                    class="form-control <?= $errors['model_id'] ? 'is-invalid' : '' ?>">
                    <option value="">Escolha o modelo</option>
                </select>
                <div class="invalid-feedback">
                    <?= $errors['model_id']; ?>
                </div>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-4">
                <label for="manufacturer_id">Fabricante</label> 
                <select id="manufacturer_id" name="manufacturer_id"
                    class="form-control <?= $errors['manufacturer_id'] ? 'is-invalid' : '' ?>">
                    <option value="">Escolher</option>
                    <?php foreach( $manufacturers as $manufacturer ): ?>
                        <option value="<?= $manufacturer->id; ?>" <?=($manufacturer_id == $manufacturer->id)?'selected':''?>>
                            <?= $manufacturer->name_manufacturer; ?>
                        </option>  
                    <?php endforeach ?>
                </select>
                <div class="invalid-feedback">
                    <?= $errors['manufacturer_id'] ?>
                </div>                
            </div>
            <div class="form-group col-md-4">
                <label for="number_serial">Nº de série</label>
                <input type="text" id="number_serial" name="number_serial"
                    class="form-control <?= $errors['number_serial'] ? 'is-invalid' : '' ?>"
                    value="<?= $number_serial; ?>">
                <div class="invalid-feedback">
                    <?= $errors['number_serial'] ?>
                </div>
            </div>
            <div class="form-group col-md-4">
                <label for="origin">Origem</label>
                <input type="text" id="origin" name="origin"
                    class="form-control <?= $errors['origin'] ? 'is-invalid' : '' ?>"
                    value="<?= $origin; ?>">
                <div class="invalid-feedback">
                    <?= $errors['origin'] ?>
                </div>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-4">
                <label for="fk_division_id">Seção</label> 
                <select id="fk_division_id" name="fk_division_id"
                    class="form-control <?= $errors['fk_division_id'] ? 'is-invalid' : '' ?>">
                    <option value="">Escolher</option>
                    <?php foreach( $divisions as $division ): ?>
                        <option value="<?= $division->id; ?>" <?=($fk_division_id == $division->id)?'selected':''?>>
                            <?= $division->name_division; ?>
                        </option>  
                    <?php endforeach ?>
                </select>
                <div class="invalid-feedback">
                    <?= $errors['fk_division_id'] ?>
                </div>                
            </div>
            <div class="form-group col-md-4">
                <label for="part_id">Setor</label>
                <span class="loading-part">Aguarde, carregando...</span>
                <select id="part_id" name="part_id"
                    class="form-control <?= $errors['part_id'] ? 'is-invalid' : '' ?>">
                    <?php if($part_id): ?>
                        <option value="<?= $part->id; ?>" <?=($part_id == $part->id)?'selected':''?>>
                            <?= $part->name_part; ?>
                        </option>  
                    <?php endif; ?>
                    <option value="">Escolha o setor</option>
                </select>
                <div class="invalid-feedback">
                    <?= $errors['part_id'] ?>
                </div>
            </div>
            <div class="form-group col-md-4">
                <label for="room">Sala</label>
                <input type="text" id="room" name="room"
                    class="form-control <?= $errors['room'] ? 'is-invalid' : '' ?>"
                    value="<?= $room; ?>">
                <div class="invalid-feedback">
                    <?= $errors['room'] ?>
                </div>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-4">
                <label for="status_id">Status</label> 
                <select id="status_id" name="status_id"
                    class="form-control <?= $errors['status_id'] ? 'is-invalid' : '' ?>">
                    <option value="">Escolher</option>
                    <?php foreach( $status as $value ): ?>
                        <option value="<?= $value->id; ?>" <?=($status_id == $value->id)?'selected':''?>>
                            <?= $value->name_status; ?>
                        </option>  
                    <?php endforeach ?>
                </select>
                <div class="invalid-feedback">
                    <?= $errors['status_id'] ?>
                </div>                
            </div>            
            <div class="form-group col-md-4">
                <label for="condition_id">Condição</label> 
                <select id="condition_id" name="condition_id"
                    class="form-control <?= $errors['condition_id'] ? 'is-invalid' : '' ?>">
                    <option value="">Escolher</option>
                    <?php foreach( $conditions as $value ): ?>
                        <option value="<?= $value->id; ?>" <?=($condition_id == $value->id)?'selected':''?>>
                            <?= $value->name_condition; ?>
                        </option>  
                    <?php endforeach ?>
                </select>
                <div class="invalid-feedback">
                    <?= $errors['condition_id'] ?>
                </div>                
            </div> 
            <div class="form-group col-md-4">
                <label for="gmm_cautela">GMM/Cautela</label>
                <input type="text" id="gmm_cautela" name="gmm_cautela"
                    class="form-control <?= $errors['gmm_cautela'] ? 'is-invalid' : '' ?>"
                    value="<?= $gmm_cautela; ?>">
                <div class="invalid-feedback">
                    <?= $errors['gmm_cautela'] ?>
                </div>
            </div>           
        </div>
        <div class="form-row">
            <div class="form-group col-md-12">
                <label for="obs">Observação</label>
                <textarea id="obs" name="obs"
                    class="form-control <?= $errors['obs'] ? 'is-invalid' : '' ?>"
                    value="<?= $obs; ?>"></textarea>
                <div class="invalid-feedback">
                    <?= $errors['obs'] ?>
                </div>
            </div>             
        </div>
        <div>
            <button class="btn btn-primary btn-lg">Salvar</button>
            <a href="/materials.php"
                class="btn btn-secondary btn-lg">Cancelar</a>
        </div>
    </form>
    <div id="teste"></div> 
</main>
<script type="text/javascript">
    function teste(el) {
        let form = el;
        console.log(el);
        // $('#part_id').hide();
        // $('.loading-part').show();
        // $.ajax({
        //     type:'POST',
        //     url:'filterParts.php',
        //     data: 'filter='+(part)+'&action=filterParts',
        //     dataType:'json',
        //     success:function(json) {
        //         var options = '<option value="">Escolha o setor</option>';	
        //         for (var i = 0; i < json.length; i++) {
        //             options += '<option value="' + json[i].id + '">' + json[i].name_part + '</option>';
        //         }	
        //         $('#part_id').html(options).show();
        //         $('.loading-part').hide();
        //     },
        //     error: function () {
        //         $('#model_id').html('<option value="">Escolha o modelo</option>');
        //     }
        // });  

        return false;
    }
</script>