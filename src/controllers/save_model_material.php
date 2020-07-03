<?php
session_start();
requireValidSession(true);
require_once(realpath(MODEL_PATH . '/TypeMaterial.php'));
require_once(realpath(MODEL_PATH . '/ModelMaterial.php'));

$exception = null;
$modelData = [];
$typesMaterials = TypeMaterial::get();

if(count($_POST) === 0 && isset($_GET['update'])) {
    $model = ModelMaterial::getOne(['id' => $_GET['update']]);
    $modelData = $model->getValues();
} elseif(count($_POST) > 0) {
    try {
        $dbModel = new ModelMaterial($_POST);
        if($dbModel->id) {
            $dbModel->update();
            addSuccessMsg('Modelo alterado com sucesso!');
            header("Location: models_materials.php?page=1");
            exit();
        } else {
            $dbModel->insert();
            addSuccessMsg('Modelo cadastrado com sucesso!');
        }
        $_POST = [];
    } catch(Exception $e) {
        if(stripos($e->getMessage(), 'model_type_unique')) {
            addErrorMsg('Não é possível usar modelo já cadastrado do mesmo tipo.');
        } else {    
            $exception = $e;
        }
    } finally {
        $modelData = $_POST;
    }
}

loadTemplateView('settings/save_model', $modelData + [
    'exception' => $exception,
    'typesMaterials' => $typesMaterials
]);