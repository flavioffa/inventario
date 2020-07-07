<?php
session_start();
requireValidSession();
require_once(realpath(MODEL_PATH . '/Material.php'));

// reference the Dompdf namespace
use Dompdf\Dompdf;

// include autoloader
require_once 'dompdf/autoload.inc.php';

$reports = ['name_division'=>'Seção', 'name_part'=>'Setor', 'name_type'=>'Tipo', 'name_model'=>'Modelo','name_manufacturer'=> 'Fabricante', 'name_status'=>'Status', 'name_condition'=>'Condição'];
$typeFilter = filter_input(INPUT_GET, 'typeFilter') ? filter_input(INPUT_GET, 'typeFilter') : '';
// $filter = true;
$materialsData = [];
$materialsData['nameType'] = $reports[$typeFilter];
$materialsData['typeFilter'] = $typeFilter;

if(count($_POST) === 0 && isset($_GET['typeFilter'])) {
    $materials = Material::getMaterialsFullToReports(null, $subFilter);
    $selectSubFilter = array_column($materials, $typeFilter);
    $selectSubFilter = array_unique($selectSubFilter);
    // $unit = Unit::getOne(['id' => $_GET['update']]);
    $materialsData['typeFilters'] = $selectSubFilter;

    // print_r($selectSubFilter);
    // exit;
} elseif(count($_POST) === 0 && isset($_GET['typeFilter'])) {
    // <table class="table table-sm" id="tableReport">

    // $table = filter_input(INPUT_POST, 'tableContent');


    // $materials = Material::getMaterialsFullToReports($filter, $typeFilter, $_POST['subFilter']);
    // try {
        // $dbUnit = new Unit($_POST);
        // if($dbUnit->id) {
        //     $dbUnit->update();
        //     addSuccessMsg('Unidade alterada com sucesso!');
        //     header('Location: units.php');
        //     exit();
        // } else {
        //     $dbUnit->insert();
        //     addSuccessMsg('Unidade cadastrada com sucesso!');
        //     header('Location: units.php');
        // }
    //     $_POST = [];
    // } catch(Exception $e) {
        // $exception = $e;
    // } finally {
        $materialsData['subFilter'] = $_POST['subFilter'];
    // }
}

// function getMaterials()



// $divisions = array_column($materials['materials'], $typeFilter);
// $divisions = array_unique($divisions);
// print_r($materialsData);
// exit;
loadTemplateView('reports/reports', $materialsData + [
    'reports' => $reports,
    'materials' => $materials,
    'typeFilter' => $typeFilter?$typeFilter:$materialsData['typeFilter'],
    'subFilters' => $materialsData['typeFilters'],
    'subFilter' => $materialsData['subFilter'],
    'nameType' => $materialsData['nameType']
]);