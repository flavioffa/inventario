<?php
session_start();
requireValidSession(true);
require_once(realpath(MODEL_PATH . '/Condition.php'));

$exception = null;
$search = filter_input(INPUT_GET, 'searchTerm');

if(isset($_GET['delete'])) {
    try {
        Condition::deleteById($_GET['delete']);
        addSuccessMsg('Condição excluída com sucesso.');
    } catch(Exception $e) {
        if(stripos($e->getMessage(), 'FOREIGN KEY')) {
            addErrorMsg('Não é possível excluir Condição resgistrada em alguma tabela.');
        } else {
            $exception = $e;
        }
    }
}

if(empty($search)) {
    $conditions = Condition::get(['raw' => "name_condition != '' ORDER BY name_condition ASC"]);
} else {
    $conditions = Condition::get(['raw' => "name_condition LIKE '%{$search}%' ORDER BY name_condition ASC"]);
}

loadTemplateView('settings/conditions', [
    'conditions' => $conditions,
    'exception' => $exception,
    'search' => $search
]);