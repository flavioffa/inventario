<?php
session_start();
requireValidSession(true);
require_once(realpath(MODEL_PATH . '/Unit.php'));
require_once(realpath(MODEL_PATH . '/Division.php'));

$unit = Unit::getOne(['id' => $_GET['unit']]);
$parts = $_GET['parts'];
$search = filter_input(INPUT_GET, 'searchTerm');
$exception = null;
$msgTitle = 'Escolha a Seção para gerenciar seus Setores';

if(isset($_GET['delete'])) {
    try {
        Division::deleteById($_GET['delete']);
        $search = null;
        addSuccessMsg('Seção excluída com sucesso.');
    } catch(Exception $e) {
        if(stripos($e->getMessage(), 'FOREIGN KEY')) {
            addErrorMsg('Não é possível excluir Seção com material registrado.');
        } else {
            $exception = $e;
        }
    }
}

$divisions = Division::getFullDetails($search, $_GET['unit']);

if(!isset($parts)) {
    loadTemplateView('divisions/divisions', [
        'msgTitle' => "Gerenciar Seções ($unit->initials_unit)",
        'divisions' => $divisions,
        'unit' => $unit,
        'exception' => $exception,
        'search' => $search
    ]);
} else {
    loadTemplateView('divisions/divisions', [
        'msgTitle' => $msgTitle,
        'divisions' => $divisions,
        'unit' => $unit,
        'parts' => $parts
    ]);
}