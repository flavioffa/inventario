<?php
session_start();
requireValidSession(true);
require("phpqrcode/qrlib.php");
require_once(realpath(MODEL_PATH . '/Material.php'));
require_once(realpath(MODEL_PATH . '/TypeMaterial.php'));
require_once(realpath(MODEL_PATH . '/ModelMaterial.php'));
require_once(realpath(MODEL_PATH . '/Manufacturer.php'));
require_once(realpath(MODEL_PATH . '/Division.php'));
require_once(realpath(MODEL_PATH . '/Status.php'));
require_once(realpath(MODEL_PATH . '/Condition.php'));

$exception = null;
$materialData = [];
$typeMaterial = TypeMaterial::get();
$modelMaterial = ModelMaterial::get();
$manufacturers = Manufacturer::get();
$divisions = Division::get();
$status = Status::get();
$conditions = Condition::get();

if(count($_POST) === 0 && isset($_GET['update'])) {
    $materialMaterial = Material::getOne(['id' => $_GET['update']]);
    $materialData = $materialMaterial->getValues();
} elseif(count($_POST) > 0) {
    try {
        $dbMaterial = new Material($_POST);
        if($dbMaterial->id) {
            $dbMaterial->update();
            addSuccessMsg('Material alterado com sucesso!');
            header("Location: materials.php");
            exit();
        } else {
            $dbMaterial->qrcode = $dbMaterial->number_unit.'-'.$dbMaterial->type_material_id.'-'.$dbMaterial->model_id.'.png';
            $idMat = $dbMaterial->insert();
            // recupera os dados inseridos no BD do novo material
            $material = Material::getMaterialsFullDetails($idMat, 'id');
            // pasta onde o arquivo será salvo 
            $tempDir = $_SERVER['DOCUMENT_ROOT'].'/assets/qrcode/';
            // nome do arquivo
            $fileName = $dbMaterial->qrcode;
            // concatena o caminho da pasta e o nome do arquivo
            $pngAbsoluteFilePath = $tempDir.$fileName;

            // construção dos dados que serão passados no qrcode 
            $codeContents  = 'BEGIN:VCARD'."\n";
            $codeContents .= 'FN:'.$material['materials'][$idMat]->name_type."\n"; 
            $codeContents .= 'ORG:'.$material['materials'][$idMat]->name_model."\n"; 
            $codeContents .= 'TEL;WORK;VOICE:'.$material['materials'][$idMat]->number_unit."\n";
            $codeContents .= 'TEL;HOME;VOICE:'.$material['materials'][$idMat]->number_metallic."\n";
            $codeContents .= 'TEL;TYPE=cell:'.$material['materials'][$idMat]->number_bmp."\n";  
            $codeContents .= 'END:VCARD';

            // Gera o qr-code e salva no servidor
            QRcode::png($codeContents, $pngAbsoluteFilePath, QR_ECLEVEL_L, 3);

            addSuccessMsg('Material cadastrado com sucesso!');
        }
        $_POST = [];
    } catch(Exception $e) {
        $exception = $e;
    } finally {
        $materialData = $_POST;
    }
}

loadTemplateView('materials/save_material', $materialData + [
    'exception' => $exception,
    'typeMaterial' => $typeMaterial,
    'modelMaterial' => $modelMaterial,
    'manufacturers' => $manufacturers,
    'divisions' => $divisions,
    'status' => $status,
    'conditions' => $conditions
]);