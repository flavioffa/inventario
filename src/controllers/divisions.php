<?php
session_start();
requireValidSession(true);
require_once(realpath(MODEL_PATH . '/Unit.php'));
require_once(realpath(MODEL_PATH . '/Division.php'));

$unit = Unit::getOne(['id' => $_GET['unit']]);
// $parts = $_GET['parts'];
// $scales = isset($_GET['scales']) ? '&scales=true' : '';
$exception = null;
$msgTitle = 'Escolha a Divisão para gerenciar seus Órgãos';

if(isset($_GET['delete'])) {
    try {
        Division::deleteById($_GET['delete']);
        addSuccessMsg('Divisão excluída com sucesso.');
    } catch(Exception $e) {
        if(stripos($e->getMessage(), 'FOREIGN KEY')) {
            addErrorMsg('Não é possível excluir Divisão resgistrada em alguma escala.');
        } else {
            $exception = $e;
        }
    }
}

$divisions = Division::get(['division_unit_id' => $_GET['unit']]);

if(!isset($parts)) {
    loadTemplateView('divisions/divisions', [
        'msgTitle' => 'Gerenciar Divisões',
        'divisions' => $divisions,
        'unit' => $unit,
        'exception' => $exception
    ]);
} else {
    loadTemplateView('divisions/divisions', [
        'msgTitle' => $msgTitle,
        'divisions' => $divisions,
        'unit' => $unit
        // 'parts' => $parts,
        // 'scales' => $scales
    ]);
}