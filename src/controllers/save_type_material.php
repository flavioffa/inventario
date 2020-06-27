<?php
session_start();
requireValidSession(true);
require_once(realpath(MODEL_PATH . '/TypeMaterial.php'));

$exception = null;
$typeData = [];

if(count($_POST) === 0 && isset($_GET['update'])) {
    $typeMaterial = TypeMaterial::getOne(['id' => $_GET['update']]);
    $typeData = $typeMaterial->getValues();
} elseif(count($_POST) > 0) {
    try {
        $dbtype = new TypeMaterial($_POST);
        if($dbtype->id) {
            $dbtype->update();
            addSuccessMsg('Tipo alterado com sucesso!');
            header("Location: types_materials.php");
            exit();
        } else {
            $dbtype->insert();
            addSuccessMsg('Tipo cadastrado com sucesso!');
        }
        $_POST = [];
    } catch(Exception $e) {
        $exception = $e;
    } finally {
        $typeData = $_POST;
    }
}

loadTemplateView('settings/save_type', $typeData + [
    'exception' => $exception
]);