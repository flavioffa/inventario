<?php
session_start();
requireValidSession(true);
require_once(realpath(MODEL_PATH . '/Condition.php'));

$exception = null;
$conditionData = [];

if(count($_POST) === 0 && isset($_GET['update'])) {
    $condition = Condition::getOne(['id' => $_GET['update']]);
    $conditionData = $condition->getValues();
} elseif(count($_POST) > 0) {
    try {
        $dbCondition = new Condition($_POST);
        if($dbCondition->id) {
            $dbCondition->update();
            addSuccessMsg('Condição alterada com sucesso!');
            header("Location: conditions.php");
            exit();
        } else {
            $dbCondition->insert();
            addSuccessMsg('Condição cadastrada com sucesso!');
        }
        $_POST = [];
    } catch(Exception $e) {
        if(stripos($e->getMessage(), 'name_condition')) {
            addErrorMsg('Não é possível cadastrar condição duplicada.');
        } elseif(stripos($e->getMessage(), 'color_condition')) {
            addErrorMsg('Não é possível usar cor de outra condição.');
        } else {    
            $exception = $e;
        }
    } finally {
        $conditionData = $_POST;
    }
}

loadTemplateView('settings/save_condition', $conditionData + [
    'exception' => $exception
]);