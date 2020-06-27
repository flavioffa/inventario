<?php
session_start();
requireValidSession(true);
require_once(realpath(MODEL_PATH . '/Manufacturer.php'));

$exception = null;
$search = filter_input(INPUT_GET, 'searchTerm');

if(isset($_GET['delete'])) {
    try {
        Manufacturer::deleteById($_GET['delete']);
        addSuccessMsg('Fabricante excluído com sucesso.');
    } catch(Exception $e) {
        if(stripos($e->getMessage(), 'FOREIGN KEY')) {
            addErrorMsg('Não é possível excluir Fabricante resgistrado em alguma tabela.');
        } else {
            $exception = $e;
        }
    }
}

if(empty($search)) {
    $manufacturers = Manufacturer::get(['raw' => "name_manufacturer != '' ORDER BY name_manufacturer ASC"]);
} else {
    $manufacturers = Manufacturer::get(['raw' => "name_manufacturer LIKE '%{$search}%' ORDER BY name_manufacturer ASC"]);
}

loadTemplateView('settings/manufacturers', [
    'manufacturers' => $manufacturers,
    'exception' => $exception,
    'search' => $search
]);