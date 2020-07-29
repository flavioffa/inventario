<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel="stylesheet" href="assets/css/comum.css"> -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <!-- <link rel="stylesheet" href="assets/css/icofont.min.css"> -->
    <link rel="stylesheet" href="assets/css/print-report.css">
    <title>Inventário</title>
</head>
<body>
    <div class="content">
        Unidade: <?= $unit->initials_unit.' - '.$unit->name_unit?><br/>
        Relatório por <?= $text;?>: <?= $subFilter; ?><br/>
    </div>

    <table class="table table-sm report mt-2" id="tableReportPrint">
        <thead class="thead-light" id="tableHead">
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
        <tbody id="bodyTableReportPrint">
        <?php if(count($materials) == 0): ?>
            <tr>
                <td colspan="9">Escolha uma opção</td>
            </tr>
        <?php endif; ?>
        <?php foreach($materials as $material): ?>
            <?php if(!$material['count']): ?>
                <tr class="<?= $material['color_condition'] == 'dark' ? '' : "text-{$material['color_condition']}"; ?>">
                    <td><?= $material['number_unit']; ?></td>
                    <td><?= $material['number_metallic'] ?? ''; ?></td>
                    <td><?= $material['number_bmp'] ?? ''; ?></td>
                    <td><?= $material['name_model']; ?></td>
                    <td><?= $material['initials_division']; ?></td>
                    <td><?= $material['name_part']; ?></td>
                    <td><?= $material['name_status']; ?></td>
                    <td><?= $material['name_condition']; ?></td>
                    <td class="text-center"><?= $material['amount']; ?></td>
                </tr>
            <?php else: ?>
                <tr>
                    <td class="text-right font-weight-bold" colspan="8">Total</td>
                    <td class="text-center font-weight-bold"><?= $material['count']; ?></td>
                </tr>
            <?php endif; ?>
        <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>