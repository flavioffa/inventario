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

    <div class="row d-flex justify-content-center mt-5">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Material por Status</h4>
                </div>
                <div class="card-body text-center" style="align-self: center;">
                    <div id="chart_div" style="width: 470px; height: 270px;"></div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Material por Seção</h4>
                </div>
                <div class="card-body no-gutters text-center" style="align-self: center;">
                    <div id="columnchart_values" style="width: 450px; height: 270px;"></div>
                    <!-- <div> -->
                        
                        <!-- <img src="assets/qrcode/1-3-149.png" alt=""> -->
                    <!-- </div> -->
                </div>
            </div>
        </div>
    </div>
</main>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
  <script type="text/javascript">
    google.charts.load("current", {packages:['corechart']});
    google.charts.setOnLoadCallback(drawChart);
    function drawChart() {
      var data = google.visualization.arrayToDataTable([
        ["Element", "Materiais", { role: "style" } ],
        <?php
            foreach($materialsByDivisions as $division) {
        ?>
        ["<?= $division['initials_division'];?>", <?= $division['qtd'];?>, "#0000ff"],
        <?php } ?>
      ]);

      var view = new google.visualization.DataView(data);
      view.setColumns([0, 1,
                       { calc: "stringify",
                         sourceColumn: 1,
                         type: "string",
                         role: "annotation" },
                       2]);

      var options = {
        chartArea: {
            left:50,
            right:10, // !!! works !!!
            bottom:20,  // !!! works !!!
            top:20,
            width:"100%",
            height:"100%"
        },
        animation:{
        duration: 2000,
        easing: 'out',
      },
        bar: {groupWidth: "90%"},
        legend: { position: "none" },
      };
      var chart = new google.visualization.ColumnChart(document.getElementById("columnchart_values"));
      chart.draw(view, options);
  }
  </script>
  <script>
    google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {

      var data = new google.visualization.DataTable();
      data.addColumn('string', 'Status');
      data.addColumn('number', 'Quantidade%');
      data.addRows([
        <?php
            foreach($materialsByStatus as $status) {
        ?>
        ["<?= $status['name_status'];?>", <?= $status['qtd'];?>],
        <?php } ?>
      ]);

      var options = {
        chartArea: {
            left:0,
            right:10, // !!! works !!!
            bottom:20,  // !!! works !!!
            top:20,
            width:"100%",
            height:"100%"
        }
      };

      var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
      chart.draw(data, options);
    }
  </script>
