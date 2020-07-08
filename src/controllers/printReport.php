<?php
session_start();
requireValidSession(true);
require_once(realpath(MODEL_PATH . '/Material.php'));
require_once(realpath(MODEL_PATH . '/Unit.php'));
// reference the Dompdf namespace
use Dompdf\Dompdf;

// include autoloader
require_once 'dompdf/autoload.inc.php';

$filter = filter_input(INPUT_POST, 'typePrint');
$subFilter = filter_input(INPUT_POST, 'subFilterPrint');
$loggedUser = $_SESSION['user'];
$unit = Unit::getOne(['id' => $loggedUser->unit_id]);
$seção = '';

switch($filter) {
    CASE 'name_division':
        $materials = Material::getMaterialsFullToReports($filter, $subFilter, 'divisions');
        $text = 'Seção';
        break;
    CASE 'name_part':
        $materials = Material::getMaterialsFullToReports($filter, $subFilter, 'parts');
        $text = 'Setor';
        break;
    CASE 'name_type':
        $materials = Material::getMaterialsFullToReports($filter, $subFilter, 'types_materials');
        $text = 'Tipo';
        break;
    CASE 'name_model':
        $materials = Material::getMaterialsFullToReports($filter, $subFilter, 'models_materials');
        $text = 'Modelo';
        break;
    CASE 'name_manufacturer':
        $materials = Material::getMaterialsFullToReports($filter, $subFilter, 'manufacturers');
        $text = 'Fabricante';
        break;
    CASE 'name_status':
        $materials = Material::getMaterialsFullToReports($filter, $subFilter, 'status');
        $text = 'Status';
        break;
    CASE 'name_condition':
        $materials = Material::getMaterialsFullToReports($filter, $subFilter, 'conditions');
        $text = 'Condição';
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
$materials = $tableOrder;

// instantiate and use the dompdf class
$dompdf = new Dompdf();

ob_start();
require_once(TEMPLATE_PATH . "/tableReport.php");
// $pdf = ob_get_clean();
// echo $pdf;

// die;
$dompdf->loadHtml(ob_get_clean());

// (Optional) Setup the paper size and orientation (landscape, portrait)
$dompdf->setPaper('A4', 'portrait');

// Render the HTML as PDF
$dompdf->render();
$fileName = 'Relatório_'.$text;
// Output the generated PDF to Browser
$dompdf->stream(
    $fileName,
    [
        'Attachment' => true // Para realizar o dowload mudar par true
    ]
);
// var_dump($_POST['tableContent']);