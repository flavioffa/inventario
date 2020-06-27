<?php
session_start();
requireValidSession(true);
require_once(realpath(MODEL_PATH . '/ModelMaterial.php'));

$exception = null;
$filter = filter_input(INPUT_GET, 'filter');
$page = intval(filter_input(INPUT_GET, 'page'));

if(isset($_GET['delete'])) {
    try {
        ModelMaterial::deleteById($_GET['delete']);
        addSuccessMsg('Modelo excluído com sucesso.');
    } catch(Exception $e) {
        if(stripos($e->getMessage(), 'FOREIGN KEY')) {
            addErrorMsg('Não é possível excluir modelo resgistrado em algum inventário.');
        } else {
            $exception = $e;
        }
    }
}
                    
$modelsMaterials = ModelMaterial::getModelsByType($filter, $page);

loadTemplateView("settings/models_materials", [
    'modelsMaterials' => $modelsMaterials,
    'exception' => $exception,
    'filter' => $filter
]);