<main class="content">
    <?php
        renderTitle(
            'Relátorios',
            'Escolha os dados para gerar um relatório',
            'icofont-chart-histogram mr-2'
        );

        include(TEMPLATE_PATH . "/messages.php");
    ?>

    <!-- <div class="container" id="search"> -->
        <div class="row justify-content-between">
            <div class="col-3">
                <form action="" method="get">
                    <select id="typeFilter" name="typeFilter" onchange="this.form.submit()"
                        class="form-control mt-2">
                        <option value="">Escolha o filtro</option>
                        <?php foreach( $reports as $key => $report ): ?>
                            <option value="<?= $key; ?>" <?=($typeFilter == $key)?'selected':''?>>
                                <?= $report; ?>
                            </option>  
                        <?php endforeach; ?>
                    </select>
                </form>
            </div>
            <?php if($subFilters || $subFilter): ?>
                <div class="col-3">
                    <!-- <form action="" method="post" id="form-subFilter"> -->
                        <select id="subFilter" name="<?= $typeFilter; ?>" 
                            class="form-control mt-2">
                            <option value="">Escolha <?= $nameType; ?></option>
                            <?php foreach( $subFilters as $key => $sub ): ?>
                                <option value="<?= $sub; ?>" <?=($subFilter == $sub)?'selected':''?>>
                                    <?= $sub; ?>
                                </option>  
                            <?php endforeach ?>
                        </select>
                        <!-- <button type="submit">Ok</button> -->
                    <!-- </form> -->
                </div>
            <?php endif; ?>
            <div class="col-5 mt-2">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroup-sizing-sm">
                        <i class="icofont-search-2"></i>
                        </span>
                    </div>
                    <input type="text" class="form-control" name="<?= $division->id ?>" id="filter" value="<?= $search ?>"
                        placeholder="Pesquisar" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
                    <div class="input-group-append">
                        <button class="btn btn-outline-secondary" type="button" name="<?= $unit_initials ?>" onclick="insertFilterTermInUrl(this)" id="button-addon2">
                            Buscar
                        </button>
                    </div>
                </div>
            </div>
            <div class="col-1">
                <form action="#" method="post">
                    <input type="hidden" name="tableContent" id="tableContent" value="">
                    <button type="submit" class="btn btn-outline-secondary mt-1" id="print-report" onclick="printReport()">
                        <i class="icofont-print icofont-2x"></i>
                    </button>
                </form>
            </div>    
        </div>
    <!-- </div> -->
    
    <table class="table table-sm report" id="tableReport">
        <thead class="thead-light">
            <tr>
                <th class="align-middle">Etiqueta CIMAER</th>
                <th class="align-middle">Etiqueta Metálica</th>
                <th class="align-middle">Nº Patrimônio (BMP)</th>
                <th class="align-middle">Modelo</th>
                <th class="align-middle">Seção</th>
                <th class="align-middle">Setor</th>
                <th class="align-middle">Status da Carga</th>
                <th class="align-middle">Condição</th>
                <th class="text-center align-middle">Qtd</th>
            </tr>
        </thead>
        <tbody id="bodyTableReport">

        </tbody>
</table>
</main>
<script>
    function printReport() {
        var tableReport = document.getElementById("tableReport").innerHTML;
        console.log(tableReport);
    }
    // Insere na url o termo de busca e faz o reload da página para o mesmo ser lido pelo controller
    function insertFilterTypeInUrl(){
        var filterTerm = document.getElementById("filter").value;
        var typeFilter = document.getElementById("filter").name;
        var html = 'reports.php?filter='+filterTerm+'&type='+typeFilter;
        window.location.href = html;
    }

    function typeFilter(name) {
        document.getElementById("filter").name = name;
        switch (name) {
            case 'number_unit':
                var message = 'Pesquisar etiqueta da unidade';
                break;
            case 'number_bmp':
                var message = 'Pesquisar nº patrimônio BMP';
                break;
            case 'number_metallic':
                var message = 'Pesquisar etiqueta metálica';
                break;
            case 'room':
                var message = 'Pesquisar pela sala';
                break;
            default:
                var message = 'Pesquisa geral';
        }
        document.getElementById("filter").placeholder = message;
    }    
</script>