<?php
session_start();
requireValidSession(true);
require_once(realpath(MODEL_PATH . '/Status.php'));

$exception = null;
$search = filter_input(INPUT_GET, 'searchTerm');

if(isset($_GET['delete'])) {
    try {
        Status::deleteById($_GET['delete']);
        addSuccessMsg('Fabricante excluído com sucesso.');
    } catch(Exception $e) {
        if(stripos($e->getMessage(), 'FOREIGN KEY')) {
            addErrorMsg('Não é possível excluir Status resgistrado em alguma tabela.');
        } else {
            $exception = $e;
        }
    }
}

if(empty($search)) {
    $status = Status::get(['raw' => "name_status != '' ORDER BY name_status ASC"]);
} else {
    $status = Status::get(['raw' => "name_status LIKE '%{$search}%' ORDER BY name_status ASC"]);
}

loadTemplateView('settings/status', [
    'status' => $status,
    'exception' => $exception,
    'search' => $search
]);