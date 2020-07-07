<?php
session_start();
requireValidSession(true);
require_once(realpath(MODEL_PATH . '/Part.php'));
require_once(realpath(MODEL_PATH . '/Division.php'));

$unit_initials = $_GET['unit'];
$division = Division::getOne(['id' => $_GET['division']]);
$search = filter_input(INPUT_GET, 'searchTerm');
$exception = null;
$msgTitle = "Gerenciar Setores ($division->name_division)";

if(isset($_GET['delete'])) {
    try {
        Part::deleteById($_GET['delete']);
        $search = null;
        addSuccessMsg('Setor excluído com sucesso.');
    } catch(Exception $e) {
        if(stripos($e->getMessage(), 'FOREIGN KEY')) {
            addErrorMsg('Não é possível excluir Setor com material resgistrado.');
        } else {
            $exception = $e;
        }
    }
}

$parts = Part::getFullDetails($search, $division->division_unit_id, $division->id);

loadTemplateView('parts/parts', [
    'parts' => $parts,
    'division' => $division,
    'unit_initials' => $unit_initials,
    'msgTitle' => $msgTitle,
    'exception' => $exception,
    'search' => $search
  
]);