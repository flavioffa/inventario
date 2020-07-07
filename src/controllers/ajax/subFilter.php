<?php
session_start();
requireValidSession(true);
require_once(realpath(MODEL_PATH . '/Material.php'));

$filter = filter_input(INPUT_POST, 'filter');
$subFilter = filter_input(INPUT_POST, 'subFilter');
$action = filter_input(INPUT_POST, 'action');
switch($filter) {
    CASE 'name_division':
        $materials = Material::getMaterialsFullToReports($filter, $subFilter, 'divisions');
        break;
    CASE 'name_part':
        $materials = Material::getMaterialsFullToReports($filter, $subFilter, 'parts');
        break;
    CASE 'name_type':
        $materials = Material::getMaterialsFullToReports($filter, $subFilter, 'types_materials');
        break;
    CASE 'name_model':
        $materials = Material::getMaterialsFullToReports($filter, $subFilter, 'models_materials');
        break;
    CASE 'name_manufacturer':
        $materials = Material::getMaterialsFullToReports($filter, $subFilter, 'manufacturers');
        break;
    CASE 'name_status':
        $materials = Material::getMaterialsFullToReports($filter, $subFilter, 'status');
        break;
    CASE 'name_condition':
        $materials = Material::getMaterialsFullToReports($filter, $subFilter, 'conditions');
        break;
}
$result = [];

$total = count($materials);

$tableOrder = [];
$count = 0;
$ln = 0;
$grupoant = '';
if($materials) {
    foreach($materials as $row) {
        if($grupoant != $row['name_model'] && $ln != 0) {
            $tableOrder[] = ['count' => $count];
            $count = 1;
        } else {
            $count += $row['amount'];
        }
        $tableOrder[] = $row;
        $grupoant = $row['name_model'];
        $ln++;
        if($ln == $total) {
            $tableOrder[] = ['count' => $count];
        }
    }
}

echo(json_encode($tableOrder));