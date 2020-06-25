<?php
session_start();
requireValidSession(true);
require_once(realpath(MODEL_PATH . '/Unit.php'));

$users = User::get();
$exception = null;
$unitData = [];

if(count($_POST) === 0 && isset($_GET['update'])) {
    $unit = Unit::getOne(['id' => $_GET['update']]);
    $unitData = $unit->getValues();
} elseif(count($_POST) > 0) {
    try {
        $dbUnit = new Unit($_POST);
        if($dbUnit->id) {
            $dbUnit->update();
            addSuccessMsg('Unidade alterada com sucesso!');
            header('Location: units.php');
            exit();
        } else {
            $dbUnit->insert();
            addSuccessMsg('Unidade cadastrada com sucesso!');
            header('Location: units.php');
        }
        $_POST = [];
    } catch(Exception $e) {
        $exception = $e;
    } finally {
        $unitData = $_POST;
    }
}

loadTemplateView('units/save_unit', $unitData + [
    'exception' => $exception,
    'users' => $users
]);