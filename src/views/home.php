<main class="content">
    <?php
        renderTitle(
            'Dashboard',
            'Mantenha o controle do seu material carga!',
            'icofont-dashboard-web'
        );
    ?>
    <div class="row">
       <div class="col-md-3">
            <div class="d-flex small-box bg-success text-white justify-content-around">
                <div class="inner">
                    <h3><?= $inUse; ?></h3>
                    Em Uso
                </div>
                <div class="icon align-items-center mt-2">
                    <i class="icofont-upload-alt icofont-3x"></i>
                </div>
            </div>
       </div> 
       <div class="col-md-3">
            <div class="d-flex small-box bg-warning text-white justify-content-around">
                <div class="inner">
                    <h3><?= $inStock; ?></h3>
                    Em Estoque
                </div>
                <div class="icon align-items-center mt-2">
                    <i class="icofont-download icofont-3x"></i>
                </div>
            </div>
       </div> 
       <div class="col-md-3">
            <div class="d-flex small-box bg-danger text-white justify-content-around">
                <div class="inner">
                    <h3><?= $broke; ?></h3>
                    Quebrado
                </div>
                <div class="icon align-items-center mt-2">
                    <i class="icofont-broken icofont-3x"></i>
                </div>
            </div>
       </div> 
       <div class="col-md-3">
            <div class="d-flex small-box bg-info text-white justify-content-around">
                <div class="inner">
                    <h3><?= $inUse + $inStock + $broke; ?></h3>
                    Total
                </div>
                <div class="icon align-items-center mt-2">
                    <i class="icofont-globe icofont-3x"></i>
                </div>
            </div>
       </div> 
    </div>

    <div class="row mt-2">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Material por Status</h3>
                </div>
                <div class="card-body">
                    ...
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Material por Seção</h3>
                </div>
                <div class="card-body">
                    ...
                </div>
            </div>
        </div>
    </div>
</main>