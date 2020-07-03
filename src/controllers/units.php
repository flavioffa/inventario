<?php
session_start();
requireValidSession(true);
require_once(realpath(MODEL_PATH . '/Unit.php'));

$exception = null;
$parts = isset($_GET['parts']) ? '&parts=true' : '';
$divisions = $_GET['divisions'];
$msgTitle = $divisions ? 'Escolha a unidade para gerenciar suas Seções' : '';

if(isset($_GET['delete'])) {
    try {
        Unit::deleteById($_GET['delete']);
        addSuccessMsg('Unidade excluída com sucesso.');
    } catch(Exception $e) {
        if(stripos($e->getMessage(), 'FOREIGN KEY')) {
            addErrorMsg('Não é possível excluir unidade resgistrada em alguma escala.');
        } else {
            $exception = $e;
        }
    }
}

$units = Unit::get();

if(!isset($divisions)) {
    loadTemplateView('units/units', [
        'title' => 'Cadastro de Unidades',
        'msgTitle' => 'Mantenha os dados das unidades atualizados',
        'units' => $units,
        'exception' => $exception
    ]);
} else {
    loadTemplateView('units/units', [
        'title' => 'Unidades',
        'msgTitle' => $msgTitle,
        'units' => $units,
        'divisions' => $divisions,
        'parts' => $parts
    ]);
}