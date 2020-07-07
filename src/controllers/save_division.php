<?php
session_start();
requireValidSession(true);
require_once(realpath(MODEL_PATH . '/Division.php'));

$users = User::get(['raw' => "1 = 1 ORDER BY rank DESC"]);
$unit_id = $_GET['unit'];
$divisions = Division::get(['division_unit_id' => $unit_id]);
$exception = null;
$divisionData = [];

if(count($_POST) === 0 && isset($_GET['update'])) {
    $division = Division::getOne(['id' => $_GET['update']]);
    $divisionData = $division->getValues();
} elseif(count($_POST) > 0) {
    try {
        $dbDivision = new Division($_POST);
        if($dbDivision->id) {
            $dbDivision->update();
            addSuccessMsg('Seção alterada com sucesso!');
            header("Location: divisions.php?unit={$unit_id}");
            exit();
        } else {
            $dbDivision->insert();
            addSuccessMsg('Seção cadastrada com sucesso!');
            header("Location: divisions.php?unit={$unit_id}");
        }
        $_POST = [];
    } catch(Exception $e) {
        if(stripos($e->getMessage(), 'division_unit_unique')) {
            addErrorMsg('Já existe seção cadastrada com o mesmo nome.');
        } else {
            $exception = $e;
        }
    } finally {
        $divisionData = $_POST;
    }
}

loadTemplateView('divisions/save_division', $divisionData + [
    'exception' => $exception,
    'users' => $users,
    'divisions'=> $divisions,
    'unit_id' => $unit_id
]);