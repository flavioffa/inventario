<?php
session_start();
requireValidSession(true);
require_once(realpath(MODEL_PATH . '/Material.php'));

$exception = null;
$filter = filter_input(INPUT_GET, 'filter');
$typeFilter = filter_input(INPUT_GET, 'type');
$page = intval(filter_input(INPUT_GET, 'page'));

if(isset($_GET['delete'])) {
    try {
        Material::deleteById($_GET['delete']);
        addSuccessMsg('Material excluído com sucesso.');
    } catch(Exception $e) {
        if(stripos($e->getMessage(), 'FOREIGN KEY')) {
            addErrorMsg('Não é possível excluir material resgistrado em algum inventário.');
        } else {
            $exception = $e;
        }
    }
}

$materials = Material::getMaterialsFullDetails($filter, $typeFilter, $page);

loadTemplateView('materials/materials', [
    'materials' => $materials,
    'exception' => $exception,
    'filter' => $filter
]);