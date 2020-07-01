<?php
session_start();
requireValidSession(true);
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
            $dbMaterial->insert();
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