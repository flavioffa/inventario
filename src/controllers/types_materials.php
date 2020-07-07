<?php
session_start();
requireValidSession(true);
require_once(realpath(MODEL_PATH . '/TypeMaterial.php'));

$exception = null;
$search = filter_input(INPUT_GET, 'searchTerm');

if(isset($_GET['delete'])) {
    try {
        TypeMaterial::deleteById($_GET['delete']);
        $search = null;
        addSuccessMsg('Tipo excluído com sucesso.');
    } catch(Exception $e) {
        if(stripos($e->getMessage(), 'FOREIGN KEY')) {
            addErrorMsg('Não é possível excluir Tipo resgistrado em alguma tabela.');
        } else {
            $exception = $e;
        }
    }
}

if(empty($search)) {
    $typesMaterials = TypeMaterial::get(['raw' => "name_type != '' ORDER BY name_type ASC"]);
} else {
    $typesMaterials = TypeMaterial::get(['raw' => "name_type LIKE '%{$search}%' ORDER BY name_type ASC"]);
}

loadTemplateView('settings/types_materials', [
    'typesMaterials' => $typesMaterials,
    'exception' => $exception,
    'search' => $search
]);