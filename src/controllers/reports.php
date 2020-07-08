<?php
session_start();
requireValidSession();
require_once(realpath(MODEL_PATH . '/Material.php'));

$reports = ['name_division'=>'Seção', 'name_part'=>'Setor', 'name_type'=>'Tipo', 'name_model'=>'Modelo','name_manufacturer'=> 'Fabricante', 'name_status'=>'Status', 'name_condition'=>'Condição'];
$typeFilter = filter_input(INPUT_GET, 'typeFilter') ? filter_input(INPUT_GET, 'typeFilter') : '';
$subFilter = filter_input(INPUT_GET, 'subFilter') ? filter_input(INPUT_GET, 'subFilter') : '';
// $filter = true;


if(count($_POST) === 0 && isset($typeFilter)) {
    $materials = Material::getMaterialsFullToReports(null, $subFilter);
    $selectSubFilter = array_column($materials, $typeFilter);
    $selectSubFilter = array_unique($selectSubFilter);
}
if(count($_POST) === 0 && !empty($subFilter)) {
    switch($typeFilter) {
        CASE 'name_division':
            $materials = Material::getMaterialsFullToReports($typeFilter, $subFilter, 'divisions');
            break;
        CASE 'name_part':
            $materials = Material::getMaterialsFullToReports($typeFilter, $subFilter, 'parts');
            break;
        CASE 'name_type':
            $materials = Material::getMaterialsFullToReports($typeFilter, $subFilter, 'types_materials');
            break;
        CASE 'name_model':
            $materials = Material::getMaterialsFullToReports($typeFilter, $subFilter, 'models_materials');
            break;
        CASE 'name_manufacturer':
            $materials = Material::getMaterialsFullToReports($typeFilter, $subFilter, 'manufacturers');
            break;
        CASE 'name_status':
            $materials = Material::getMaterialsFullToReports($typeFilter, $subFilter, 'status');
            break;
        CASE 'name_condition':
            $materials = Material::getMaterialsFullToReports($typeFilter, $subFilter, 'conditions');
            break;
    }

    $result = [];

    $total = count($materials);

    $tableOrder = [];
    $count = 0;
    $ln = 0;
    $rowPrevious = '';
    if($materials) {
        foreach($materials as $row) {
            if($rowPrevious != $row['name_model'] && $ln != 0) {
                $tableOrder[] = ['count' => $count];
                $count = 1;
            } else {
                $count += $row['amount'];
            }
            $tableOrder[] = $row;
            $rowPrevious = $row['name_model'];
            $ln++;
            if($ln == $total) {
                $tableOrder[] = ['count' => $count];
            }
        }
    }
}

loadTemplateView('reports/reports',[
    'reports' => $reports,
    'materials' => $tableOrder,
    'typeFilter' => $typeFilter,
    'subFilters' => $selectSubFilter,
    'subFilter' => $subFilter
]);